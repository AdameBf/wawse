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

if (isset($_GET['id'])) // Yeah, we should rather make sure we're viewing an existing scheme, but first, an ID must have been specified.
{
	$id = (int) $_GET['id'];
	include('../../includes/connexion_pdo.php');
	
	$get_schemes_info = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
	$get_schemes_info->bindValue(':id', $id, PDO::PARAM_INT);
	$get_schemes_info->execute();
	
	$get_schemes_info_result = $get_schemes_info->fetch();
	
	if (!empty($get_schemes_info_result)) // Now check the ID.
	{
		$sch_name = $get_schemes_info_result['sch_name'];
		$sch_author = $get_schemes_info_result['sch_author'];
		
		$sch_id = $get_schemes_info_result['sch_id'];
		$sch_version_required = $get_schemes_info_result['sch_version_required'];
		$sch_download_count = $get_schemes_info_result['sch_download_count'];
		$sch_description = nl2br($get_schemes_info_result['sch_desc']);
		
		if ($sch_description == '')
		{
			$sch_description = '<em>'.$str['sch_editor_sch_viewer_sch_no_desc'].'</em>.';
		}
		
		$sch_created_on = date('d\/m\/Y', $get_schemes_info_result['sch_submit_date']);
		$sch_last_edited_on = date('d\/m\/Y', $get_schemes_info_result['sch_last_edit_date']);
		
		$get_schemes_info->closeCursor();
		
		// Get example replays.
		$get_example_replays = $bdd->prepare('SELECT * FROM sch_example_replays WHERE sch_id = :sch_id');
		$get_example_replays->bindValue(':sch_id', $sch_id, PDO::PARAM_INT);
		$get_example_replays->execute();
		
		$sch_example_replays = '';
		
		$c = 1;
		while ($get_example_replays_results = $get_example_replays->fetch())
		{
			if ($get_example_replays_results['sch_exrep_approvement_level'] == 1)
			{
				$sch_example_replays .= ' <a href="download-example-replay.php?id='.$get_example_replays_results['sch_exrep_id'].'">'.$c.'</a>';
			}

			$c++;
		}

		if (empty($sch_example_replays))
		{
			$sch_example_replays = ' <em>'.$str['sch_editor_sch_viewer_sch_no_example_replays'].'</em>';
		}

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
			echo '<h1>'.$page_actuelle.'</h1>'; // = current page, can't rename the variable because it would break a part of the script.
			echo '<p><strong>'.$str['sch_editor_sch_viewer_actions'].'</strong> <a href="scheme-editor.php?action=edit&amp;id='.$sch_id.'">'.$str['sch_editor_sch_viewer_edit_link'].'</a> - <a href="attach-replays.php?id='.$sch_id.'">'.$str['sch_editor_sch_viewer_add_exrep_link'].'</a> - <a href="replay-approving-interface.php?id='.$sch_id.'">'.$str['sch_editor_sch_viewer_handle_exrep_link'].'</a>.</p>';
			
			// First show general informations about the scheme
			$download_link_line = '<p><strong>'.$str['sch_editor_sch_viewer_sch_download_label'].'</strong> <a href="download.php?id='.$sch_id.'">'.$str['sch_editor_sch_viewer_sch_download_link'].'</a> ('.$str['sch_editor_sch_viewer_sch_download_count_downloaded'].' '.$get_schemes_info_result['sch_download_count'].' '.$str['sch_editor_sch_viewer_sch_download_count_times'].').<br />';
			$download_link_line = onceTwice($download_link_line);
			echo $download_link_line;
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_example_replays'].'</strong>'.$sch_example_replays.'.</p>';

			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_name'].'</strong> '.$sch_name.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_author'].'</strong> '.$sch_author.'.</p>';

			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_created_on'].'</strong> '.$sch_created_on.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_last_edited_on'].'</strong> '.$sch_last_edited_on.'.</p>';

			echo '<p><strong>'.$str['sch_editor_sch_viewer_sch_required_version'].'</strong> '.$sch_version_required.'.<br />';
			echo '<strong>'.$str['sch_editor_sch_viewer_sch_desc'].'</strong><br />'.$sch_description.'</p>';

			// Now, let's go with the settings. I think it should be better to get the whole file's content now.
			$file_content = file_get_contents($file_name);

			// Now let's start displaying information.
			?>
			<table class="table_no_borders" style="width: 610px; margin-left: 3%;">
				<tr>
					<td></td>
					<td style="width: 100px;"></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" style="width: 300px;">
						<fieldset><legend><?php echo $str['sch_editor_game_settings']; ?></legend>
							<table class="table_no_borders" style="width: 296px; margin: auto;">
								<tr>
									<td style="width: 74px"><img src="images/php/initial-worm-energy.php?v=<?php echo ord($file_content[26]); ?>" alt="<?php echo $str['sch_editor_initial_worm_energy']; ?>: <?php echo ord($file_content[26]); ?> HP." width="68px" height="68px" /></td>
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
					<td rowspan="2" style="width: 180px;">
						<fieldset style="height: 283px;"><legend><?php echo $str['sch_editor_time_settings']; ?></legend>
							<table class="table_no_borders" style="width: 155px;">
								<tr>
									<td style="width: 74px"><img src="images/php/turn-time.php?v=<?php echo ord($file_content[27]); ?>" alt="<?php echo $str['sch_editor_turn_time']; ?>: <?php echo ord($file_content[27]); ?>s" width="68px" height="68px" /></td>
									<td style="width: 74px"><img src="images/php/round-time.php?v=<?php echo ord($file_content[28]); ?>" alt="<?php echo $str['sch_editor_round_time']; ?>: <?php
									if(ord($file_content[28]) <= 127)
									{
										echo ord($file_content[28]).' min(s)';
									}
									else
									{
										$value = 256 - ord($file_content[28]); 
										echo $value.'s';
									}
									?>" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td style="width: 74px"><img src="images/php/land-retreat-time.php?v=<?php echo ord($file_content[6]); ?>" alt="<?php echo $str['sch_editor_retreat_time']; ?>: <?php echo ord($file_content[6]); ?>s" width="68px" height="68px" /></td>
									<td><img src="images/php/rope-retreat-time.php?v=<?php echo ord($file_content[7]); ?>" alt="<?php echo $str['sch_editor_retreat_time']; ?>: <?php echo ord($file_content[7]); ?>s" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td style="width: 74px"><img src="images/php/hotseat-time.php?v=<?php echo ord($file_content[5]); ?>" alt="<?php echo $str['sch_editor_hotseat_delay']; ?>: <?php echo ord($file_content[5]); ?>s" width="68px" height="68px" /></td>
									<td style="width: 74px"><img src="images/php/display-round-time.php?v=<?php echo ord($file_content[8]); ?>" alt="<?php echo $str['sch_editor_round_time_display']; ?>: <?php
									if(ord($file_content[8]) == 0)
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
					<td>
						<fieldset><legend><?php echo $str['sch_editor_weapon_upgrade_settings']; ?></legend>
							<table class="table_no_borders" style="width: 148px; margin: auto;">
								<tr>
									<td><img src="images/php/upgraded-grenade.php?v=<?php echo ord($file_content[35]); ?>" alt="<?php echo $str['sch_editor_upgraded_grenade']; ?>: <?php
									if(ord($file_content[35]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/upgraded-shotgun.php?v=<?php echo ord($file_content[36]); ?>" alt="<?php echo $str['sch_editor_upgraded_shotgun']; ?>: <?php
									if(ord($file_content[36]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td rowspan="2"><img src="images/php/aqua-sheep.php?v=<?php echo ord($file_content[31]); ?>" alt="<?php echo $str['sch_editor_aqua_sheep']; ?>: <?php
									if(ord($file_content[31]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td><img src="images/php/upgraded-clusters.php?v=<?php echo ord($file_content[37]); ?>" alt="<?php echo $str['sch_editor_upgraded_clusters']; ?>: <?php
									if(ord($file_content[37]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/upgraded-longbow.php?v=<?php echo ord($file_content[38]); ?>" alt="<?php echo $str['sch_editor_upgraded_longbow']; ?>: <?php
									if(ord($file_content[38]) == 0)
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
				</tr>
				<tr>
					<td>
						<fieldset><legend><?php echo $str['sch_editor_sch_view_action_replays']; ?></legend>
							<table class="table_no_borders" style="width: 80px; margin: auto;">
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
						<fieldset><legend><?php echo $str['sch_editor_hazardous_objects_settings_short']; ?></legend>
							<table class="table_no_borders" style="margin: auto;">
								<tr>
									<td><img src="images/php/object-type-and-count.php?v=<?php echo ord($file_content[22]); ?>" alt="<?php echo $str['sch_editor_object_type']; ?>: <?php echo ord($file_content[22]); ?><br /><?php echo $str['sch_editor_object_count']; ?>: <?php echo ord($file_content[22]); ?>" width="68px" height="68px" /></td>
									<?php
									if (ord($file_content[22]) % 2 == 1)
									{
									?>
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
										<td><img src="images/php/mine-fuse.php?v=<?php echo ord($file_content[23]); ?>" alt="<?php echo $str['sch_editor_mine_fuse']; ?>: <?php echo ord($file_content[23]); ?>" width="68px" height="68px" /></td>
									<?php
									}
									else
									{
									?>
										<td style="width: 68px; height: 68px;"></td>
										<td style="width: 68px; height: 68px;"></td>
									<?php
									}
									?>
								</tr>
							</table>
						</fieldset>
					</td>
					<td rowspan="2">
						<fieldset style="height: 283px;"><legend><?php echo $str['sch_editor_weapon_settings']; ?></legend>
							<table class="table_no_borders" style="margin: auto; text-align: center; margin-bottom: 4px;">
								<tr>
									<td><img src="images/php/team-weapons.php?v=<?php echo ord($file_content[39]); ?>" alt="<?php echo $str['sch_editor_team_weapons']; ?>: <?php
									if(ord($file_content[39]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" style="margin-right: 10px;" />
									<img src="images/php/super-weapons.php?v=<?php echo ord($file_content[40]); ?>" alt="<?php echo $str['sch_editor_super_weapons']; ?>: <?php
									if(ord($file_content[40]) == 0)
									{
										echo $str['off'];
									}
									else
									{
										echo $str['on'];
									}
									?>" /></td>
								</tr>
							</table>
							<?php
							if (weaponsInScheme($file_content) == true)
							{
							?>
							<!--[if lte IE 6]>
							<div style="height: 198px; padding: 1px; overflow: auto; border: 1px dotted #2F2F2F;">
							<![endif]-->
							<!--[if gte IE 7]>
							<div style="max-height: 198px; padding: 1px; overflow: auto; border: 1px dotted #2F2F2F;">
							<![endif]-->
							<!--[if !IE]><!-->
							<div style="max-height: 198px; padding: 1px; overflow: auto; border: 1px dotted #2F2F2F;">
							<!--<![endif]-->
							<table class="normal_table" style="text-align: center; padding-bottom: 0;">
								<tr>
									<th style="width: 20%"><?php echo $str['sch_editor_sch_viewer_weapon_column']; ?></th>
									<th style="width: 20%"><?php echo $str['sch_editor_sch_viewer_ammo_column']; ?></th>
									<th style="width: 20%"><?php echo $str['sch_editor_sch_viewer_power_column']; ?></th>
									<th style="width: 20%"><?php echo $str['sch_editor_sch_viewer_delay_column']; ?></th>
									<th><?php echo $str['sch_editor_sch_viewer_crate_prob_column']; ?></th>
								</tr>
								<?php
									$i = 0;

									while ($i <= 62)
									{
										if ($weapons_id[$i] < 39)
										{
											$ammo = ord($file_content[41 + $weapons_id[$i] * 4]);
											$power = ord($file_content[42 + $weapons_id[$i] * 4]) + 1;
											$delay = ord($file_content[43 + $weapons_id[$i] * 4]);
											$crate_probabilities = ord($file_content[44 + $weapons_id[$i] * 4]);
											
											if ($ammo == 10 OR $ammo > 127)
											{
												$ammo = $str['infinite_abbr'];
											}
											
											if ($delay > 127)
											{
												$delay = $str['infinite_abbr'];
											}
											
											if ($ammo !== 0 OR $crate_probabilities !== 0)
											{
											?>
											<tr>
												<td style="vertical-align: middle;"><img src="images/php/weapon-icon.php?v=<?php echo $i; ?>&amp;aquasheep=<?php echo ord($file_content[31]); ?>" alt="<?php echo $str['weapons_list'][$i]; ?>" title="<?php echo $str['weapons_list'][$i]; ?>" /></td>
												<td><?php echo $ammo; ?></td>
												<td><?php echo $power; ?></td>
												<td><?php echo $delay; ?></td>
												<td><?php echo $crate_probabilities; ?></td>
											</tr>
											<?php
											}

											$i++;
										}
										else if ($weapons_id[$i] == 39)
										{
											$ammo = ord($file_content[41 + $weapons_id[$i] * 4]);
											$power = ord($file_content[42 + $weapons_id[$i] * 4]) - 5; // Yes, we will display fuel units.
											$delay = ord($file_content[43 + $weapons_id[$i] * 4]);
											
											if ($ammo == 10 OR $ammo > 127)
											{
												$ammo = $str['infinite_abbr'];
											}
											
											if ($power == 0)
											{
												$power = $str['infinite_abbr'];
											}
											else if ($power < 0)
											{
												$power = 30;
											}
											
											if ($delay > 127)
											{
												$delay = $str['infinite_abbr'];
											}
											
											if ($ammo !== 0 OR ord($file_content[21]) != 0)
											{
											?>
											<tr>
												<td style="vertical-align: middle;"><img src="images/php/weapon-icon.php?v=<?php echo $i; ?>&amp;aquasheep=<?php echo ord($file_content[31]); ?>" alt="<?php echo $str['weapons_list'][$i]; ?>" title="<?php echo $str['weapons_list'][$i]; ?>" /></td>
												<td><?php echo $ammo; ?></td>
												<td><abbr title="<?php echo $str['sch_editor_sch_viewer_jp_power_hint']; ?>"><?php echo $power; ?></abbr></td>
												<td><?php echo $delay; ?></td>
												<td>-</td>
											</tr>
											<?php
											}

											$i++;
										}
										else if ($weapons_id[$i] >= 40 && $weapons_id[$i] != 44)
										{
											$ammo = ord($file_content[41 + $weapons_id[$i] * 4]);
											$delay = ord($file_content[43 + $weapons_id[$i] * 4]);

											if ($ammo == 10 OR $ammo > 127)
											{
												$ammo = $str['infinite_abbr'];
											}
											
											if ($delay > 127)
											{
												$delay = $str['infinite_abbr'];
											}
											
											if ($ammo !== 0)
											{
											?>
											<tr>
												<td style="vertical-align: middle;"><img src="images/php/weapon-icon.php?v=<?php echo $i; ?>&amp;aquasheep=<?php echo ord($file_content[31]); ?>" alt="<?php echo $str['weapons_list'][$i]; ?>" title="<?php echo $str['weapons_list'][$i]; ?>" /></td>
												<td><?php echo $ammo; ?></td>
												<td>-</td>
												<td><?php echo $delay; ?></td>
												<td>-</td>
											</tr>
											<?php
											}

											$i++;
										}
										else
										{
											$i++;
										}
									}
								?>
							</table>
							</div>
							<?php
							}
							else
							{
								echo '<p><em>'.$str['sch_editor_sch_viewer_no_weapons'].'</em></p>';
							}
							?>
							<p style="margin-top: 6px;"><?php echo $str['sch_editor_sch_viewer_double_damage']; ?>: <?php
							if (ord($file_content[217]) == 1)
							{
								echo $str['on'];
							}
							else if (ord($file_content[217]) == 0)
							{
								echo $str['off'];
							}
							else
							{
								echo $str['invalid_value'];
							}
							?>.</p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<fieldset><legend><?php echo $str['sch_editor_crate_probability_settings_short']; ?></legend>
							<?php
								// Let's calculate crate probabilities percentages.
								$crate_probabilities = crateProbabilitiesPercentages(ord($file_content[17]), ord($file_content[19]), ord($file_content[21]));
							?>
							<table class="table_no_borders" style="margin: auto; width: 170px; height: 154px;">
								<tr>
									<td><img src="images/png/crate-types/weapon-crate.png" alt="<?php echo $str['sch_editor_weapon_crate_probability']; ?>:" width="36px" height="36px" /></td>
									<td><?php echo $crate_probabilities[0]; ?> %</td>
									<td rowspan="3" style="padding-left: 18px;"><img src="images/php/health-crate-energy.php?v=<?php echo ord($file_content[20]); ?>" alt="<?php echo $str['sch_editor_initial_worm_energy']; ?>: <?php echo ord($file_content[20]); ?> HP." width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td><img src="images/png/crate-types/health-crate.png" alt="<?php echo $str['sch_editor_health_crate_probability']; ?>:" width="36px" height="36px" /></td>
									<td><?php echo $crate_probabilities[1]; ?> %</td>
								</tr>
								<tr>
									<td><img src="images/png/crate-types/utility-crate.png" alt="<?php echo $str['sch_editor_utility_crate_probability']; ?>:" width="36px" height="36px" /></td>
									<td><?php echo $crate_probabilities[2]; ?> %</td>
								</tr>
							</table>
						</fieldset>
					</td>
					<td>
						<fieldset><legend><?php echo $str['sch_editor_sudden_death_settings_abbr']; ?></legend>
							<table class="table_no_borders" style="margin: auto;">
								<tr>
									<td><img src="images/php/sudden-death-event.php?v=<?php echo ord($file_content[15]); ?>" alt="<?php echo $str['sch_editor_sudden_death_event']; ?>: <?php echo ord($file_content[15]).':';
									if(ord($file_content[15]) == 0)
									{
									echo $str['sch_edit_sd_round_ends'];
									}
									else if(ord($file_content[15]) == 1)
									{
									echo $str['sch_edit_sd_nuke'];
									}
									else if(ord($file_content[15]) == 2)
									{
									echo $str['sch_edit_sd_1hp'];
									}
									else
									{
									echo $str['sch_edit_sd_water_rise_only'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td><img src="images/php/sudden-death-water-rise-speed.php?v=<?php echo ord($file_content[16]); ?>" alt="<?php echo $str['sch_editor_water_rise_speed']; ?>: <?php echo ord($file_content[16]); ?>" <?php
									if (echoWaterRiseSpeedTitleAttribute(ord($file_content[16])) == true)
									{
										echo 'title="'.$str['sch_editor_water_rise_speed_img_title_attr'].'"';
									}
									?> width="68px" height="68px" /></td>
								</tr>
							</table>
						</fieldset>
					</td>
					<td>
						<fieldset><legend><?php echo $str['sch_editor_general_settings']; ?></legend>
							<table class="table_no_borders" style="margin: auto;">
								<tr>
									<td><img src="images/php/blood.php?v=<?php echo ord($file_content[30]); ?>" alt="<?php echo $str['sch_editor_blood_mode']; ?>: <?php echo ord($file_content[30]).':';
									if(ord($file_content[30]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/sheep-heaven.php?v=<?php echo ord($file_content[32]); ?>" alt="<?php echo $str['sch_editor_sheep_heaven']; ?>: <?php echo ord($file_content[32]).':';
									if(ord($file_content[32]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
								</tr>
								<tr>
									<td><img src="images/php/invincibility.php?v=<?php echo ord($file_content[33]); ?>" alt="<?php echo $str['sch_editor_invincibility']; ?>: <?php echo ord($file_content[33]).':';
									if(ord($file_content[33]) == 0)
									{
									echo $str['off'];
									}
									else
									{
									echo $str['on'];
									}
									?>" width="68px" height="68px" /></td>
									<td><img src="images/php/indestructible-land.php?v=<?php echo ord($file_content[34]); ?>" alt="<?php echo $str['sch_editor_invincibility']; ?>: <?php echo ord($file_content[34]).':';
									if(ord($file_content[34]) == 0)
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
				</tr>
				<tr>
					<td colspan="5">
						<fieldset><legend><?php echo $str['sch_editor_rubber_settings']; ?></legend>
						<?php
							// Firstly, let's see if the scheme is a RubberWorm one.
							if (isRubberScheme($file_content) == false)
							{
								echo '<p><em>'.$str['sch_editor_sch_viewer_not_a_rubber_scheme'].'</em></p>';
							}
							else
							{
								// Then, let's define the values into variables.

								// Custom Knocking Force
								$custom_knocking_force = round(ord($file_content[228]) / 100, 2);
								$custom_knocking_force .= '×';
								
								if ($custom_knocking_force == 0)
								{
									$custom_knocking_force = $str['default'].' (1×)';
								}
								
								// Speed
								$speed = ord($file_content[232]);
								
								if ($speed == 0)
								{
									$speed = $str['default'].' (16)';
								}
								
								// Values stored in the Earthquake crate probability byte (there are 5 of them).
								$earthquake_crate_probability = ord($file_content[240]);
								
								// - Automatic Reaiming.
								if ($earthquake_crate_probability % 2 == 1)
								{
									$auto_reaim = $str['on'];
								}
								else
								{
									$auto_reaim  = $str['off'];
								}

								// - Circular Aiming.
								if ($earthquake_crate_probability % 4 >= 2)
								{
									$cira = $str['on'];
								}
								else
								{
									$cira = $str['off'];
								}

								// - Antilock Power.
								if ($earthquake_crate_probability % 8 >= 4)
								{
									$alp = $str['on'];
								}
								else
								{
									$alp = $str['off'];
								}

								// - Unlock SDET Weapons.
								if ($earthquake_crate_probability % 16 >= 8)
								{
									$usw = $str['on'];
								}
								else
								{
									$usw = $str['off'];
								}
								
								// - Kaosmod.
								if ($earthquake_crate_probability % 32 >= 16)
								{
									if ($earthquake_crate_probability % 64 >= 32)
									{
										if ($earthquake_crate_probability % 128 >= 64)
										{
											$kaosmod = 4;
										}
										else
										{
											$kaosmod = 2;
										}
									}
									else if ($earthquake_crate_probability % 128 >= 64)
									{
										$kaosmod = 3;
									}
									else if ($earthquake_crate_probability >= 128)
									{
										$kaosmod = 5;
									}
									else
									{
										$kaosmod = 1;
									}
								}
								else
								{
									$kaosmod = $str['none'];
								}
								
								// Flames Limit
								$flames_limit = ord($file_content[244]) * 100;
								
								if ($flames_limit == 0)
								{
									$flames_limit = $str['default'].' (200)';
								}
								
								// Crate Limit
								$crate_limit = ord($file_content[256]);
								
								if ($crate_limit == 0)
								{
									$crate_limit = $str['default'].' (5)';
								}
								
								// Crate Rate
								$crate_rate = ord($file_content[260]);
								
								if ($crate_rate == 0)
								{
									$crate_rate = $str['default'].' (1)';
								}
								else
								{
									$crate_rate .= ' ('.$str['sch_editor_sch_viewer_with_crate_count_enabled'].')';
								}
								
								// Emulated Version.
								$emulated_version = $versions_list[ord($file_content[264]) + ord($file_content[224]) * 256];

								if ($emulated_version == 0)
								{
									$emulated_version = $str['none_2'];
								}

								// Friction
								$friction = ord($file_content[268]);

								if ($friction == 0)
								{
									$friction = $str['default'].' (96)';
								}
								else if ($friction == 100)
								{
									$friction = $str['sch_editor_sch_viewer_rubber_no_friction'].' (100)';
								}

								// Values stored in the Mole Squadron crate probability byte (there are 8 of them).
								$mole_squadron_crate_probability = ord($file_content[272]);

								// - Shot Doesn't End Turn.
								if ($mole_squadron_crate_probability % 2 == 1)
								{
									$sdet = $str['off']; // Reversing because I actually labelled that setting as Shot Ends Turn.
								}
								else
								{
									$sdet = $str['on'];
								}

								// - Loss of Control Doesn't End Turn.
								if ($mole_squadron_crate_probability % 4 >= 2)
								{
									$ldet = $str['off']; // Reversing because I actually labelled that setting as Loss of Control Ends Turn.
								}
								else
								{
									$ldet = $str['on'];
								}

								// - Fire Doesn't Pause Timer.
								if ($mole_squadron_crate_probability % 8 >= 4)
								{
									$fdpt = $str['on']; // And now I'm breaking a broken consistency, or something like that. Whatever.
								}
								else
								{
									$fdpt = $str['off'];
								}

								// - Improved Rope (a little similar to W2's).
								if ($mole_squadron_crate_probability % 16 >= 8)
								{
									$ir = $str['on'];
								}
								else
								{
									$ir = $str['off'];
								}
								
								// - Continuous Crate Shower.
								if ($mole_squadron_crate_probability % 32 >= 16)
								{
									$ccs = $str['on'];
								}
								else
								{
									$ccs = $str['off'];
								}
								
								// - All Objects can be Pushed by Explosions (OPE).
								if ($mole_squadron_crate_probability % 64 >= 32)
								{
									$ope = $str['on'];
								}
								else
								{
									$ope = $str['off'];
								}
								
								// - Weapons Don't Change Automatically.
								if ($mole_squadron_crate_probability % 128 >= 64)
								{
									$wdca = $str['on'];
								}
								else
								{
									$wdca = $str['off'];
								}
								
								// - Extended Fuse/Herd.
								if ($mole_squadron_crate_probability >= 128)
								{
									$fuseex = $str['on'];
								}
								else
								{
									$fuseex = $str['off'];
								}


								// Select Worm at Anytime during the Turn.
								$swat = ord($file_content[276]);
								
								if ($swat == 0)
								{
									$swat = $str['off'];
								}
								else
								{
									$swat = $str['on'];
								}

								// Air Resistance
								$air_resistance = ord($file_content[280]);
								
								if ($air_resistance == 0)
								{
									$air_resistance = $str['default'].' (0)';
								}
								else if ($air_resistance == 63)
								{
									$air_resistance = $str['sch_editor_sch_viewer_rubber_air_resistance_63'].' (63)';
								}
								
								if ($air_resistance % 2 == 1 OR $air_resistance == 63)
								{
									$air_resistance .= ' - '.$str['sch_editor_sch_viewer_rubber_affects_worms'];
								}
								else if ($air_resistance != 0)
								{
									$air_resistance .= ' - '.$str['sch_editor_sch_viewer_rubber_affects_objects'];
								}
								
								// Wind Influence
								$wind_influence = ord($file_content[284]);
								
								if ($wind_influence == 0)
								{
									$wind_influence = $str['default'].' (0)';
								}
								else if ($wind_influence == 255)
								{
									$wind_influence = $str['sch_editor_sch_viewer_rubber_wind_influence_bazooka'].' (255)';
								}

								if ($wind_influence % 2 == 1 OR $wind_influence == 255)
								{
									$wind_influence .= ' - '.$str['sch_editor_sch_viewer_rubber_affects_worms'];
								}
								else if ($wind_influence != 0)
								{
									$wind_influence .= ' - '.$str['sch_editor_sch_viewer_rubber_affects_objects'];
								}
								
								// Anti Worm Sink.
								$antisink = ord($file_content[288]);
								
								if ($antisink == 0)
								{
									$antisink = $str['off'];
								}
								else
								{
									$antisink = $str['on'];
								}
								
								// Gravity-related settings (stored in the Mail Strike's crate probability).
								$mail_strike_crate_probability = ord($file_content[292]);
								
								if ($mail_strike_crate_probability >= 128)
								{
									if ($mail_strike_crate_probability >= 192)
									{
										$black_hole = $str['sch_editor_sch_viewer_rubber_proportional_black_hole'];
										
										if($mail_strike_crate_probability >= 224)
										{
											$gravity = $mail_strike_crate_probability - 256;
										}
										else
										{
											$gravity = $mail_strike_crate_probability - 192;
										}
									}
									else
									{
										$black_hole = $str['sch_editor_sch_viewer_rubber_central_black_hole'];

										if ($mail_strike_crate_probability >= 160)
										{
											$gravity = $mail_strike_crate_probability - 192;
										}
										else
										{
											$gravity = $mail_strike_crate_probability - 128;
										}
									}
								}
								else
								{
									$black_hole = $str['off'];
									
									if ($mail_strike_crate_probability >= 64)
									{
										$gravity = $mail_strike_crate_probability - 128;
									}
									else if ($mail_strike_crate_probability != 0)
									{
										$gravity = $mail_strike_crate_probability;
									}
									else
									{
										$gravity = $str['default'].' (12)';
									}
								}
								
								// Worms Bounciness
								$worms_bounciness = round(ord($file_content[296]) / 2.55, 2);
								$worms_bounciness .= ' %';
								
								if ($worms_bounciness == 0)
								{
									$worms_bounciness = $str['default'].' (0%)';
								}
							?>
							<table class="table_no_borders" style="margin: auto;">
								<tr>
									<td width="50%"><strong><?php echo $str['sch_editor_rubber_sdet'].':</strong> '.$sdet; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_auto_reaim'].':</strong> '.$auto_reaim; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_usw'].':</strong> '.$usw; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_circular_aim'].':</strong> '.$cira; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_ldet'].':</strong> '.$ldet; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_antilock_power'].':</strong> '.$alp; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_fdpt'].':</strong> '.$fdpt; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_kaosmod'].':</strong> '.$kaosmod; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_improved_rope'].':</strong> '.$ir; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_knocking_force'].':</strong> '.$custom_knocking_force; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_ccs'].':</strong> '.$ccs; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_crate_rate'].':</strong> '.$crate_rate; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_ope'].':</strong> '.$ope; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_crate_limit'].':</strong> '.$crate_limit; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_wdca'].':</strong> '.$wdca; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_flames_limit'].':</strong> '.$flames_limit; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_fuseex'].':</strong> '.$fuseex; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_anti_worm_sink'].':</strong> '.$antisink; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_friction'].':</strong> '.$friction; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_speed'].':</strong> '.$speed; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_swat'].':</strong> '.$swat; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_wind_influence'].':</strong> '.$wind_influence; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_air_resistance'].':</strong> '.$air_resistance; ?>.</td>
									<td><strong><?php echo $str['sch_editor_rubber_worms_bounciness'].':</strong> '.$worms_bounciness; ?>.</td>
								</tr>
								<tr>
									<td><strong><?php echo $str['sch_editor_rubber_gravity_modifications'].':</strong> '.$gravity; ?>.</td>
									<td><strong><?php echo $str['sch_editor_sch_viewer_rubber_black_hole'].':</strong> '.$black_hole; ?>.</td>
								</tr>
								<tr>
									<td colspan="2" style="text-indent: 27%;"><strong><?php echo $str['sch_editor_sch_viewer_rubber_version_override'].':</strong> '.$emulated_version; ?>.</td>
								</tr>
							</table>
							<?php
							}
							?>
						</fieldset>
					</td>
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