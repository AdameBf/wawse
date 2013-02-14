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
					echo $str['sch_editor_sch_replay_uploader_wrong_user'];
					$continue = false;
				}
			}
			else
			{
				echo $str['sch_editor_sch_replay_approving_interface_please_login'];
				$continue = false;
			}
		}
		else
		{
			if (!isset($_POST['sch_password']) OR sha1($_POST['sch_password']) != $scheme_infos['sch_password'])
			{
				// Ask for scheme password.
				?>
				<h1><?php echo $str['sch_editor_sch_replay_approving_interface_please_enter_sch_pwd']; ?></h1>
				<form method="post" action="?id=<?php echo $id; ?>">
					<label for="password" class="aligner"><?php echo $str['sch_editor_sch_password']; ?></label><input type="password" name="password" id="sch_password" /></p>

					<p><input type="submit" value="<?php echo $str['sch_editor_sch_replay_uploader_authoring_submit_button']; ?>" class="bouton" /></p>
				</form>
				<?php
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
			// Show all replays, sorted according to their approvement level (with a separate section for each level).
			?>
			<h1><?php echo $page_actuelle; ?></h1>
			<form method="post" action="replay-approving-interface-action.php?id=<?php echo $id; ?>">
			<?php
			// 1. Replays waiting for approvement
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_waiting_for_approvement_replays']; ?></h2>
			<?php
			// Load the example replays waiting for approvement.
			$get_waiting_for_approvement_example_replays_query = $bdd->prepare('SELECT * FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "0"');
			$get_waiting_for_approvement_example_replays_query->bindValue(':sch_id', $id, PDO::PARAM_INT);
			$get_waiting_for_approvement_example_replays_query->execute();
			
			$waiting_for_approvement_example_replays_count = $get_waiting_for_approvement_example_replays_query->rowCount();
			
			if ($waiting_for_approvement_example_replays_count != 0)
			{
				?>
				<table>
					<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_approve_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_reject_column']; ?></th></tr>
				<?php
				$i = 1;
		
				while ($waiting_for_approvement_example_replays = $get_waiting_for_approvement_example_replays_query->fetch())
				{
					// Convert the timestamp to a date.
					$upload_date = date('d\-m\-Y', $waiting_for_approvement_example_replays['sch_exrep_upload_date']);;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo '<a href="download-example-replay.php?id='.$waiting_for_approvement_example_replays['sch_exrep_id'].'">'.$waiting_for_approvement_example_replays['sch_exrep_file_name'].'</a>'; ?></td>
						<td><?php echo $upload_date; ?></td>
						<td><?php echo '<input type="radio" name="'.$waiting_for_approvement_example_replays['sch_exrep_id'].'" value="1" />'; ?></td>
						<td><?php echo '<input type="radio" name="'.$waiting_for_approvement_example_replays['sch_exrep_id'].'" value="2" />'; ?></td>
					</tr>
					<?php
					$i++;
				}
				?>
				</table>
				<?php
			}
			else
			{
				echo $str['sch_editor_sch_replay_approving_no_replays_waiting_for_approvement'];
			}
			
			// 2. Approved replays
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_approved_replays']; ?></h2>
			<?php
			// Load the example replays waiting for approvement.
			$get_approved_example_replays_query = $bdd->prepare('SELECT * FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "1"');
			$get_approved_example_replays_query->bindValue(':sch_id', $id, PDO::PARAM_INT);
			$get_approved_example_replays_query->execute();
			
			$approved_example_replays_count = $get_approved_example_replays_query->rowCount();
			
			if ($approved_example_replays_count != 0)
			{
				?>
				<table>
					<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_reject_column']; ?></th></tr>
				<?php
				$i = 1;
		
				while ($approved_example_replays = $get_approved_example_replays_query->fetch())
				{
					// Convert the timestamp to a date.
					$upload_date = date('d\-m\-Y', $approved_example_replays['sch_exrep_upload_date']);;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo '<a href="download-example-replay.php?id='.$approved_example_replays['sch_exrep_id'].'">'.$approved_example_replays['sch_exrep_file_name'].'</a>'; ?></td>
						<td><?php echo $upload_date; ?></td>
						<td><?php echo '<input type="checkbox" name="rej'.$approved_example_replays['sch_exrep_id'].'" id="'.$approved_example_replays['sch_exrep_id'].'" />'; ?></td>
					</tr>
					<?php
					$i++;
				}
				?>
				</table>
				<?php
			}
			else
			{
				echo $str['sch_editor_sch_replay_approving_no_approved_replays'];
			}
			
			// 3. Rejected replays
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_rejected_replays']; ?></h2>
			<?php
			// Load the rejected example replays.
			$get_rejected_example_replays_query = $bdd->prepare('SELECT * FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "2"');
			$get_rejected_example_replays_query->bindValue(':sch_id', $id, PDO::PARAM_INT);
			$get_rejected_example_replays_query->execute();
			
			$rejected_example_replays_count = $get_rejected_example_replays_query->rowCount();
			
			if ($rejected_example_replays_count != 0)
			{
				?>
				<table>
					<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_approve_column']; ?></th></tr>
				<?php
				$i = 1;
		
				while ($rejected_example_replays = $get_rejected_example_replays_query->fetch())
				{
					// Convert the timestamp to a date.
					$upload_date = date('d\-m\-Y', $rejected_example_replays['sch_exrep_upload_date']);;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo '<a href="download-example-replay.php?id='.$rejected_example_replays['sch_exrep_id'].'">'.$rejected_example_replays['sch_exrep_file_name'].'</a>'; ?></td>
						<td><?php echo $upload_date; ?></td>
						<td><?php echo '<input type="checkbox" name="appr'.$rejected_example_replays['sch_exrep_id'].'" id="'.$rejected_example_replays['sch_exrep_id'].'" />'; ?></td>
					</tr>
					<?php
					$i++;
				}
				?>
				</table>
				<?php
			}
			else
			{
				echo $str['sch_editor_sch_replay_approving_no_rejected_replays'];
			}
			
			// Now, let's add a few things before closing that form.
			?>
			<p>
			<?php
			
			if ($waiting_for_approvement_example_replays_count != 0 OR $approved_example_replays_count != 0 OR $rejected_example_replays_count != 0)
			{
				if (isset($_POST['sch_password']))
				{
					// Send the password again, but in a hidden field.
					?>
					<input type="hidden" name="sch_password" value="<?php echo $_POST['sch_password']; ?>" />
					<?php
				}
			
				// Finally, let the user send his edits.
				?>
					<input type="submit" class="bouton" /></p>
				<?php
			}
			?>
			</form>
			<?php
		}
		
		include('includes/scheme-editor-bottom.php');
	}
	else
	{
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (13 février 2013)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_replay_approving_interface_title'].' #'.$id.' ('.$scheme_infos['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$scheme_infos['sch_author'].')';

		include('../../includes/menu.php');
		
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