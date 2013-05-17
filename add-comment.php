<?php
require('includes/functions.php');
require('includes/variables.php');

// Session start
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');
ini_set('url_rewriter.tags', '');
session_start();

include('../../includes/connexion_pdo.php');

if (isset($_GET['id']))
{
	$sch_id = (int) $_GET['id'];

	// Let's check if all fields are filled in.
	if (isset($_POST['sch_comment']) AND !empty($_POST['sch_comment']) AND isset($_POST['antibot']) AND $_POST['antibot'] == '42')
	{
		$member_id = 0;
		
		if (isset($_SESSION['pseudo']))
		{
			$com_auth = $_SESSION['pseudo'];
			$member_id = (int) $_SESSION['membre_id'];
		}
		else if (isset($_POST['sch_com_author']) AND !empty($_POST['sch_com_author']))
		{
			$com_auth = $_POST['sch_com_author'];
		}
		else
		{
			$com_auth = 'Anonymous';
		}

		// Now let's check if the scheme provided in the URL parameter actually exists, and if comments are allowed.
		$check_scheme_existence = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
		$check_scheme_existence->bindValue(':id', $sch_id, PDO::PARAM_INT);
		$check_scheme_existence->execute();
	
		$check_scheme_existence_result = $check_scheme_existence->fetch();
	
		if (!empty($check_scheme_existence_result) AND $check_scheme_existence_result['sch_allow_comments'] == 1)
		{
			// Time to add the comment to the database.
			$timestamp = time();
			$comment = htmlspecialchars(apostropheParse($_POST['sch_comment']));

			// Introduced in v1.2.2: IP recording.
			$ip = $_SERVER['REMOTE_ADDR'];

			$add_comment_query = $bdd->prepare('INSERT INTO sch_comments VALUES(\'\', :sch_id, :author, :member_id, :com_timestamp, :com_content, :ip, 0, 0)');
			$add_comment_query->execute(array(
			'sch_id' => $sch_id,
			'author' => $com_auth,
			'member_id' => $member_id,
			'com_timestamp' => $timestamp,
			'com_content' => $comment,
			'ip' => $ip));

			// Finally, redirect the user to the scheme he was previously viewing.
			header('Location: scheme-view.php?id='.$sch_id);
		}
		else
		{
			header('Location: scheme-list.php');
		}
	}
	else
	{
		header('Location: scheme-view.php?id='.$sch_id);
	}
}
else // If no ID is set, let's just redirect the user to the editor's main page.
{
	header('Location: index.php');
}
?>