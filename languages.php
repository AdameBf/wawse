<?php
$parent_directory = 2;
$titre = 'Worms Armageddon - Scheme Editor - Please select a language';
include('../../includes/haut.php');

$jeu = 'W:A Scheme Editor <!--no menu-->';

//Chemin de fer (2 août 2012)
$lien1 = array('Index', '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$page_actuelle = 'W:A Scheme Editor &gt; Language selection';

include('../../includes/menu.php');
?>
<h1>Please select a language</h1>
<form action="index.php" method="post">
	<p>
		<input type="radio" name="wa_sch_edit_lang" value="en" id="en" checked="checked" /><label for="en">English</label><br /><?php /* <input type="radio" name="wa_sch_edit_lang" value="es" id="es" /><label for="es">Español <em>(Patricio)</em></label><br /> */ // Commenting in PHP so it won't appear when viewing the source code. ?>
		<input type="radio" name="wa_sch_edit_lang" value="fr" id="fr" /><label for="fr">Français</label><br /><?php /* <input type="radio" name="wa_sch_edit_lang" value="hu" id="hu" /><label for="hu">Magyar <em>(Balee)</em></label><br /> */ ?>
		<input type="radio" name="wa_sch_edit_lang" value="nl" id="nl" /><label for="nl">Nederlands <em>(Piki1802)</em></label>
	</p>
	<p>
		<input type="submit" />
	</p>
</form>
<?php
include('includes/scheme-editor-bottom.php');
?>