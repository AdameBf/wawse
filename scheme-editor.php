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

$parent_directory = 2;
$titre = 'Worms Armageddon - '.$str['sch_editor_sch_maker_title'];
include('../../includes/haut-sans-session-start.php');

$jeu = $str['category'];

//Chemin de fer (2 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_maker_title'];

include('../../includes/menu.php');

if (isset($_GET['action']))
{
	$action = $_GET['action'];
	
	switch ($action)
	{
	case 'create';
	include('includes/form-create-sch.php');
	break;
	
	case 'creer';
	include('includes/form-create-sch.php');
	break;
	
	case 'edit'; // Please set the correct infos in order to be able to edit your scheme (i.e. scheme password)
	break;
	
	default;
	echo '<h1>'.$str['error'].'</h1>';
	echo '<p>'.$str['error_invalid_action'].'</p>';
	}
}
else
{
	echo '<h1>'.$str['error'].'</h1>';
	echo '<p>'.$str['error_no_action'].'</p>';
}
?>
<script type="text/javascript" src="js/check_values.js"></script>
<script type="text/javascript" src="js/crate-probability-sch-create.js"></script>
<?php
include('includes/scheme-editor-bottom.php');
?>