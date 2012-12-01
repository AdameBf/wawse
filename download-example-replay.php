<?php
require('includes/functions.php');

// Download the replay which id is in the "id" parameter
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Bleh, I actually don't know which replay you attempt to download. :O
}

// Log on the database
include('../../includes/connexion_pdo.php');

// 1. Let's retreive the file name
$query_get_replay = $bdd->prepare('SELECT sch_exrep_file_name, sch_exrep_download_count FROM sch_example_replays WHERE sch_exrep_id = :id');
$query_get_replay->bindValue(':id', $id, PDO::PARAM_INT);
$query_get_replay->execute();

$query_result = $query_get_replay->fetch();

if (!empty($query_result))
{
	// 2. Update the download count
	$download_count = $query_result['sch_exrep_download_count'] + 1;
	$file_name = $query_result['sch_exrep_file_name'];

	$query_get_replay->closeCursor();

	$query_update_counter = $bdd->prepare('UPDATE sch_example_replays SET sch_exrep_download_count = :new_count WHERE sch_exrep_id = :id');
	$query_update_counter->bindValue(':new_count', $download_count, PDO::PARAM_INT);
	$query_update_counter->bindValue(':id', $id, PDO::PARAM_INT);
	$query_update_counter->execute();

	// 3. Let the user download the replay
	header('Location: replays/'.$file_name.'.WAgame');
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Aww, no replay has this ID (yet). :/
}
?>