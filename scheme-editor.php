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
	
	case 'edit';
	include('../../includes/connexion_pdo.php');
	
	if (isset($_GET['id']))
	{
		$get_schemes_infos = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
		$get_schemes_infos->bindValue(':id', $id, PDO::PARAM_INT);
		$get_schemes_infos->execute();

		$get_schemes_infos_result = $get_schemes_infos->fetch();
		
		if ($get_schemes_infos_result['sch_author_ismember'] != 0)
		{
		}
		else
		{
		}
	}
	else
	{
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_error_no_id_specified'].'</p>';
	}
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