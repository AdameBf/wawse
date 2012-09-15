<?php
// Download the scheme which id is in the "id" parameter
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Bleh, I actually don't know what scheme you attempt to download. :O
}

// Log on the database
include('../../includes/connexion_pdo.php');

// 1. Let's retreive the file name
$query_get_scheme = $bdd->prepare('SELECT sch_name, sch_author, sch_download_count FROM schemes_list WHERE sch_id = :id');
$query_get_scheme->bindValue(':id', $id, PDO::PARAM_INT);
$query_get_scheme->execute();

$query_result = $query_get_scheme->fetch();

if (!empty($query_result))
{
	// 2. Update the download count
	$download_count = $query_result['sch_download_count'] + 1;
	$file_name = $query_result['sch_name'].'_by_'.$query_result['sch_author'];

	$query_get_scheme->closeCursor();

	$query_update_counter = $bdd->prepare('UPDATE schemes_list SET sch_download_count = :new_count WHERE sch_id = :id');
	$query_update_counter->bindValue(':new_count', $download_count, PDO::PARAM_INT);
	$query_update_counter->bindValue(':id', $id, PDO::PARAM_INT);
	$query_update_counter->execute();

	// 3. Let the user download the scheme
	header('Location: schemes/'.$file_name.'.wsc');
}
else
{
	header('Location: '.$_SERVER['HTTP_REFERER']); // Aww, no scheme has this ID (yet). :/
}
?>