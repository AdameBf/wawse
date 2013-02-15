<?php
require('includes/functions.php');
require('includes/variables.php');

// Session start
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');
ini_set('url_rewriter.tags', '');
session_start();

if (isset($_COOKIE['wa_sch_edit_lang']))
{
	if ($_COOKIE['wa_sch_edit_lang'] === 'fr')
	{
	include('includes/strings/fr.php');
	$language = 'fr';
	}
	else
	{
	include('includes/strings/en.php');
	$language = 'en';
	}
}
else if (isset($_SESSION['wa_sch_edit_lang']))
{
	if ($_SESSION['wa_sch_edit_lang'] === 'fr')
	{
	include('includes/strings/fr.php');
	$language = 'fr';
	}
	else
	{
	include('includes/strings/en.php');
	$language = 'en';
	}
}
else
{
include('includes/strings/en.php');
$language = 'en';
}

include('../../includes/connexion_pdo.php');

if (isset($_GET['id']))
{
	$get_scheme_infos_query = $bdd->prepare('SELECT sch_name, sch_author, sch_auth_ismember, sch_password, sch_example_replays_permissions FROM schemes_list WHERE sch_id = :sch_id');
	$get_scheme_infos_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
	$get_scheme_infos_query->execute();
	
	$id = (int) $_GET['id'];
	
	if ($scheme_infos = $get_scheme_infos_query->fetch() AND !empty($scheme_infos) AND $scheme_infos['sch_example_replays_permissions'] == 1)
	{
		$get_scheme_infos_query->closeCursor();
		
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_replay_approving_interface_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')';
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (26 novembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_replay_approving_interface_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')';

		include('../../includes/menu.php');
		if ($scheme_infos['sch_auth_ismember'] != 0) // Yeah, I'll probably change how this colum works to have the member's ID - which is more reliable than his nickname.
		{
			if (isset($_SESSION['pseudo']))
			{
				if ($_SESSION['pseudo'] == $scheme_infos['sch_author'])
				{
					// We can continue :)
					$continue = true;
				}
				else
				{
					// Show an error message.
					echo '<h1>'.$str['error'].'</h1>';
					echo '<p>'.$str['sch_editor_sch_replay_uploader_wrong_user'].'</p>';
					$continue = false;
				}
			}
			else
			{
				echo '<h1>'.$str['error'].'</h1>';
				echo '<p>'.$str['sch_editor_sch_replay_approving_interface_please_login'].'</p>';
				$continue = false;
			}
		}
		else
		{
			if (!isset($_POST['password']) OR sha1($_POST['password']) != $scheme_infos['sch_password'])
			{
				// Show an error message.
				echo '<h1>'.$str['error'].'</h1>';
				echo '<p>'.$str['sch_editor_sch_replay_approving_interface_wrong_sch_password'].'</p>';
				$continue = false;
			}
			else
			{
				// We can continue.
				$continue = true;
			}
		}
		
		if ($continue)
		{
			?>
			<h1><?php echo $page_actuelle; ?></h1>
			<?php
			// Get the replays' IDs and approvement levels (the other fields aren't required).
			$get_scheme_replay_info_query = $bdd->prepare('SELECT sch_exrep_id, sch_exrep_approvement_level FROM sch_example_replays WHERE sch_id = :sch_id');
			$get_scheme_replay_info_query->bindValue(':sch_id', $id, PDO::PARAM_INT);
			$get_scheme_replay_info_query->execute();

			$scheme_replays_count = $get_scheme_replay_info_query->rowCount();

			if ($scheme_replays_count != 0)
			{
				echo '<ul>'; // This should be moved in a way the list will only be created if it contains something.
				
				// Now, let's check if any box has been ticked, and that, for each replay.
				while ($sch_replay_info = $get_scheme_replay_info_query->fetch())
				{
					$replay_id = $sch_replay_info['sch_exrep_id'];
					$replay_appr_lvl = $sch_replay_info['sch_exrep_approvement_level'];

					// If any box has been ticked, then it means there will be a change in the database.
					if (isset($_POST[$replay_id]) OR isset($_POST['appr'.$replay_id]) OR isset($_POST['rej'.$replay_id]))
					{
						if (isset($_POST[$replay_id]) AND $_POST[$replay_id] == 1 || $_POST[$replay_id] == 2) // Waiting for approvement replays.
						{
							$new_appr_lvl_set = (int) $_POST[$replay_id];

							$query_approvement_level_update = $bdd->prepare('UPDATE sch_example_replays SET sch_exrep_approvement_level = :new_level WHERE sch_exrep_id = :replay_id');
							$query_approvement_level_update->bindValue(':new_level', $new_appr_lvl_set, PDO::PARAM_STR);
							$query_approvement_level_update->bindValue(':replay_id', $replay_id, PDO::PARAM_INT);
							$query_approvement_level_update->execute();
							
							$actions_array = array(NULL, $str['sch_editor_sch_replay_approving_approved'], $str['sch_editor_sch_replay_approving_rejected']);
							
							$message = str_replace('%1', $replay_id, $str['sch_editor_sch_replay_approving_action_message']);
							$message = str_replace('%2', $actions_array[$new_appr_lvl_set], $message);
							
							echo '<li>'.$message.'</li>';
						}
						else if (isset($_POST['rej'.$replay_id])) // Approved replays going to be rejected.
						{
							$query_approvement_level_update = $bdd->prepare('UPDATE sch_example_replays SET sch_exrep_approvement_level = "2" WHERE sch_exrep_id = :replay_id');
							$query_approvement_level_update->bindValue(':replay_id', $replay_id, PDO::PARAM_INT);
							$query_approvement_level_update->execute();
							
							$message = str_replace('%1', $replay_id, $str['sch_editor_sch_replay_approving_action_message']);
							$message = str_replace('%2', $str['sch_editor_sch_replay_approving_rejected'], $message);
							
							echo '<li>'.$message.'</li>';
						}
						else if (isset($_POST['appr'.$replay_id])) // Rejected replays going to be approved.
						{
							$query_approvement_level_update = $bdd->prepare('UPDATE sch_example_replays SET sch_exrep_approvement_level = "1" WHERE sch_exrep_id = :replay_id');
							$query_approvement_level_update->bindValue(':replay_id', $replay_id, PDO::PARAM_INT);
							$query_approvement_level_update->execute();
							
							$message = str_replace('%1', $replay_id, $str['sch_editor_sch_replay_approving_action_message']);
							$message = str_replace('%2', $str['sch_editor_sch_replay_approving_approved'], $message);
							
							echo '<li>'.$message.'</li>';
						}
						else // Don't know what the best behaviour would be here, for now I'll just do nothing.
						{
						}
					}
				}
				
				echo '</ul>';
			}
			else
			{
				// Tell the user there are no example replays.
				echo '<h1>'.$str['error'].'</h1>';
				echo '<p>'.$str['sch_editor_sch_replay_approving_no_example_replays_at_all'].'</p>';
			}
		}
		
		include('includes/scheme-editor-bottom.php');
	}
	else
	{
		// Tell the user no scheme has this ID or that the scheme's replays don't have to be approved.
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_sch_replay_approving_interface_error_message'].'</p>';
		
		include('includes/scheme-editor-bottom.php');
	}
}
else
{
	// Redirect the user to the previous page
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
?>