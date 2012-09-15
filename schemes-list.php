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
$titre = 'Worms Armageddon - '.$str['sch_editor_sch_list_title'];
include('../../includes/haut-sans-session-start.php');

$jeu = $str['category'];

//Chemin de fer (29 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_list_title'];

include('../../includes/menu.php');
include('../../includes/connexion_pdo.php');
?>
<h1><?php $str['sch_editor_sch_list_title']; ?></h1>
<p>
	<table>
		<tr><th><?php $str['sch_editor_sch_list_id_column']; ?></th><th><?php $str['sch_editor_sch_list_name_column']; ?></th><th><?php $str['sch_editor_sch_list_author_column']; ?></th><th><?php $str['sch_editor_sch_list_submit_date_column']; ?></th><th><?php $str['sch_editor_sch_list_last_edit_date_column']; ?></th><th><?php $str['sch_editor_sch_list_download_column']; ?></th></tr>
<?php
$schemes_per_page = 30;

$schemes_count_query = $bdd->query('SELECT COUNT(*) AS schemes_count FROM schemes_list');
$schemes_count_query_result = $schemes_count_query->fetch();
$number_of_schemes = $schemes_count_query_result['schemes_count'];
$schemes_count_query->closeCursor();

$pages_count = ceil($number_of_schemes / $schemes_per_page);

if (isset($_GET['p']))
{
$current_page = (int) $_GET['p'];

	if ($current_page === 0 OR $current_page > $pages_count) // Just in case a user is weird enough to invent unexisting pages in books.
	{
	$current_page = 1; // Let's reset that to 1 then.
	}
}
else
{
$current_page = 1;
}

echo $str['sch_editor_sch_list_pages_label'].' ';
for ($i = 1 ; $i <= $pages_count ; $i++)
{
	if ($i == $current_page && $i != $pages_count)
	{
	echo $i.' ';
	}
	else if ($i == $current_page && $i == $pages_count)
	{
	echo $i.'.';
	}
	else if ($i < $pages_count && $i != $current_page)
	{
    echo '<a href="livreor.php?page=' . $i . '">' . $i . '</a>  - ';
	}
	else if ($i == $pages_count && $i != $current_page)
	{
	echo '<a href="livreor.php?page=' . $i . '">' . $i . '</a>. <a href="">Actualiser</a>.</p>';
	}
}

$beginning = ($pages_count - 1) * $schemes_per_page;

$get_schemes_query = $bdd->prepare('SELECT * FROM schemes_list ORDER BY sch_id LIMIT :beginning, 30 DESC');
$get_schemes_query->bindValue(':beginning', $beginning, PDO::PARAM_INT);
$get_schemes_query->execute();
$i = 1;

while ($scheme_data = $get_schemes_query->fetch())
{
	$creation_date = date('Y\/m\/d', $scheme_data['sch_submit_date']);
	$last_edit_date = date('Y\/m\/d', $scheme_data['sch_last_edit_date']);

	echo '<tr><td>'.$scheme_data['sch_id'].'</td><td>'.$donnees['fichier'].'</td><td>'.$donnees['pseudo'].'</td><td>'.$date_complete.'</td></tr>';
	$i++;
}
?>
	</table>
</p>
<?php
include('includes/scheme-editor-bottom.php');
?>