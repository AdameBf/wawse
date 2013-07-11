<?php
require('includes/functions.php');

// Download the replay which id is in the "id" parameter.
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Bleh, I actually don't know which replay you attempt to download. :O
}

// Log on the database.
include('../../includes/connexion_pdo.php');

// 1. Let's retrieve the file name.
$query_get_replay = $bdd->prepare('SELECT sch_exrep_file_name, sch_exrep_download_count FROM sch_example_replays WHERE sch_exrep_id = :id');
$query_get_replay->bindValue(':id', $id, PDO::PARAM_INT);
$query_get_replay->execute();

$query_result = $query_get_replay->fetch();

if (!empty($query_result))
{
	// 2. Check if the scheme has already been downloaded by this person.
	$ip = $_SERVER['REMOTE_ADDR'];

	$query_check_unique_download = $bdd->prepare('SELECT * FROM sch_exrep_downloads WHERE dl_ip = :ip AND dl_rep_id = :id');
	$query_check_unique_download->bindValue(':ip', $ip, PDO::PARAM_STR);
	$query_check_unique_download->bindValue(':id', $id, PDO::PARAM_INT);
	$query_check_unique_download->execute();
	
	$query_check_udl_result = $query_check_unique_download->fetch();
	
	// 3. If it's a new download, increment the download count and add the IP to the database.
	if (empty($query_check_udl_result))
	{
		// A. Update the counter.
		$download_count = $query_result['sch_exrep_download_count'] + 1;

		$query_update_counter = $bdd->prepare('UPDATE sch_example_replays SET sch_exrep_download_count = :new_count WHERE sch_exrep_id = :id');
		$query_update_counter->bindValue(':new_count', $download_count, PDO::PARAM_INT);
		$query_update_counter->bindValue(':id', $id, PDO::PARAM_INT);
		$query_update_counter->execute();
		
		// B. Add the IP to the database.
		$timestamp = time();
		
		$query_add_downloader = $bdd->prepare('INSERT INTO sch_exrep_downloads VALUES (:ip, :id, :time)');
		$query_add_downloader->bindValue(':ip', $ip, PDO::PARAM_STR);
		$query_add_downloader->bindValue(':id', $id, PDO::PARAM_INT);
		$query_add_downloader->bindValue(':time', $timestamp, PDO::PARAM_INT);
		$query_add_downloader->execute();
	}

	// 4. Let the user download the replay.
	$file_name = $query_result['sch_exrep_file_name'];

	$query_get_replay->closeCursor();
	$query_check_unique_download->closeCursor();

	header('Location: replays/'.fileNameParser(apostropheParse($file_name)).'.WAgame');
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Aww, no replay has this ID (yet). :/
}
?>