<?php
require('includes/functions.php');

// Download the scheme which id is in the "id" parameter.
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Bleh, I actually don't know what scheme you attempt to download. :O
}

// Log on the database.
include('../../includes/connexion_pdo.php');

// 1. Let's retrieve the file name.
$query_get_scheme = $bdd->prepare('SELECT sch_name, sch_author, sch_download_count FROM schemes_list WHERE sch_id = :id');
$query_get_scheme->bindValue(':id', $id, PDO::PARAM_INT);
$query_get_scheme->execute();

$query_result = $query_get_scheme->fetch();

if (!empty($query_result))
{
	// 2. Check if the scheme has already been downloaded by this person.
	$ip = $_SERVER['REMOTE_ADDR'];

	$query_check_unique_download = $bdd->prepare('SELECT * FROM sch_downloads WHERE dl_ip = :ip AND dl_sch_id = :id');
	$query_check_unique_download->bindValue(':ip', $ip, PDO::PARAM_STR);
	$query_check_unique_download->bindValue(':id', $id, PDO::PARAM_INT);
	$query_check_unique_download->execute();
	
	$query_check_udl_result = $query_check_unique_download->fetch();
	
	// 3. If it's a new download, increment the download count and add the IP to the database.
	if (empty($query_check_udl_result))
	{
		// A. Update the counter.
		$download_count = $query_result['sch_download_count'] + 1;

		$query_update_counter = $bdd->prepare('UPDATE schemes_list SET sch_download_count = :new_count WHERE sch_id = :id');
		$query_update_counter->bindValue(':new_count', $download_count, PDO::PARAM_INT);
		$query_update_counter->bindValue(':id', $id, PDO::PARAM_INT);
		$query_update_counter->execute();
		
		// B. Add the IP to the database.
		$timestamp = time();
		
		$query_add_downloader = $bdd->prepare('INSERT INTO sch_downloads VALUES (:ip, :id, :time)');
		$query_add_downloader->bindValue(':ip', $ip, PDO::PARAM_STR);
		$query_add_downloader->bindValue(':id', $id, PDO::PARAM_INT);
		$query_add_downloader->bindValue(':time', $timestamp, PDO::PARAM_INT);
		$query_add_downloader->execute();
	}

	// 4. Let the user download the scheme.
	$file_name = $query_result['sch_name'].'_by_'.$query_result['sch_author'];
	
	$query_get_scheme->closeCursor();
	$query_check_unique_download->closeCursor();

	header('Location: schemes/'.fileNameParser(apostropheParse($file_name)).'.wsc');
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Aww, no scheme has this ID (yet). :/
}
?>