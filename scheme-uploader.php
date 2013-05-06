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
<table class="table_no_borders" style="margin-left: 10px; width: 98%">
	<tr>
		<td><label for="sch_file"><?php echo $str['sch_editor_sch_uploader_sch_file']; ?></label></td>
		<td colspan="2"><input type="file" name="sch_file" id="sch_file" /></td>
	</tr>
	<tr>
		<td><label for="sch_name"><?php echo $str['sch_editor_sch_name']; ?></label></td>
		<td style="width: 238px; padding-left: 25px;"><input type="text" name="sch_name" id="sch_name" maxlength="30" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_uploader_sch_name_hint']; ?></span></td>
	</tr>
	<tr>
		<td><label for="sch_short_desc" class="aligner"><?php echo $str['sch_editor_sch_short_desc']; ?></label></td>
		<td style="padding-left: 25px;"><input type="text" name="sch_short_desc" id="sch_short_desc" maxlength="255" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_short_desc_hint']; ?></span></td>
	</tr>
<?php if (!isset($_SESSION['id']))
{
?>
	<tr>
		<td><label for="sch_author"><?php echo $str['sch_editor_sch_author']; ?></label></td>
		<td colspan="2"><input type="text" name="sch_author" id="sch_author" /></td>
	</tr>
	<tr>
		<td><label for="sch_password"><?php echo $str['sch_editor_sch_password']; ?></label></td>
		<td colspan="2"><input type="password" name="sch_password" id="sch_password" /></td>
	</tr>
<?php
}
?>
	<tr>
		<td><label for="sch_desc" class="aligner"><?php echo $str['sch_editor_sch_desc']; ?></label></td>
		<td style="padding-left: 17px;"><textarea name="sch_desc" id="sch_desc" rows="4" cols="20"></textarea></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_desc_hint']; ?></span></td>
	</tr>
	<tr>
		<td><label for="sch_ex_rep1"><?php echo $str['sch_editor_sch_example_replays']; ?></label></td>
		<td><input type="file" name="sch_ex_rep1" id="sch_ex_rep1" class="champ" /><br />
			<input type="file" name="sch_ex_rep2" id="sch_ex_rep2" class="champ" /><br />
			<input type="file" name="sch_ex_rep3" id="sch_ex_rep3" class="champ" /><br />
			<input type="file" name="sch_ex_rep4" id="sch_ex_rep4" class="champ" /><br />
			<input type="file" name="sch_ex_rep5" id="sch_ex_rep5" class="champ" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_hint']; ?></span></td>
	</tr>
	<tr>
		<td><?php echo $str['sch_editor_sch_example_replays_permissions_label']; ?></td>
		<td colspan="2"><input type="radio" name="sch_exrep_permissions" value="0" id="opt0" /> <label for="opt0" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt0']; ?></label><br />
		<input type="radio" name="sch_exrep_permissions" value="1" id="opt1" checked="checked" /> <label for="opt1" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt1']; ?></label><br />
		<input type="radio" name="sch_exrep_permissions" value="2" id="opt2" /> <label for="opt2" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt2']; ?></label></td>
	</tr>
	<tr>
		<td colspan="3"> </td>
	</tr>
	<tr>
		<td style="width: 260px;"><label for="sch_comments"><?php echo $str['sch_editor_sch_allow_comments']; ?></label></td>
		<td style="padding-left: 60px;"><input type="checkbox" name="sch_comments" id="sch_comments" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_allow_comments_hint']; ?></span></td>
	</tr>
</table>

<p><input type="hidden" name="action" value="upload" /><input type="submit" value="<?php echo $str['sch_editor_sch_upload_button']; ?>" class="bouton" /></p>
</form>
<?php
include('includes/scheme-editor-bottom.php');
?>