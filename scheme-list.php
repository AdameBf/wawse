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

//Chemin de fer (16 septembre 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_list_title'];

include('../../includes/menu.php');
include('../../includes/connexion_pdo.php');
?>
<h1><?php echo $str['sch_editor_sch_list_title']; ?></h1>
<?php
$schemes_per_page = 30;

// Count how many schemes there are.
$schemes_count_query = $bdd->query('SELECT COUNT(*) AS schemes_count FROM schemes_list');
$schemes_count_query_result = $schemes_count_query->fetch();
$number_of_schemes = $schemes_count_query_result['schemes_count'];
$schemes_count_query->closeCursor();

$pages_count = ceil($number_of_schemes / $schemes_per_page);

if ($pages_count > 0) // There would only be 0 pages if there are no schemes.
{
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

	// First pages list, above the table.
	echo '<p class="pages">'.$str['sch_editor_sch_list_pages_label'].' ';
	for ($i = 1 ; $i <= $pages_count ; $i++)
	{
		if ($i == $current_page AND $i != $pages_count)
		{
		echo '['.$i.'] ';
		}
		else if ($i == $current_page AND $i == $pages_count)
		{
		echo '['.$i.'].</p>';
		}
		else if ($i < $pages_count AND $i != $current_page)
		{
		echo '<a href="?p='.$i.'">'.$i.'</a> ';
		}
		else if ($i == $pages_count AND $i != $current_page)
		{
		echo '<a href="?p='.$i.'">'.$i.'</a>.</p>';
		}
	}

	$beginning = ($pages_count - 1) * $schemes_per_page;

	$get_schemes_query = $bdd->prepare('SELECT schemes_list.*, sch_exrep_id, sch_example_replays.sch_id AS sch_id_2, sch_example_replays.sch_exrep_approvement_level FROM schemes_list LEFT JOIN sch_example_replays ON sch_example_replays.sch_id = schemes_list.sch_id ORDER BY schemes_list.sch_id DESC LIMIT :beginning, 30'); // (I hope I won't be blamed for not using more aliases.)
	$get_schemes_query->bindValue(':beginning', $beginning, PDO::PARAM_INT);
	$get_schemes_query->execute();
	
	$i = 1;
	?>
	<table>
		<tr><th><?php echo $str['sch_editor_sch_list_id_column']; ?></th><th><?php echo $str['sch_editor_sch_list_name_column']; ?></th><th><?php echo $str['sch_editor_sch_list_author_column']; ?></th><th><?php echo $str['sch_editor_sch_list_submit_date_column']; ?></th><th><?php echo $str['sch_editor_sch_list_last_edit_date_column']; ?></th><th><?php echo $str['sch_editor_sch_list_version_required_column']; ?></th><th><?php echo $str['sch_editor_sch_list_download_count_column']; ?></th><th><?php echo $str['sch_editor_sch_list_download_column']; ?></th><th><?php echo $str['sch_editor_sch_list_download_example_replays']; ?></th></tr>
	<?php
	while ($scheme_data = $get_schemes_query->fetch())
	{
		$creation_date = date('d\-m\-Y', $scheme_data['sch_submit_date']);
		$last_edit_date = date('d\-m\-Y', $scheme_data['sch_last_edit_date']);
		
		if (!isset($previous_sch_id)) // This means we're going to list the first scheme.
		{
			// Let's start the table row and set the replay counter to 1.
			echo '<tr><td>'.$scheme_data['sch_id'].'</td><td><a href="scheme-view.php?id='.$scheme_data['sch_id'].'">'.$scheme_data['sch_name'].'</a></td><td>'.$scheme_data['sch_author'].'</td><td>'.$creation_date.'</td><td>'.$last_edit_date.'</td><td>'.$scheme_data['sch_version_required'].'</td><td>'.$scheme_data['sch_download_count'].'</td><td><a href="download.php?id='.$scheme_data['sch_id'].'">'.$str['sch_editor_sch_list_download_column'].'</a></td><td style="text-align: center;">';
			
			$j = 1;
		}
		else if (isset($previous_sch_id) AND $previous_sch_id != $scheme_data['sch_id']) // This means we're starting listing a new scheme.
		{
			// Firstly, let's finish the previous row.
			if ($j != 1)
			{
				echo '- ';
			}
			else
			{
				echo '<em>'.$str['sch_editor_sch_list_no_example_replays'].' - </em>';
			}
			
			echo '<a href="attach-replays.php?id='.$previous_sch_id.'">'.$str['add'].'</a> / <a href="replay-approving-interface.php?id='.$previous_sch_id.'">'.$str['sch_editor_sch_list_replay_approving_interface_link'].'</a>.</td></tr>';
			
			// Then, let's start the new one and reset the replay counter.
			echo '<tr><td>'.$scheme_data['sch_id'].'</td><td><a href="scheme-view.php?id='.$scheme_data['sch_id'].'">'.$scheme_data['sch_name'].'</a></td><td>'.$scheme_data['sch_author'].'</td><td>'.$creation_date.'</td><td>'.$last_edit_date.'</td><td>'.$scheme_data['sch_version_required'].'</td><td>'.$scheme_data['sch_download_count'].'</td><td><a href="download.php?id='.$scheme_data['sch_id'].'">'.$str['sch_editor_sch_list_download_column'].'</a></td><td style="text-align: center;">';
			
			$j = 1;
		}
		else // Yes, I always create else{} blocks, even if they're empty.
		{
		}
		
		// Create a link to the replay we're currently on.
		if ($scheme_data['sch_exrep_approvement_level'] == 1)
		{
			echo '<a href="download-example-replay.php?id='.$scheme_data['sch_exrep_id'].'">'.$j.'</a> ';
			$j++;
		}
		
		$previous_sch_id = $scheme_data['sch_id']; // So we won't repeat a scheme if several replays are attached to it.
		
		$i++;
	}
	
	// Let's close the table.
	if ($j != 1)
	{
		echo '- ';
	}
	else
	{
		echo '<em>'.$str['sch_editor_sch_list_no_example_replays'].' - </em>';
	}
			
	echo '<a href="attach-replays.php?id='.$previous_sch_id.'">'.$str['add'].'</a> / <a href="replay-approving-interface.php?id='.$previous_sch_id.'">'.$str['sch_editor_sch_list_replay_approving_interface_link'].'</a>.</td></tr>';
	
	echo '</table>';
	
	// Show the pages on the bottom as well.
	echo '<p class="pages">'.$str['sch_editor_sch_list_pages_label'].' ';
	for ($i = 1 ; $i <= $pages_count ; $i++)
	{
		if ($i == $current_page AND $i != $pages_count)
		{
		echo '['.$i.'] ';
		}
		else if ($i == $current_page AND $i == $pages_count)
		{
		echo '['.$i.'].</p>';
		}
		else if ($i < $pages_count AND $i != $current_page)
		{
		echo '<a href="?p='.$i.'">'.$i.'</a> ';
		}
		else if ($i == $pages_count AND $i != $current_page)
		{
		echo '<a href="?p='.$i.'">'.$i.'</a>.</p>';
		}
	}
}
else
{
echo '<p>No schemes yet.</p>';
}

include('includes/scheme-editor-bottom.php');
?>