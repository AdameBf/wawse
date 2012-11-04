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
	$language = setLanguage($_COOKIE['wa_sch_edit_lang']);
}
else if (isset($_SESSION['wa_sch_edit_lang']))
{
	$language = setLanguage($_SESSION['wa_sch_edit_lang']);
}
else
{
$language = 'en';
}

include('includes/strings/'.$language.'.php');

if (isset($_GET['id'])) // Yeah, we should rather make sure we're viewing an existing scheme, but first, an ID must have been specified.
{
	$id = (int) $_GET['id'];
	include('../../includes/connexion_pdo.php');
	
	$get_schemes_infos = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
	$get_schemes_infos->bindValue(':id', $id, PDO::PARAM_INT);
	$get_schemes_infos->execute();
	
	$get_schemes_infos_result = $get_schemes_infos->fetch();
	
	if (!empty($get_schemes_infos_result)) // Now check the ID
	{
		$sch_name = $get_schemes_infos_result['sch_name'];
		$sch_author = $get_schemes_infos_result['sch_author'];
		
		$sch_id = $get_schemes_infos_result['sch_id'];
		$sch_version_required = $get_schemes_infos_result['sch_version_required'];
		$sch_download_count = $get_schemes_infos_result['sch_download_count'];
		$sch_description = nl2br($get_schemes_infos_result['sch_desc']);
		
		$sch_created_on = date('d\/m\/Y', $get_schemes_infos_result['sch_submit_date']);
		$sch_last_edited_on = date('d\/m\/Y', $get_schemes_infos_result['sch_last_edit_date']);

		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_title'].' '.$sch_name.' '.$str['sch_editor_sch_viewer_by'].' '.$sch_author.' (#'.$sch_id.')';
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (19 septembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_viewer_title'].' '.$sch_name.' '.$str['sch_editor_sch_viewer_by'].' '.$sch_author.' (#'.$sch_id.')';

		include('../../includes/menu.php');
		
		// First of all, let's open the scheme file.
		$file_name = 'schemes/'.fileNameParser($sch_name).'_by_'.fileNameParser($sch_author).'.wsc';
		$sch_file = fopen($file_name, 'r');

		$signature = '';
		
		// Check the signature
		for ($i = 0; $i <= 3; $i++)
		{
			$signature .= fgetc($sch_file);
		}
		
		if ($signature == 'SCHM')
		{
			// Let's continue if the signature is correct
			echo '<h1>'.$page_actuelle.'</h1>'; // = current page, can't rename the variable because it would break a part of the script
			
			// First show general informations about the scheme
			$download_link_line = '<p><strong>'.$str['sch_editor_sch_viewer_sch_download_label'].'</strong> <a href="download.php?id='.$sch_id.'">'.$str['sch_editor_sch_viewer_sch_download_link'].'</a> ('.$str['sch_editor_sch_viewer_sch_download_count_downloaded'].' '.$get_schemes_infos_result['sch_download_count'].' '.$str['sch_editor_sch_viewer_sch_download_count_times'].').</p>';
			$download_link_line = onceTwice($download_link_line);
			echo $download_link_line;
			
			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_name'].'</strong> '.$sch_name.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_author'].'</strong> '.$sch_author.'.</p>';
			
			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_created_on'].'</strong> '.$sch_created_on.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_last_edited_on'].'</strong> '.$sch_last_edited_on.'.</p>';

			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_required_version'].'</strong> '.$sch_version_required.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_desc'].'</strong><br />'.$sch_description.'</p>';
			
			// Now, let's go with the settings. I think it should be better to get the whole file's content now.
			$file_content = file_get_contents($file_name);
			
			// Now let's start displaying informations.
			?>
			<table class="table_no_borders" style="width: 610px;">
				<tr>
					<td colspan="3" style="width: 300px;">
						<fieldset><legend><?php echo $str['sch_editor_game_settings']; ?></legend>
							<table class="table_no_borders" style="width: 296px">
								<tr>
									<td style="width: 74px"><img src="images/php/initial-worm-energy.php?v=<?php echo ord($file_content[26]); ?>" alt="<?php echo $str['sch_editor_initial_worm_energy']; ?>: <?php echo ord($file_content[26]); ?>" width="68px" height="68px" /></td>
									<td style="width: 74px"><img src="images/php/wins-required.php?v=<?php echo ord($file_content[29]); ?>" alt="<?php echo $str['sch_editor_number_of_victories']; ?>: <?php echo ord($file_content[29]); ?>" width="68px" height="68px" /></td>
									<td style="width: 74px"><img src="images/php/worm-select.php?v=<?php echo ord($file_content[14]); ?>" alt="<?php echo $str['sch_editor_worm_select']; ?>: <?php
									if(ord($file_content[14]) == 0)
									{
									echo $str['off'];
									}
									else if(ord($file_content[14]) == 1)
									{
									echo $str['on'];
									}
									else
									{
									echo $str['random'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/worm-placement.php?v=<?php echo ord($file_content[25]); ?>" alt="<?php echo $str['sch_editor_worm_placement']; ?>: <?php
									if(ord($file_content[25]) == 0)
									{
									echo $str['random'];
									}
									else
									{
									echo $str['manual'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td><img src="images/php/anchor-mode.php?v=<?php echo ord($file_content[11]); ?>" alt="<?php echo $str['sch_editor_anchor_mode']; ?>: <?php
									if(ord($file_content[11]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/stockpiling-mode.php?v=<?php echo ord($file_content[13]); ?>" alt="<?php echo $str['sch_editor_stockpiling_mode']; ?>: <?php
									if(ord($file_content[13]) == 0)
									{
									echo $str['off'];
									}
									else if(ord($file_content[13]) == 1)
									{
									echo $str['sch_editor_stockpiling_mode_acc'];
									}
									else
									{
									echo $str['sch_editor_stockpiling_mode_anti'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/donor-cards.php?v=<?php echo ord($file_content[18]); ?>" alt="<?php echo $str['sch_editor_stockpiling_mode']; ?>: <?php
									if(ord($file_content[18]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/fall-damage.php?v=<?php echo ord($file_content[10]); ?>" alt="<?php echo $str['sch_editor_fall_damage']; ?>: <?php echo ord($file_content[10]); ?>" width="68px" height="68px" /></td>
								</tr>
							</table>
						</fieldset>
					</td>
					<td rowspan="2" style="width: 150px;">
						<fieldset><legend><?php echo $str['sch_editor_time_settings']; ?></legend>
							<table class="table_no_borders">
								<tr>
									<td><img src="images/php/turn-time.php?v=<?php echo ord($file_content[27]); ?>" alt="<?php echo $str['sch_editor_turn_time']; ?>: <?php echo ord($file_content[27]); ?>" width="68px" height="68px" /></td>
									<td>Blah 2</td>
								</tr>
								<tr>
									<td>Blah 3</td>
									<td>Blah 4</td>
								</tr>
								<tr>
									<td>Blah 5</td>
									<td>Blah 6</td>
								</tr>
							</table>
						</fieldset>
					</td>
					<td rowspan="3">
						<fieldset><legend><?php echo $str['sch_editor_weapon_settings']; ?></legend>
							<p><img src="images/png/weapon-panel.png" alt="" /></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td>
						<fieldset><legend><?php echo $str['sch_editor_sch_view_action_replays']; ?></legend>
							<table class="table_no_borders" style="width: 80px">
								<tr>
									<td><img src="images/php/instant-replays.php?v=<?php echo ord($file_content[9]); ?>" alt="<?php echo $str['sch_editor_action_replays']; ?>: <?php
									if(ord($file_content[9]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
							</table>
						</fieldset>
					</td>
					<td colspan="2">
					<fieldset><legend><?php echo $str['sch_editor_hazardous_objects_settings']; ?></legend>
							<table class="table_no_borders">
								<tr>
									<td><img src="images/php/object-type-and-count.php?v=<?php echo ord($file_content[22]); ?>" alt="<?php echo $str['sch_editor_object_type']; ?>: <?php echo ord($file_content[22]); ?><br /><?php echo $str['sch_editor_object_count']; ?>: <?php echo ord($file_content[22]); ?>" width="68px" height="68px" /></td>
									<td><img src="images/php/dud-mines.php?v=<?php echo ord($file_content[24]); ?>" alt="<?php echo $str['sch_editor_dud_mines']; ?>:  <?php
									if(ord($file_content[24]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/worm-select.php?v=<?php echo ord($file_content[14]); ?>" alt="<?php echo $str['sch_editor_worm_select']; ?>: <?php
									if(ord($file_content[14]) == 0)
									{
									echo $str['off'];
									}
									else if(ord($file_content[14]) == 1)
									{
									echo $str['on'];
									}
									else
									{
									echo $str['random'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td colspan="2">Blah</td>
					<td>Blah</td>
					<td>Blah</td>
				</tr>
				<tr>
					<td colspan="4">Blah</td>
					<td>Blah</td>
				</tr>
			</table>
			<?php
		}
		else
		{
		echo $str['sch_editor_sch_viewer_error_invalid_sch_signature'];
		}
	}
	else
	{
		$parent_directory = 2;
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_error_title'];
		include('../../includes/haut-sans-session-start.php');

		$jeu = $str['category'];

		//Chemin de fer (19 septembre 2012)
		$lien1 = array($str['index'], '../../index.php');
		$lien2 = array('Worms Armageddon', '../index.php');
		$lien3 = array($str['sch_editor'], 'index.php');
		$page_actuelle = $str['sch_editor_sch_viewer_error_title'];

		include('../../includes/menu.php');
		
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_sch_viewer_error_scheme_not_found'].'</p>';
	}
}
else
{
$parent_directory = 2;
$titre = 'Worms Armageddon - '.$str['sch_editor_sch_viewer_error_title'];
include('../../includes/haut-sans-session-start.php');

$jeu = $str['category'];

//Chemin de fer (19 septembre 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
$page_actuelle = $str['sch_editor_sch_viewer_error_title'];

include('../../includes/menu.php');

echo '<h1>'.$str['error'].'</h1>';
echo '<p>'.$str['sch_editor_sch_viewer_error_no_id_specified'].'</p>';
}

include('includes/scheme-editor-bottom.php');
?>