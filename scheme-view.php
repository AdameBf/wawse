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
	$language = setLanguage($_COOKIE['wa_sch_edit_lang']);
}
else if (isset($_SESSION['wa_sch_edit_lang']))
{
	$language = setLanguage($_SESSION['wa_sch_edit_lang']);
}
else
{
$language = 'en';
}

include('includes/strings/'.$language.'.php');

if (isset($_GET['id'])) // Yeah, we should rather make sure we're viewing an existing scheme, but first, an ID must have been specified.
{
	$id = (int) $_GET['id'];
	include('../../includes/connexion_pdo.php');
	
	$get_schemes_infos = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
	$get_schemes_infos->bindValue(':id', $id, PDO::PARAM_INT);
	$get_schemes_infos->execute();
	
	$get_schemes_infos_result = $get_schemes_infos->fetch();
	
	if (!empty($get_schemes_infos_result)) // Now check the ID
	{
		$sch_name = $get_schemes_infos_result['sch_name'];
		$sch_author = $get_schemes_infos_result['sch_author'];
		
		$sch_id = $get_schemes_infos_result['sch_id'];
		$sch_version_required = $get_schemes_infos_result['sch_version_required'];
		$sch_download_count = $get_schemes_infos_result['sch_download_count'];

		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_title'].' '.$sch_name.' '.$str['sch_editor_sch_viewer_by'].' '.$sch_author.' (#'.$sch_id.')';
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (19 septembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_viewer_title'].' '.$sch_name.' '.$str['sch_editor_sch_viewer_by'].' '.$sch_author.' (#'.$sch_id.')';

		include('../../includes/menu.php');
		
		// First of all, let's open the scheme file.
		$sch_file = fopen('schemes/'.fileNameParser($sch_name).'_by_'.$sch_author.'.wsc', 'r');
		$signature = '';
		
		// Check the signature
		for ($i = 0; $i <= 3; $i++)
		{
			$signature .= fgetc($sch_file);
		}
		
		if ($signature == 'SCHM')
		{
			// Let's continue if the signature is correct
			echo '<h1>'.$page_actuelle.'</h1>'; // = current page, can't rename the variable because it would break a part of the script
			
			// First show general informations about the scheme
			$download_link_line = '<p><strong>'.$str['sch_editor_sch_viewer_sch_download_label'].'</strong> <a href="download.php?id='.$sch_id.'">'.$str['sch_editor_sch_viewer_sch_download_link'].'</a> ('.$str['sch_editor_sch_viewer_sch_download_count_downloaded'].' '.$get_schemes_infos_result['sch_download_count'].' '.$str['sch_editor_sch_viewer_sch_download_count_times'].').</p>';
			$download_link_line = onceTwice($download_link_line);
			echo $download_link_line;
			
			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_name'].'</strong> '.$sch_name.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_author'].'</strong> '.$sch_author.'.</p>';
			
		}
		else
		{
		echo $str['sch_editor_sch_viewer_error_invalid_sch_signature'];
		}
	}
	else
	{
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_error_title'];
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (19 septembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_viewer_error_title'];

		include('../../includes/menu.php');
		
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_sch_viewer_error_scheme_not_found'].'</p>';
	}
}
else
{
$parent_directory = 2;
$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_error_title'];
include('../../includes/haut-sans-session-start.php');

$jeu = $str['category'];

//Chemin de fer (19 septembre 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_viewer_error_title'];

include('../../includes/menu.php');

echo '<h1>'.$str['error'].'</h1>';
echo '<p>'.$str['sch_editor_sch_viewer_error_no_id_specified'].'</p>';
}

include('includes/scheme-editor-bottom.php');
?>