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
<h1>Liste des fichiers</h1>
<p>
	<table>
		<tr><th>N°</th><th>Nom du fichier</th><th>Envoy&eacute; par :</th><th>Envoy&eacute; le :</th></tr>
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

$get_schemes_query = $bdd->query('SELECT * FROM schemes_list ORDER BY sch_id LIMIT 0, 30 DESC');
$i = 1;

while ($data = $requete->fetch())
{
	$numero_jour = date('w',$donnees['timestamp']);
	$annee = date('Y',$donnees['timestamp']);
	$numero_mois = date('m',$donnees['timestamp']) - 1;
	$numero_jour_dans_mois = date ('d',$donnees['timestamp']);
		if ($numero_mois < 10 AND $numero_mois > 00)
		{
			$numero_mois = str_replace('0','',$numero_mois);
		}
		if ($numero_mois == 00)
		{
			$numero_mois = 0;
		}
		if ($numero_jour_dans_mois < 10)
		{
			$numero_jour_dans_mois = str_replace('0','',$numero_jour_dans_mois);
		}
		if ($numero_jour_dans_mois != 1)
		{
			$date_complete = $jours[$numero_jour].' '.$numero_jour_dans_mois.' '.$mois[$numero_mois].' '.$annee;
		}
		else
		{
			$date_complete = $jours[$numero_jour].' '.$numero_jour_dans_mois.'<sup>er</sup> '.$mois[$numero_mois].' '.$annee;
		}
	echo '<tr><td>'.$boucle.'</td><td><a href="schemes/'.$donnees['fichier'].'">'.$donnees['fichier'].'</a></td><td>'.$donnees['pseudo'].'</td><td>'.$date_complete.'</td></tr>';
	$i++;
}
?>
	</table>
</p>
<?php
include('includes/scheme-editor-bottom.php');
?>