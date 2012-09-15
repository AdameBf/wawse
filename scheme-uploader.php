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
$titre = 'Worms Armageddon - '.$str['sch_editor_sch_uploader_title'];
include('../../includes/haut-sans-session-start.php');

$jeu = $str['category'];

//Chemin de fer (29 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_uploader_title'];

include('../../includes/menu.php');
include('../../includes/connexion_pdo.php');
?>
<h1><?php echo $str['sch_editor_sch_uploader_title']; ?></h1>
<p><?php echo $str['sch_editor_sch_uploader_intro']; ?></p>
<form method="post" action="scheme-edit-check.php" enctype="multipart/form-data">
<p><label for="sch_file" class="aligner"><?php echo $str['sch_editor_sch_uploader_sch_file']; ?></label><input type="file" name="sch_file" id="sch_file" class="champ" /></p>
<p>
<?php if (!isset($_SESSION['id']))
{
?>
<label for="sch_author" class="aligner"><?php echo $str['sch_editor_sch_author']; ?></label><input type="text" name="sch_author" id="sch_author" class="champ" /><br />
<label for="sch_password" class="aligner"><?php echo $str['sch_editor_sch_password']; ?></label><input type="password" name="sch_password" id="sch_password" /><br />
<?php
}
?>
<label for="sch_desc" class="aligner"><?php echo $str['sch_editor_sch_desc']; ?></label><textarea name="sch_desc" id="sch_desc" rows="4" cols="35" class="champ" ></textarea></p>
<p><input type="hidden" name="action" value="upload" /><input type="submit" value="<?php echo $str['sch_editor_sch_upload_button']; ?>" class="bouton" /></p>
</form>
<?php
include('includes/scheme-editor-bottom.php');
?>