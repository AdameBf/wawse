<?php
require('includes/functions.php');
require('includes/variables.php');

// Session start
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');
ini_set('url_rewriter.tags', '');
session_start();

if (isset($_SESSION['wa_sch_edit_lang']))
{
	$language = setLanguage($_SESSION['wa_sch_edit_lang']);
}
else if (isset($_COOKIE['wa_sch_edit_lang']))
{
	$language = setLanguage($_COOKIE['wa_sch_edit_lang']);
}
else
{
$language = 'en';
}

include('includes/strings/'.$language.'.php');

include('../../includes/connexion_pdo.php');

if (isset($_GET['id']))
{
	$get_scheme_infos_query = $bdd->prepare('SELECT sch_name, sch_author, sch_auth_ismember, sch_password, sch_example_replays_permissions FROM schemes_list WHERE sch_id = :sch_id');
	$get_scheme_infos_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
	$get_scheme_infos_query->execute();
	
	$id = (int) $_GET['id'];
	
	if ($scheme_infos = $get_scheme_infos_query->fetch() AND !empty($scheme_infos))
	{
		$get_scheme_infos_query->closeCursor();
		
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_replay_uploader_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')';
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (25 novembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_replay_uploader_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')';

		include('../../includes/menu.php');
		
		if (!isset($_POST['replays_sent']))
		{
			?>
			<h1><?php echo $str['sch_editor_sch_replay_uploader_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')'; ?></h1>
			<p><?php echo $str['sch_editor_sch_replay_uploader_intro']; ?></p>
			<?php
			if ($scheme_infos['sch_example_replays_permissions'] == 0 AND $scheme_infos['sch_auth_ismember'] == 0)
			{
				if (!isset($_POST['password']) OR !isset($_POST['author']))
				{
				// Ask for scheme author and scheme password
				?>
				<form method="post" action="?id=<?php echo $_GET['id']; ?>">
					<p><label for="author" class="aligner"><?php echo $str['sch_editor_sch_author']; ?></label><input type="text" name="author" id="author" class="champ" /><br />
					<label for="password" class="aligner"><?php echo $str['sch_editor_sch_password']; ?></label><input type="password" name="password" id="password" /></p>

					<p><input type="submit" value="<?php echo $str['sch_editor_sch_replay_uploader_authoring_submit_button']; ?>" class="bouton" /></p>
				</form>
				<?php
				}
				else
				{
					if ($scheme_infos['sch_password'] == NULL)
					{
						if ($_POST['author'] == $scheme_infos['sch_author'] AND empty($_POST['password']))
						{
							$_SESSION['scheme_author'] = sha1($scheme_infos['sch_author']);
							$_SESSION['scheme_password'] = NULL;

							// Load the real form.
							include('includes/form-upload-example-replays.php');
						}
					}
					else
					{
						$encrypted_password = sha1($_POST['password']);

						if ($_POST['author'] == $scheme_infos['sch_author'] AND $encrypted_password == $scheme_infos['sch_password'])
						{
							$_SESSION['scheme_author'] = sha1($scheme_infos['sch_author']);
							$_SESSION['scheme_password'] = $encrypted_password;

							// Load the real form.
							include('includes/form-upload-example-replays.php');
						}
					}
				}
			}
			else if ($scheme_infos['sch_example_replays_permissions'] == 0 AND $scheme_infos['sch_auth_ismember'] != 0)
			{
				if (isset($_SESSION['id']) AND $_SESSION['pseudo'] != $scheme_infos['sch_author'])
				{
					echo '<p>'.$str['sch_editor_sch_replay_uploader_wrong_user'].'<p>';
				}
				else if (isset($_SESSION['id']) AND $_SESSION['pseudo'] == $scheme_infos['sch_author'])
				{
					$_SESSION['scheme_author'] = sha1($scheme_infos['sch_author']);
					$_SESSION['scheme_password'] = NULL;

					// Load the real form.
					include('includes/form-upload-example-replays.php');
				}
				else
				{
					echo '<p>'.$str['sch_editor_sch_replay_uploader_login_to_attach_replays'].'<p>';
				}
			}
			else
			{
				// Load the real form.
				include('includes/form-upload-example-replays.php');
			}
		}
		else
		{
			// First of all, get the scheme name.
			$sch_name = $scheme_infos['sch_name'];

			// Then, count how many replays there already were in the database. This will prevent overwriting replays, especially if they're nice. (By the way, I decided not to keep the old and arbitrary limit of 5 replays/scheme.)
			$example_replays_count_query = $bdd->prepare('SELECT COUNT(*) AS example_replays_count FROM sch_example_replays WHERE sch_id = :sch_id');
			$example_replays_count_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
			$example_replays_count_query->execute();

			$example_replays_count_query_result = $example_replays_count_query->fetch();
			$example_replays_count = $example_replays_count_query_result['example_replays_count'];
			$example_replays_count_query->closeCursor();
			
			// Define also the *approvement level* (i.e. if the replay is waiting for approvement, accepted, or rejected - the latter shouldn't appear right here, though)
			if ($scheme_infos['sch_example_replays_permissions'] == 2)
			{
			$example_replays_approvement_level = 1;
			$continue = true;
			}
			else if ($scheme_infos['sch_example_replays_permissions'] == 1)
			{
			$example_replays_approvement_level = 0;
			$continue = true;
			}
			else
			{
				if ($_SESSION['scheme_password'] == $scheme_infos['sch_password'] AND $_SESSION['scheme_author'] == sha1($scheme_infos['sch_author']))
				{
					$example_replays_approvement_level = 1;
					$continue = true;
				}
				else
				{
					$continue = false;
				}
			}
			
			$scheme_id = (int) $_GET['id'];

			if ($continue)
			{
				$i = $example_replays_count + 1;
				$timestamp = time();
				
				// Introduced in v1.2.2: IP recording.
				$ip = $_SERVER['REMOTE_ADDR'];
			
				// Then, check the replays.
				if (replayFileCheck($_FILES['sch_ex_rep1']))
				{
					$replay_file_name_without_extension = '['.$scheme_id.'.'.$sch_name.']_Example_Replay_'.$i;
					$replay_file_name = $replay_file_name_without_extension.'.WAgame';

					move_uploaded_file($_FILES['sch_ex_rep1']['tmp_name'], 'replays/'.basename(fileNameParser($replay_file_name)));
					$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, :ip, 0, :example_replays_approvement_level)');
					$add_replay_query->execute(array(
					'sch_id' => $scheme_id,
					'file_name' => $replay_file_name_without_extension,
					'submit_date' => $timestamp,
					'ip' => $ip,
					'example_replays_approvement_level' => $example_replays_approvement_level
					));

					$i++;
				}

				if (replayFileCheck($_FILES['sch_ex_rep2']))
				{
					$replay_file_name_without_extension = '['.$scheme_id.'.'.$sch_name.']_Example_Replay_'.$i;
					$replay_file_name = $replay_file_name_without_extension.'.WAgame';

					move_uploaded_file($_FILES['sch_ex_rep2']['tmp_name'], 'replays/'.basename(fileNameParser($replay_file_name)));
					$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, :ip, 0, :example_replays_approvement_level)');
					$add_replay_query->execute(array(
					'sch_id' => $scheme_id,
					'file_name' => $replay_file_name_without_extension,
					'submit_date' => $timestamp,
					'ip' => $ip,
					'example_replays_approvement_level' => $example_replays_approvement_level
					));

					$i++;
				}

				if (replayFileCheck($_FILES['sch_ex_rep3']))
				{
					$replay_file_name_without_extension = '['.$scheme_id.'.'.$sch_name.']_Example_Replay_'.$i;
					$replay_file_name = $replay_file_name_without_extension.'.WAgame';

					move_uploaded_file($_FILES['sch_ex_rep3']['tmp_name'], 'replays/'.basename(fileNameParser($replay_file_name)));
					$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, :ip, 0, :example_replays_approvement_level)');
					$add_replay_query->execute(array(
					'sch_id' => $scheme_id,
					'file_name' => $replay_file_name_without_extension,
					'submit_date' => $timestamp,
					'ip' => $ip,
					'example_replays_approvement_level' => $example_replays_approvement_level
					));

					$i++;
				}

				if (replayFileCheck($_FILES['sch_ex_rep4']))
				{
					$replay_file_name_without_extension = '['.$scheme_id.'.'.$sch_name.']_Example_Replay_'.$i;
					$replay_file_name = $replay_file_name_without_extension.'.WAgame';

					move_uploaded_file($_FILES['sch_ex_rep4']['tmp_name'], 'replays/'.basename(fileNameParser($replay_file_name)));
					$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, :ip, 0, :example_replays_approvement_level)');
					$add_replay_query->execute(array(
					'sch_id' => $scheme_id,
					'file_name' => $replay_file_name_without_extension,
					'submit_date' => $timestamp,
					'ip' => $ip,
					'example_replays_approvement_level' => $example_replays_approvement_level
					));

					$i++;
				}

				if (replayFileCheck($_FILES['sch_ex_rep5']))
				{
					$replay_file_name_without_extension = '['.$scheme_id.'.'.$sch_name.']_Example_Replay_'.$i;
					$replay_file_name = $replay_file_name_without_extension.'.WAgame';

					move_uploaded_file($_FILES['sch_ex_rep5']['tmp_name'], 'replays/'.basename(fileNameParser($replay_file_name)));
					$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, :ip, 0, :example_replays_approvement_level)');
					$add_replay_query->execute(array(
					'sch_id' => $scheme_id,
					'file_name' => $replay_file_name_without_extension,
					'submit_date' => $timestamp,
					'ip' => $ip,
					'example_replays_approvement_level' => $example_replays_approvement_level
					));

					$i++;
				}
				
				echo '<h1>'.$page_actuelle.'</h1>';
				echo '<p>'.$str['sch_editor_sch_replay_uploader_successful'].'</p>';
			}
			else
			{
				echo '<h1>'.$str['error'].'</h1>';
				echo '<p>'.$str['sch_editor_sch_replay_uploader_error_uatginam'].'<p>'; // UATGINAM = Uploading Although The Guy Is Not A Member.
			}
		}

		include('includes/scheme-editor-bottom.php');
	}
	else
	{
		// Tell the user no scheme has this ID.
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_sch_viewer_error_scheme_not_found'].'</p>';
	}
}
else
{
	// Redirect the user to the previous page
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
?>