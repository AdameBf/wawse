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

if (isset($_GET['action']))
{
	$action = $_GET['action'];
	
	switch ($action)
	{
	case 'create';
	$parent_directory = 2;
	$titre = 'Worms Armageddon - '.$str['sch_editor_sch_maker_title'];
	include('../../includes/haut-sans-session-start.php');

	$jeu = $str['category'];

	//Chemin de fer (2 août 2012)
	$lien1 = array($str['index'], '../../index.php');
	$lien2 = array('Worms Armageddon', '../index.php');
	$lien3 = array($str['sch_editor'], 'index.php');
	$page_actuelle = $str['sch_editor_sch_maker_title'];
	include('../../includes/menu.php');

	include('includes/form-create-sch.php');
	break;
	
	case 'creer';
	$parent_directory = 2;
	$titre = 'Worms Armageddon - '.$str['sch_editor_sch_maker_title'];
	include('../../includes/haut-sans-session-start.php');

	$jeu = $str['category'];

	//Chemin de fer (2 août 2012)
	$lien1 = array($str['index'], '../../index.php');
	$lien2 = array('Worms Armageddon', '../index.php');
	$lien3 = array($str['sch_editor'], 'index.php');
	$page_actuelle = $str['sch_editor_sch_maker_title'];
	include('../../includes/menu.php');
	
	include('includes/form-create-sch.php');
	break;
	
	case 'edit';
	include('../../includes/connexion_pdo.php');
	
	if (isset($_GET['id']))
	{
		$get_scheme_info = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
		$get_scheme_info->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$get_scheme_info->execute();

		$get_scheme_info_result = $get_scheme_info->fetch();
		
		if (!empty($get_scheme_info_result))
		{
			$parent_directory = 2;
			$titre = 'Worms Armageddon - '.$str['sch_editor_sch_editing_title'].' '.$get_scheme_info_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$get_scheme_info_result['sch_author'].' (#'.$_GET['id'].')';
			include('../../includes/haut-sans-session-start.php');
			
			$jeu = $str['category'];

			// Chemin de fer (2 août 2012)
			$lien1 = array($str['index'], '../../index.php');
			$lien2 = array('Worms Armageddon', '../index.php');
			$lien3 = array($str['sch_editor'], 'index.php');
			$page_actuelle = $str['sch_editor_sch_editing_title'].' '.$get_scheme_info_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$get_scheme_info_result['sch_author'].' (#'.$_GET['id'].')';
			include('../../includes/menu.php');
			
			if ($get_scheme_info_result['sch_auth_ismember'] == 0)
			{
				if (isset($_POST['sch_password']) AND sha1($_POST['sch_password']) == $get_scheme_info_result['sch_password'] OR isset($_POST['sch_password']) && $_POST['sch_password'] == '' && $get_scheme_info_result['sch_password'] == NULL)
				{
					// Load the scheme file.
					$file_name = 'schemes/'.fileNameParser($get_scheme_info_result['sch_name']).'_by_'.fileNameParser($get_scheme_info_result['sch_author']).'.wsc';
					$file_content = file_get_contents($file_name);
					
					// Then include the editing page.
					include('includes/form-edit-sch.php');
				}
				else
				{
					// Ask for a password.
					?>
					<h1><?php echo $str['sch_editor_sch_replay_approving_interface_please_enter_sch_pwd']; ?></h1>
					<form method="post" action="?action=edit&amp;id=<?php echo $_GET['id']; ?>">
						<p><label for="sch_password" class="aligner"><?php echo $str['sch_editor_sch_password']; ?></label><input type="password" name="sch_password" id="sch_password" /></p>

						<p><input type="submit" value="<?php echo $str['sch_editor_sch_replay_uploader_authoring_submit_button']; ?>" class="bouton" /></p>
					</form>
					<?php
				}
			}
			else
			{
				if (isset($_SESSION['membre_id']) AND $_SESSION['membre_id'] == $get_scheme_info_result['sch_auth_ismember'])
				{
					// Load the scheme file.
					$file_name = 'schemes/'.fileNameParser($get_scheme_info_result['sch_name']).'_by_'.fileNameParser($get_scheme_info_result['sch_author']).'.wsc';
					$file_content = file_get_contents($file_name);
					
					// Then include the editing page.
					include('includes/form-edit-sch.php');
				}
				else
				{
					// Show an error message.
					echo '<h1>'.$str['error'].'</h1>';
					echo '<p>'.$str['sch_editor_sch_replay_uploader_wrong_user'].'</p>';
				}
			}
		}
		else
		{
			$parent_directory = 2;
			$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
			include('../../includes/haut-sans-session-start.php');

			$jeu = $str['category'];

			// Chemin de fer (2 août 2012)
			$lien1 = array($str['index'], '../../index.php');
			$lien2 = array('Worms Armageddon', '../index.php');
			$lien3 = array($str['sch_editor'], 'index.php');
			$page_actuelle = $str['sch_editor_sch_editing_title'];
			include('../../includes/menu.php');
			
			echo '<h1>'.$str['error'].'</h1>';
			echo '<p>'.$str['sch_editor_error_scheme_does_not_exist'].'</p>';
		}
	}
	else
	{
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		// Chemin de fer (2 août 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_editing_title_2'];
		include('../../includes/menu.php');
		
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_error_no_id_specified'].'</p>';
	}
	break;
	
	case 'create-based-on';
	include('../../includes/connexion_pdo.php');
	
	if (isset($_GET['id']))
	{
		$get_scheme_info = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
		$get_scheme_info->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
		$get_scheme_info->execute();

		$get_scheme_info_result = $get_scheme_info->fetch();
		
		if (!empty($get_scheme_info_result))
		{
			$parent_directory = 2;
			$titre = 'Worms Armageddon - '.$str['sch_editor_sch_creation_based_on_title'].' '.$get_scheme_info_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$get_scheme_info_result['sch_author'].' (#'.$_GET['id'].')';
			include('../../includes/haut-sans-session-start.php');

			$jeu = $str['category'];

			// Chemin de fer (2 août 2012)
			$lien1 = array($str['index'], '../../index.php');
			$lien2 = array('Worms Armageddon', '../index.php');
			$lien3 = array($str['sch_editor'], 'index.php');
			$page_actuelle = $str['sch_editor_sch_creation_based_on_title'].' '.$get_scheme_info_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$get_scheme_info_result['sch_author'].' (#'.$_GET['id'].')';
			include('../../includes/menu.php');

			// Load the scheme file.
			$file_name = 'schemes/'.fileNameParser($get_scheme_info_result['sch_name']).'_by_'.fileNameParser($get_scheme_info_result['sch_author']).'.wsc';
			$file_content = file_get_contents($file_name);

			// Then include the editing page.
			include('includes/form-create-based-on-sch.php');
		}
		else
		{
			$parent_directory = 2;
			$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
			include('../../includes/haut-sans-session-start.php');

			$jeu = $str['category'];

			// Chemin de fer (2 août 2012)
			$lien1 = array($str['index'], '../../index.php');
			$lien2 = array('Worms Armageddon', '../index.php');
			$lien3 = array($str['sch_editor'], 'index.php');
			$page_actuelle = $str['sch_editor_sch_creation_based_on_title_2'];
			include('../../includes/menu.php');
			
			echo '<h1>'.$str['error'].'</h1>';
			echo '<p>'.$str['sch_editor_error_scheme_does_not_exist'].'</p>';
		}
	}
	else
	{
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		// Chemin de fer (2 août 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_creation_based_on_title_2'];
		include('../../includes/menu.php');
		
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_error_no_id_specified'].'</p>';
	}
	break;
	
	default;
	$parent_directory = 2;
	$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
	include('../../includes/haut-sans-session-start.php');

	$jeu = $str['category'];

	// Chemin de fer (2 août 2012)
	$lien1 = array($str['index'], '../../index.php');
	$lien2 = array('Worms Armageddon', '../index.php');
	$lien3 = array($str['sch_editor'], 'index.php');
	$page_actuelle = $str['sch_editor_sch_creation_based_on_title_2'];
	include('../../includes/menu.php');
	
	echo '<h1>'.$str['error'].'</h1>';
	echo '<p>'.$str['error_invalid_action'].'</p>';
	break;
	}
}
else
{
	$parent_directory = 2;
	$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
	include('../../includes/haut-sans-session-start.php');

	$jeu = $str['category'];

	// Chemin de fer (2 août 2012)
	$lien1 = array($str['index'], '../../index.php');
	$lien2 = array('Worms Armageddon', '../index.php');
	$lien3 = array($str['sch_editor'], 'index.php');
	$page_actuelle = $str['error'];
	include('../../includes/menu.php');

	echo '<h1>'.$str['error'].'</h1>';
	echo '<p>'.$str['error_no_action'].'</p>';
}
?>
<script type="text/javascript" src="js/check_values.js"></script>
<script type="text/javascript" src="js/crate-probability-sch-create.js"></script>
<?php
include('includes/scheme-editor-bottom.php');
?>