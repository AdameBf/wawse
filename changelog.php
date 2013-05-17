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
$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['sch_editor_changelog'];
$jeu = $str['category'];

//Chemin de fer (30 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_changelog'];

include('../../includes/haut-sans-session-start.php');
include('../../includes/menu.php');
?>
<h1><?php echo $str['sch_editor_changelog']; ?></h1>
<p><?php echo $str['sch_editor_changelog_intro']; ?></p>
<h4>1.2.2 - <?php echo $str['sch_editor_changelog_v1_2_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_2_2_item1']; ?></li>
</ul>
<h4>1.2.1a - <?php echo $str['sch_editor_changelog_v1_2_1a_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_2_1a_item1']; ?></li>
</ul>
<h4>1.2.1 - <?php echo $str['sch_editor_changelog_v1_2_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_2_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_2_1_item2']; ?></li>
</ul>
<h4>1.2.0 - <?php echo $str['sch_editor_changelog_v1_2_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_2_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_2_0_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_2_0_item3']; ?></li>
</ul>
<h4>1.1.1 - <?php echo $str['sch_editor_changelog_v1_1_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_1_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_1_1_item2']; ?></li>
</ul>
<h4>1.1.0 - <?php echo $str['sch_editor_changelog_v1_1_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_1_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_1_0_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_1_0_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_1_0_item4']; ?></li>
</ul>
<h4>1.0.3 - <?php echo $str['sch_editor_changelog_v1_0_3_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_0_3_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_3_item2']; ?></li>
</ul>
<h4>1.0.2 - <?php echo $str['sch_editor_changelog_v1_0_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item4']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item5']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_2_item6']; ?></li>
</ul>
<h4>1.0.1 - <?php echo $str['sch_editor_changelog_v1_0_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_0_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_1_item2']; ?></li>
</ul>
<h4>1.0.0 - <?php echo $str['sch_editor_changelog_v1_0_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item4']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item5']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item6']; ?>
	<ul>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item6a']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item6b']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item6c']; ?></li>
	</ul></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item7']; ?>
	<ul>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item7a']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item7b']; ?></li>
	</ul></li>
	<li><?php echo $str['sch_editor_changelog_v1_0_0_item8']; ?>
	<ul>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item8a']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v1_0_0_item8b']; ?></li>
	</ul></li>
</ul>
<h4>0.7.4 - <?php echo $str['sch_editor_changelog_v0_7_4_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_7_4_item1']; ?>
	<ul>
		<li><?php echo $str['sch_editor_changelog_v0_7_4_item1a']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v0_7_4_item1b']; ?></li>
		<li><?php echo $str['sch_editor_changelog_v0_7_4_item1c']; ?></li>
	</ul></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_4_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_4_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_4_item4']; ?></li>
</ul>
<h4>0.7.3 - <?php echo $str['sch_editor_changelog_v0_7_3_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_7_3_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_3_item2']; ?></li>
</ul>
<h4>0.7.2 - <?php echo $str['sch_editor_changelog_v0_7_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_7_2_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_2_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_2_item3']; ?></li>
</ul>
<h4>0.7.1 - <?php echo $str['sch_editor_changelog_v0_7_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_7_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_1_item2']; ?></li>
</ul>
<h4>0.7.0 - <?php echo $str['sch_editor_changelog_v0_7_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_7_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_0_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_7_0_item3']; ?></li>
</ul>
<h4>0.6.2 - <?php echo $str['sch_editor_changelog_v0_6_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_6_2_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_2_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_2_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_2_item4']; ?></li>
</ul>
<h4>0.6.1 - <?php echo $str['sch_editor_changelog_v0_6_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_6_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_1_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_1_item3']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_1_item4']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_1_item5']; ?></li>
</ul>
<h4>0.6.0b - <?php echo $str['sch_editor_changelog_v0_6_0b_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_6_0b_item1']; ?></li>
</ul>
<h4>0.6.0a - <?php echo $str['sch_editor_changelog_v0_6_0a_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_6_0a_item1']; ?></li>
</ul>
<h4>0.6.0 - <?php echo $str['sch_editor_changelog_v0_6_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_6_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_0_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_6_0_item3']; ?></li>
</ul>
<h4>0.5.2a - <?php echo $str['sch_editor_changelog_v0_5_2a_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_5_2a_item1']; ?></li>
</ul>
<h4>0.5.2 - <?php echo $str['sch_editor_changelog_v0_5_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_5_2_item1']; ?></li>
</ul>
<h4>0.5.1 - <?php echo $str['sch_editor_changelog_v0_5_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_5_1_item1']; ?></li>
</ul>
<h4>0.5.0 - <?php echo $str['sch_editor_changelog_v0_5_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_5_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_5_0_item2']; ?></li>
</ul>
<h4>0.4.2 - <?php echo $str['sch_editor_changelog_v0_4_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_4_2_item1']; ?></li>
</ul>
<h4>0.4.1 - <?php echo $str['sch_editor_changelog_v0_4_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_4_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_4_1_item2']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_4_1_item3']; ?></li>
</ul>
<h4>0.4.0 - <?php echo $str['sch_editor_changelog_v0_4_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_4_0_item1']; ?></li>
</ul>
<h4>0.3.0 - <?php echo $str['sch_editor_changelog_v0_3_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_3_0_item1']; ?></li>
</ul>
<h4>0.2.1 - <?php echo $str['sch_editor_changelog_v0_2_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_2_1_item1']; ?></li>
</ul>
<h4>0.2.0 - <?php echo $str['sch_editor_changelog_v0_2_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_2_0_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_2_0_item2']; ?></li>
</ul>
<h4>0.1.2 - <?php echo $str['sch_editor_changelog_v0_1_2_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_1_2_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_1_2_item2']; ?></li>
</ul>
<h4>0.1.1 - <?php echo $str['sch_editor_changelog_v0_1_1_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_1_1_item1']; ?></li>
	<li><?php echo $str['sch_editor_changelog_v0_1_1_item2']; ?></li>
</ul>
<h4>0.1.0 - <?php echo $str['sch_editor_changelog_v0_1_0_date']; ?></h4>
<ul>
	<li><?php echo $str['sch_editor_changelog_v0_1_0_item1']; ?></li>
</ul>
<?php	
include('includes/scheme-editor-bottom.php');
?>