<?php
require('includes/functions.php');
require('includes/variables.php');

// Session start
ini_set('session.use_cookies', '1');
ini_set('session.use_only_cookies', '1'); // PHP >= 4.3
ini_set('session.use_trans_sid', '0');
ini_set('url_rewriter.tags', '');
session_start();

if (!isset($_SESSION['pseudo']) AND !isset($_COOKIE['pseudo'])) // If the user isn't a logged-in member.
{
	if (isset($_COOKIE['wa_sch_edit_lang']) OR isset($_POST['wa_sch_edit_lang']))
	{
		if (isset($_POST['wa_sch_edit_lang']))
		{
			if ($_POST['wa_sch_edit_lang'] == 'fr')
			{
				// The language's set to French, so let's load the French strings.
				include('includes/strings/fr.php');
				setcookie('wa_sch_edit_lang', 'fr', time() + 365*24*3600, null, null, false, true);
			}
			else if ($_POST['wa_sch_edit_lang'] == 'en')
			{
				// The language's set to English, so let's load the English strings.
				include('includes/strings/en.php');
				setcookie('wa_sch_edit_lang', 'en', time() + 365*24*3600, null, null, false, true);
			}
			else if ($_POST['wa_sch_edit_lang'] == 'nl')
			{
				// The language's set to Dutch, so let's load the Dutch strings.
				include('includes/strings/nl.php');
				setcookie('wa_sch_edit_lang', 'nl', time() + 365*24*3600, null, null, false, true);
			}
			else
			{
				// The visitor is a nasty guy who edited the form. We'll just load the English string file.
				include('includes/strings/en.php');
				setcookie('wa_sch_edit_lang', 'en', time() + 365*24*3600, null, null, false, true);
			}
		}
		else
		{
			if ($_COOKIE['wa_sch_edit_lang'] == 'fr')
			{
				// The language's set to French, so let's load the French strings.
				include('includes/strings/fr.php');
			}
			else if ($_COOKIE['wa_sch_edit_lang'] == 'en')
			{
				// The language's set to English, so let's load the English strings.
				include('includes/strings/en.php');
			}
			else if ($_COOKIE['wa_sch_edit_lang'] == 'nl')
			{
				// The language's set to Dutch, so let's load the Dutch strings.
				include('includes/strings/nl.php');
			}
			else
			{
				// The visitor is a nasty guy who edited the cookie. We'll right load the English string file; but since the cookie was edited, let's change it to 'en'.
				include('includes/strings/en.php');
				setcookie('wa_sch_edit_lang', 'en', time() + 365*24*3600, null, null, false, true);
			}
		}
	}
	else // If we don't know the user's language, we'll redirect him to the Language Selection page
	{
		header('Location: languages.php');
	}
}
else
{
	// Log on the database
	include('../../includes/connexion_pdo.php');

	if (isset($_POST['wa_sch_edit_lang']))
	{
		$language = $_POST['wa_sch_edit_lang'];
		$_SESSION['wa_sch_edit_lang'] = $language;
		$membre_id = (int) $_SESSION['id'];
	
		$query = $bdd->prepare('UPDATE membres SET membre_scheme_editor_language = :language WHERE membre_id = :id');
		$query->execute(array('language' => $language, 'id' => $membre_id));
	
		if ($language == "fr")
		{
			// Load the French strings
			include('includes/strings/fr.php');
		}
		else if ($language == "nl")
		{
			// Load the Dutch strings
			include('includes/strings/nl.php');
		}
		else
		{
			// Load the English string
			include('includes/strings/en.php');
		}
	}
	else
	{
		$query = $bdd->prepare('SELECT membre_scheme_editor_language FROM membres WHERE membre_id = ?');
		$query->execute(array($_SESSION['id']));
		$language = $query->fetch();
		$language = $language['membre_scheme_editor_language'];

		if ($language == "none")
		{
			// Then the user has to choose
			header('Location: languages.php');
		}
		else if ($language == "fr")
		{
			// Load the French strings
			include('includes/strings/fr.php');
		}
		else if ($language == "hu")
		{
			// Load the Dutch strings
			include('includes/strings/nl.php');
		}
		else
		{
			// Load the English string
			include('includes/strings/en.php');
		}
	}
}

$parent_directory = 2;
$titre = 'Worms Armageddon - '.$str['sch_editor'];
$jeu = $str['category'];

// Views counter
$compteur_page = 'worms-armageddon/sch-edit/index.cpt';
$date_comptage_vues = $str['view_counting_date'];

// Chemin de fer (2 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$page_actuelle = $str['sch_editor'];

include('../../includes/haut-sans-session-start.php');
include('../../includes/menu.php');
?>
<h1><?php echo $str['sch_editor_main_page_title']; ?></h1>
<p><?php echo $str['sch_editor_main_page_content']; ?></p>
<ul>
	<li><a href="scheme-list.php"><?php echo $str['sch_editor_sch_list_title']; ?></a></li>
	<li><a href="scheme-editor.php?action=create"><?php echo $str['sch_editor_sch_maker_title']; ?></a></li>
	<li><a href="scheme-uploader.php"><?php echo $str['sch_editor_sch_uploader_title']; ?></a></li>
</ul>
	<?php
	/* if (isset($_SESSION['id']))
	{
	?>
	<ul>
		<li><a href="my-schemes.php"><?php echo $str['sch_editor_my_schemes_title']; ?></a>
	</ul>
	<?php
	} */
	?>
<ul>
	<li><a href="changelog.php"><?php echo $str['sch_editor_changelog']; ?></a></li>
	<li><a href="languages.php">Select Another Language</a></li>
</ul>
<?php
include('includes/scheme-editor-bottom.php');
?>