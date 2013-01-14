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
		if ($scheme_infos['sch_author_ismember'] != 0) // Yeah, I'll probably change how this colum works to have the member's ID - which is more reliable than his nickname.
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
				// Ask for scheme author and password.
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
			
			// 1. Count replays separately, according to their approvement level.
			
			// A. Replays waiting for approvement
			$example_replays_waiting_for_approvement_count_query = $bdd->prepare('SELECT COUNT(*) AS example_replays_waiting_for_approvement_count FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "0"');
			$example_replays_waiting_for_approvement_count_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
			$example_replays_waiting_for_approvement_count_query->execute();
			
			$example_replays_waiting_for_approvement_count = $example_replays_waiting_for_approvement_count_query->fetch();
			
			// B. Approved replays
			$approved_example_replays_count_query = $bdd->prepare('SELECT COUNT(*) AS approved_example_replays_count FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "1"');
			$approved_example_replays_count_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
			$approved_example_replays_count_query->execute();
			
			$approved_example_replays_count = $approved_example_replays_count_query->fetch();
			
			// C. Rejected replays
			$rejected_example_replays_count_query = $bdd->prepare('SELECT COUNT(*) AS rejected_example_replays_count FROM sch_example_replays WHERE sch_id = :sch_id AND sch_exrep_approvement_level = "2"');
			$rejected_example_replays_count_query->bindValue(':sch_id', $_GET['id'], PDO::PARAM_INT);
			$rejected_example_replays_count_query->execute();
			
			$rejected_example_replays_count = $rejected_example_replays_count_query->fetch();
			
			// 2. Show the replays
			
			// A. Replays waiting for approvement
			$i = 1;
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_waiting_for_approvement_replays']; ?></h2>
			<table>
				<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_approve_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_reject_column']; ?></th></tr>
			</table>
			<?php
			
			// B. Approved replays
			$i = 1;
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_waiting_for_approvement_replays']; ?></h2>
			<table>
				<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_reject_column']; ?></th></tr>
			</table>
			<?php
			
			// C. Rejected replays
			$i = 1;
			?>
			<h2><?php echo $str['sch_editor_sch_replay_approving_waiting_for_approvement_replays']; ?></h2>
			<table>
				<tr><th><?php echo $str['sch_editor_sch_exrep_appr_file_id_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_file_name_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_upload_date_column']; ?></th><th><?php echo $str['sch_editor_sch_exrep_appr_approve_column']; ?></th></tr>
			</table>
			<?php
		}
		
		include('includes/scheme-editor-bottom.php');
	}
	else
	{
		// Tell the user no scheme has this ID or that the scheme's replays don't have to be approved.
	}
}
else
{
	// Redirect the user; where, I don't know yet! :O
}
?>