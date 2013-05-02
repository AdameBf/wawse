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

$parent_directory = 2;

$jeu = $str['category'];

//Chemin de fer (2 août 2012)
$lien1 = array($str['index'], '../../index.php');
$lien2 = array('Worms Armageddon', '../index.php');
$lien3 = array($str['sch_editor'], 'index.php');
include('../../includes/connexion_pdo.php');

if (isset($_POST['action']))
{
	// First, get the action
	$action = $_POST['action'];

	switch ($action)
	{
	case 'create';

	$sch_name = htmlspecialchars(apostropheParse($_POST['sch_name']));

	// Introduced in v1.1.0: Schemes that aren't saved on the database can now be created. They're downloaded right ahead, without showing any confirmation page.
	if (!isset($_POST['no_database']))
	{
		$titre = 'Worms Armageddon - '.$str['sch_editor_sch_maker_title'];
		include('../../includes/haut-sans-session-start.php');

		$page_actuelle = $str['sch_editor_sch_maker_title'];
		include('../../includes/menu.php');

		echo '<h1>'.$str['sch_editor_sch_maker_title'].': '.$sch_name.'</h1>';
	}

	// First, let's make sure that we won't override a scheme before actually writing the file.
	if (isset($_SESSION['id']))
	{
		$sch_author_is_member = 1;
	}
	else
	{
		$sch_author_is_member = 0;
	}

	if ($sch_author_is_member === 1)
	{
		$sch_author = apostropheParse($_SESSION['pseudo']);
		$sch_password = null;
	}
	else
	{
		if(isset($_POST['sch_author']) AND !empty($_POST['sch_author']))
		{
			$sch_author = apostropheParse($_POST['sch_author']);
		}
		else
		{
			$sch_author = 'Anonymous';
		}

		if (isset($_POST['sch_password']) AND !empty($_POST['sch_password']))
		{
			$sch_password = sha1($_POST['sch_password']);
		}
		else
		{
			$sch_password = null;
		}
	}

	if (!isset($_POST['no_database']))
	{
		$query_check = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_name = :sch_name AND sch_author = :sch_author');
		$query_check->execute(array('sch_name' => apostropheParse($sch_name), 'sch_author' => apostropheParse($sch_author)));
		$query_check_result = $query_check->fetch();

		if (!empty($query_check_result))
		{
			echo '<p><strong>'.$str['warning'].'</strong> '.$str['error_scheme_name_by_scheme_author_already_exists'].'</p>';
			$query_check->closeCursor();

			// And the magic number is... the timestamp. :O
			$magic_number = time();
			$sch_name .= $magic_number;
		}
	}

	if (empty($sch_name))
	{
			$sch_name = 'Unnamed_scheme_'.time();
	}

	// Let's replace characters in the author name and the file name
	$sch_name_2 = fileNameParser($sch_name);
	$sch_author_2 = fileNameParser($sch_author);

		if (!isset($_POST['no_database']))
		{
			$file_name = 'schemes/'.$sch_name_2.'_by_'.$sch_author_2.'.wsc';
		}
		else
		{
			$file_name = $sch_name_2.'_by_'.$sch_author_2.'.wsc';
			
			// Code found on Stack Overflow.
			header('Cache-Control: public');
			header('Content-Description: File Transfer');
			header('Content-Length: '. filesize($file_name));
			header('Content-Disposition: attachment; filename='.$file_name);
			header('Content-Type: application/wa-scheme'); 
			header('Content-Transfer-Encoding: binary');
		}
	
		// Version required to run the scheme. It will be an array where the highest entry will be picked, with max().
		$version_required_array[] = 5; // Below, v2 schemes (might) crash the game.

		if (isset($_POST['round_time_2']))
		{
			$round_time_unit = (int) $_POST['round_time_2'];
			$round_time_value = (int) $_POST['round_time'];
			
			if ($round_time_unit === 1)
			{
				if ($round_time_value === 0)
				{
					$round_time_value = 1;
				}
				
				$round_time = 256 - $round_time_value;
			}
			else
			{
				$round_time = (int) $round_time_value;
			}
		}
		else
		{
			// Let's assume (s)he wanted the round time in minutes
			$round_time_value = (int) $_POST['round_time'];
			$round_time = (int) $round_time_value;
		}
		
		// Variables
		$hot_seat_delay = (int) $_POST['hotseat'];
		$retreat_time = (int) $_POST['retreat_time'];
		$rope_retreat_time = (int) $_POST['rope_retreat_time'];
		$turn_time = (int) $_POST['turn_time'];	
		$fall_damage_percentage = (int) $_POST['fall_damage'];
		$fall_damage_byte = dechex((($fall_damage_percentage / 4) * 41) % 128);
		$stockpiling_mode = (int) $_POST['stockpiling_mode'];
		$worm_select = (int) $_POST['worm_select'];
		$sudden_death_event = (int) $_POST['sudden_death_event'];
		$water_rise_speed = (int) $_POST['water_rise_speed'];
		$weapon_crate_probability = (int) $_POST['weapon_crate_probability'];
		$health_crate_probability = (int) $_POST['health_crate_probability'];
		$health_crate_energy = (int) $_POST['health_crate_energy'];
		$utility_crate_probability = (int) $_POST['utility_crate_probability'];
		$hazardous_object_type = (int) $_POST['object_type'];
		$hazardous_object_count = (int) $_POST['object_count'];
		$mine_fuse = (int) $_POST['mine_fuse'];
		$worm_placement = (int) $_POST['worm_placement'];
		$initial_worm_energy = (int) $_POST['initial_worm_energy'];
		$number_of_victories = (int) $_POST['number_of_victories'];

		// "Bool" values
		if (isset($_POST['round_time_display']))
		{
			$display_round_time = 0x01;
		}
		else
		{
			$display_round_time = 0x00;
		}

		if (isset($_POST['action_replays']))
		{
			$action_replays = 0x01;
		}
		else
		{
			$action_replays = 0x00;
		}

		if (isset($_POST['anchor_mode']))
		{
			$anchor_mode = 0x01;
		}
		else
		{
			$anchor_mode = 0x00;
		}

		if (isset($_POST['donor_cards']))
		{
			$donor_cards = 0x01;
		}
		else
		{
			$donor_cards = 0x00;
		}

		if (isset($_POST['dud_mines']))
		{
			$dud_mines = 0x01;
		}
		else
		{
			$dud_mines = 0x00;
		}

		if (isset($_POST['blood_mode']))
		{
			$blood_mode = 0x01;
		}
		else
		{
			$blood_mode = 0x00;
		}

		if (isset($_POST['aqua_sheep']))
		{
			$aqua_sheep = 0x01;
		}
		else
		{
			$aqua_sheep = 0x00;
		}

		if (isset($_POST['sheep_heaven']))
		{
			$sheep_heaven = 0x01;
		}
		else
		{
			$sheep_heaven = 0x00;
		}

		if (isset($_POST['invincibility']))
		{
			$invincibility = 0x01;
		}
		else
		{
			$invincibility = 0x00;
		}

		if (isset($_POST['indestructible_landscape']))
		{
			$indestructible_landscape = 0x01;
		}
		else
		{
			$indestructible_landscape = 0x00;
		}

		if (isset($_POST['upgraded_grenade']))
		{
			$upgraded_grenade = 0x01;
		}
		else
		{
			$upgraded_grenade = 0x00;
		}

		if (isset($_POST['upgraded_shotgun']))
		{
			$upgraded_shotgun = 0x01;
		}
		else
		{
			$upgraded_shotgun = 0x00;
		}

		if (isset($_POST['upgraded_clusters']))
		{
			$upgraded_clusters = 0x01;
		}
		else
		{
			$upgraded_clusters = 0x00;
		}

		if (isset($_POST['upgraded_longbow']))
		{
			$upgraded_longbow = 0x01;
		}
		else
		{
			$upgraded_longbow = 0x00;
		}

		if (isset($_POST['team_weapons']))
		{
			$team_weapons = 0x01;
		}
		else
		{
			$team_weapons = 0x00;
		}
	
		if (isset($_POST['upgraded_longbow']))
		{
			$super_weapons = 0x01;
		}
		else
		{
			$super_weapons = 0x00;
		}
	
		if (isset($_POST['double_damage']))
		{
			$double_damage = 0x01;
		}
		else
		{
			$double_damage = 0x00;
		}


		if ($hazardous_object_type === 0)
		{
			$hazardous_objects_byte = 0;
		}
		else if ($hazardous_object_type === 1 AND $hazardous_object_count === 8)
		{
			$hazardous_objects_byte = 1;
		}
		else if ($hazardous_object_type === 2 AND $hazardous_object_count === 8)
		{
			$hazardous_objects_byte = 2;
		}
		else if ($hazardous_object_type === 3 AND $hazardous_object_count === 8)
		{
			$hazardous_objects_byte = 5;
		}
		else
		{
			$hazardous_objects_byte = 8 + $hazardous_object_type + ($hazardous_object_count * 4);
			$version_required_array[] = 28;
		}


		if ($turn_time >= 128)
		{
			$version_required_array[] = 19.17;
		}
		if ($round_time >= 128)
		{
			$version_required_array[] = 28;
		}
		if ($worm_select === 2)
		{
			$version_required_array[] = 29;
		}
		if ($number_of_victories === 0)
		{
			$version_required_array[] = 29;
		}


		if (!isset($_POST['no_database']))
		{
			// Now, time to create the file.
			$scheme_file = fopen($file_name, 'w');
			fputs($scheme_file, 'SCHM'); // Scheme magic number (chars no.0-3)

			// Scheme version
			$sch_version = pack('h', 0x02);
			fputs($scheme_file, $sch_version); // Char no.4

			fputs($scheme_file, pack(packingFormat($hot_seat_delay), dechex($hot_seat_delay))); // Char no.5
			fputs($scheme_file, pack(packingFormat($retreat_time), dechex($retreat_time))); // Char no.6
			fputs($scheme_file, pack(packingFormat($rope_retreat_time), dechex($rope_retreat_time))); // Char no.7
			fputs($scheme_file, pack('h', $display_round_time)); // Char no.8
			fputs($scheme_file, pack('h', $action_replays)); // Char no.9
			fputs($scheme_file, pack(packingFormat($fall_damage_byte), dechex($fall_damage_byte))); // Char no.10
			fputs($scheme_file, pack('h', $anchor_mode)); // Char no.11
			fputs($scheme_file, pack('H2', dechex(0x5F))); // Char no.12, a byte unused by the game. I'll set a magic number telling the scheme has been created by this editor. Hex value: 0x5F, dec value: 95.
			fputs($scheme_file, pack('h', $stockpiling_mode)); // Char no.13
			fputs($scheme_file, pack('h', $worm_select)); // Char no.14
			fputs($scheme_file, pack('h', $sudden_death_event)); // Char no.15
			fputs($scheme_file, pack(packingFormat($water_rise_speed), dechex($water_rise_speed))); // Char no.16
			fputs($scheme_file, pack(packingFormat($weapon_crate_probability), dechex($weapon_crate_probability))); // Char no.17
			fputs($scheme_file, pack('h', $donor_cards)); // Char no.18
			fputs($scheme_file, pack(packingFormat($health_crate_probability), dechex($health_crate_probability))); // Char no.19
			fputs($scheme_file, pack(packingFormat($health_crate_energy), dechex($health_crate_energy))); // Char no.20
			fputs($scheme_file, pack(packingFormat($utility_crate_probability), dechex($utility_crate_probability))); // Char no.21
			fputs($scheme_file, pack(packingFormat($hazardous_objects_byte), dechex($hazardous_objects_byte))); // Char no.22
			fputs($scheme_file, pack(packingFormat($mine_fuse), dechex($mine_fuse))); // Char no.23
			fputs($scheme_file, pack('h', $dud_mines)); // Char no.24
			fputs($scheme_file, pack('h', $worm_placement)); // Char no.25
			fputs($scheme_file, pack(packingFormat($initial_worm_energy), dechex($initial_worm_energy))); // Char no.26
			fputs($scheme_file, pack(packingFormat($turn_time), dechex($turn_time))); // Char no.27
			fputs($scheme_file, pack(packingFormat($round_time), dechex($round_time))); // Char no.28
			fputs($scheme_file, pack(packingFormat($number_of_victories), dechex($number_of_victories))); // Char no.29
			fputs($scheme_file, pack('h', $blood_mode)); // Char no.30
			fputs($scheme_file, pack('h', $aqua_sheep)); // Char no.31
			fputs($scheme_file, pack('h', $sheep_heaven)); // Char no.32
			fputs($scheme_file, pack('h', $invincibility)); // Char no.33
			fputs($scheme_file, pack('h', $indestructible_landscape)); // Char no.34
			fputs($scheme_file, pack('h', $upgraded_grenade)); // Char no.35
			fputs($scheme_file, pack('h', $upgraded_shotgun)); // Char no.36
			fputs($scheme_file, pack('h', $upgraded_clusters)); // Char no.37
			fputs($scheme_file, pack('h', $upgraded_longbow)); // Char no.38
			fputs($scheme_file, pack('h', $team_weapons)); // Char no.39
			fputs($scheme_file, pack('h', $super_weapons)); // Char no.40
		}
		else
		{
			echo 'SCHM';
			echo chr(2);
			echo chr($hot_seat_delay);
			echo chr($retreat_time);
			echo chr($rope_retreat_time);
			echo chr($display_round_time);
			echo chr($action_replays);
			echo chr($fall_damage_byte);
			echo chr($anchor_mode);
			echo chr(95);
			echo chr($stockpiling_mode);
			echo chr($worm_select);
			echo chr($sudden_death_event);
			echo chr($water_rise_speed);
			echo chr($weapon_crate_probability);
			echo chr($donor_cards);
			echo chr($health_crate_probability);
			echo chr($health_crate_energy);
			echo chr($utility_crate_probability);
			echo chr($hazardous_objects_byte);
			echo chr($mine_fuse);
			echo chr($dud_mines);
			echo chr($worm_placement);
			echo chr($initial_worm_energy);
			echo chr($turn_time);
			echo chr($round_time);
			echo chr($number_of_victories);
			echo chr($blood_mode);
			echo chr($aqua_sheep);
			echo chr($sheep_heaven);
			echo chr($invincibility);
			echo chr($indestructible_landscape);
			echo chr($upgraded_grenade);
			echo chr($upgraded_shotgun);
			echo chr($upgraded_clusters);
			echo chr($upgraded_longbow);
			echo chr($team_weapons);
			echo chr($super_weapons);
		}
	
		// Weapons time! Good thing is that I can do some super-loops! :O
		$counter = 0;
	
		while($counter <= 38) // 1. All weapons supporting crate probabilities and power settings
		{
			$ammo = (int) $_POST['weap'.$counter.'_ammo'];
			$power = (int) $_POST['weap'.$counter.'_power'] - 1;
			$delay = (int) $_POST['weap'.$counter.'_delay'];
			$crates = (int) $_POST['weap'.$counter.'_crates'];

			if (!isset($_POST['no_database']))
			{
				fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
				fputs($scheme_file, pack(packingFormat($power), dechex($power)));	
				fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
				fputs($scheme_file, pack(packingFormat($crates), dechex($crates)));
			}
			else
			{
				echo chr($ammo);
				echo chr($power);
				echo chr($delay);
				echo chr($crates);
			}

		$counter++;
		}
	
		// 2. We just finished with standard weapons, so $counter == 39. The 39th (well, 40th actually) weapon is Jet Pack.
		$ammo = (int) $_POST['weap'.$counter.'_ammo'];
		$power = (int) 5 + $_POST['weap'.$counter.'_power'];
		$delay = (int) $_POST['weap'.$counter.'_delay'];
		$crates = 0;
	
		if ($power === 35) // Default value (5 + 30)
		{
			$power = 0; // Considered as power 1 in game
		}
		if ($power >= 5)
		{
			$version_required_array[] = 29;
		}
		
		if (!isset($_POST['no_database']))
		{
			fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
			fputs($scheme_file, pack(packingFormat($power), dechex($power)));	
			fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
			fputs($scheme_file, pack('h', dechex($crates)));
		}
		else
		{
			echo chr($ammo);
			echo chr($power);
			echo chr($delay);
			echo chr(0);
		}

		$counter++;

		// 3. Let's continue with other utilities
		while($counter <= 43)
		{
		$ammo = (int) $_POST['weap'.$counter.'_ammo'];
		$power = 0;
		$delay = (int) $_POST['weap'.$counter.'_delay'];
		$crates = 0;

		if (!isset($_POST['no_database']))
		{
			fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
			fputs($scheme_file, pack('h', dechex($power)));	
			fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
			fputs($scheme_file, pack('h', dechex($crates)));
		}
		else
		{
			echo chr($ammo);
			echo chr(0);
			echo chr($delay);
			echo chr(0);
		}

		$counter++;
		}

		// 4. Double damage
		if (!isset($_POST['no_database']))
		{
			fputs($scheme_file, pack('h', dechex($double_damage)));
			fputs($scheme_file, pack('h', 0));
			fputs($scheme_file, pack('h', 0));
			fputs($scheme_file, pack('h', 0));
		}
		else
		{
			echo chr($double_damage);
			echo chr(0);
			echo chr(0);
			echo chr(0);
		}
	
		$counter++;
	
		// 5. Super weapons and Rubber Worm settings
	
		// Some variables before starting
		// First, simple ones
		$rubber_required = false; // Will be changed below
		$laser_fix_required = false; // Will be changed below, only depends on flames limit

		$rubber_speed = (int) $_POST['rubber_speed'];
		$rubber_flames_limit = (int) $_POST['rubber_flames_limit'];
		$rubber_crate_limit = (int) $_POST['rubber_crate_limit'];
		$rubber_crate_rate = (int) $_POST['rubber_crate_rate'];
		$rubber_version_override = (int) $_POST['rubber_version_override'];
		$rubber_friction = (int) $_POST['rubber_friction'];
		$rubber_air_resistance = (int) $_POST['rubber_air_resistance'];
		$rubber_wind_influence = (int) $_POST['rubber_wind_influence'];
		$rubber_gravity_modifications = (int) $_POST['rubber_gravity_modifications'];
		$rubber_worms_bounciness = (int) $_POST['rubber_worms_bounciness'];
		$rubber_knocking_force = (int) $_POST['rubber_knocking_force'];

		// Anti sink
		if (isset($_POST['rubber_anti_sink']))
		{
			$rubber_anti_sink = 1;
		}
		else
		{
			$rubber_anti_sink = 0;
		}
	
		// Select worm anytime during the turn
		if (isset($_POST['rubber_swat']))
		{
			$rubber_swat = 1;
			$version_required = 31;
		}
		else
		{
			$rubber_swat = 0;
		}
	
		// Earthquake
		$rubber_earthquake = 0;
	
		if (isset($_POST['rubber_auto_reaim']))
		{
			$rubber_earthquake += 1;
		}
		if (isset($_POST['rubber_circular_aim']))
		{
			$rubber_earthquake += 2;
		}
		if (isset($_POST['rubber_antilock_power']))
		{
			$rubber_earthquake += 4;
		}
		if (isset($_POST['rubber_usw']))
		{
			$rubber_earthquake += 8;
		}
		if (isset($_POST['rubber_kaosmod'])) // It should be weird if the value doesn't exist, but nvm.
		{
			$rubber_kaosmod = (int) $_POST['rubber_kaosmod'];

			switch($rubber_kaosmod)
			{
				case 0;
				break;
			
				case 1;
				$rubber_earthquake += 16;
				break;
			
				case 2;
				$rubber_earthquake += 48;
				break;
			
				case 3;
				$rubber_earthquake += 80;
				break;
			
				case 4;
				$rubber_earthquake += 112;
				break;
			
				case 5;
				$rubber_earthquake += 144;
				break;
			
				default;
				break;
			}
		}

		if ($rubber_earthquake !== 0)
		{
		$version_required_array[] = 31;
		}
	
		// Mole Squadron
		$rubber_mole_squadron = 0;
	
		if (!isset($_POST['rubber_sdet']))
		{
			$rubber_mole_squadron += 1;
		}
		if (!isset($_POST['rubber_ldet']))
		{
			$rubber_mole_squadron += 2;
		}
		if (isset($_POST['rubber_fdpt']))
		{
			$rubber_mole_squadron += 4;
		}
		if (isset($_POST['rubber_improved_rope']))
		{
			$rubber_mole_squadron += 8;
		}
		if (isset($_POST['rubber_ccs']))
		{
			$rubber_mole_squadron += 16;
		}
		if (isset($_POST['rubber_ope']))
		{
			$rubber_mole_squadron += 32;
			$version_required_array[] = 31;
		}
		if (isset($_POST['rubber_wdca']))
		{
			$rubber_mole_squadron += 64;
			$version_required_array[] = 31;
		}
		if (isset($_POST['rubber_fuseex']))
		{
			$rubber_mole_squadron += 128;
			$version_required_array[] = 31;
		}

		if ($rubber_flames_limit !== 0)
		{
			$laser_fix_required = true;
			$version_required_array[] = 29;
		}
		if ($rubber_speed !== 0 OR $rubber_version_override > 82 OR $rubber_knocking_force !== 0)
		{
			$version_required_array[] = 31;
		}
		if ($rubber_version_override > 76)
		{
			$version_required_array[] = 29;
		}
		if ($rubber_version_override > 167)
		{
			$version_required_array[] = 32;
		}
		if ($rubber_version_override > 251)
		{
			$version_required_array[] = 33;
		}
		
		if ($rubber_version_override > 255)
		{
			// Then 2 bytes will be used to store the version number.
			$rubber_version_override -= 256; // Select Worm Crate Probability Byte Value will be truncated.
			$rubber_version_override_2 = 1; // Freeze Crate Probability Byte Value will be set to 1 to reflect the truncation.
		}
		else
		{
			$rubber_version_override_2 = 0; // Freeze Crate Probability.
		}

		$rubber_settings = array($rubber_version_override_2, $rubber_knocking_force, $rubber_speed, 0, $rubber_earthquake, $rubber_flames_limit, 0, 0, $rubber_crate_limit, $rubber_crate_rate, $rubber_version_override, $rubber_friction, $rubber_mole_squadron, $rubber_swat, $rubber_air_resistance, $rubber_wind_influence, $rubber_anti_sink, $rubber_gravity_modifications, $rubber_worms_bounciness);

		$rubber_max_value = max($rubber_settings);

		if ($rubber_max_value === 0)
		{
			$rubber_required = false;
		}
		else
		{
			$rubber_required = true;
			$version_required_array[] = 28;
		}
	
		// Time to store all that in the file, and we're finally done with it!
		while($counter <= 63)
		{
			$rubber_settings_array_key = $counter - 45;
		
			$ammo = (int) $_POST['weap'.$counter.'_ammo'];
			$power = 0;
			$delay = (int) $_POST['weap'.$counter.'_delay'];
			$crates = $rubber_settings[$rubber_settings_array_key];
		
			if (!isset($_POST['no_database']))
			{
				fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));
				fputs($scheme_file, pack('h', dechex($power)));
				fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));
				fputs($scheme_file, pack(packingFormat($crates), dechex($crates)));
			}
			else
			{
				echo chr($ammo);
				echo chr(0);
				echo chr($delay);
				echo chr($crates);
			}
		
			$counter++;
		}

		if (!isset($_POST['no_database']))
		{
			// We're done, finally. Now we can close that file.
			fclose($scheme_file);
		
			// Time to know the required version.
			$version_required = (string) max($version_required_array);
		
			// Parse description so it can be saved in the database
			$description = htmlspecialchars($_POST['sch_desc']);

			if ($version_required == 5)
			{
				$version_required_string = '3.5 Beta 1 or later';
			}
			else if ($version_required == 19.17)
			{
				$version_required_string = '3.6.'.$version_required.' Beta or later';
			}
			else if ($version_required == 32)
			{
				$version_required_string = '3.7.0.0 or later';
			}
			else if ($version_required == 33)
			{
				$version_required_string = '3.7.2.1 or later';
			}
			else
			{
				$version_required_string = '3.6.'.$version_required.'.0 Beta or later';
			}
		
			if ($rubber_required)
			{
				$version_required_string .= ' with RubberWorm';
			}
			if ($laser_fix_required AND !$rubber_required) // Flames limit feature
			{
				$version_required_string = '3.6.29.0 with Laser Fix or 3.6.31.0+ with RubberWorm';
			}
			else if ($laser_fix_required AND $rubber_required AND $version_required == 29)
			{
				$version_required_string = '3.6.29.0 with Laser Fix and RubberWorm or 3.6.31.0+ with RubberWorm';
			}
		
			if (isset($magic_number))
			{
			$timestamp = $magic_number;
			}
			else
			{
			$timestamp = time();
			}
			
			// Introduced in 0.5.1: who can upload example replays and do they have to be approved?
			if (isset($_POST['sch_exrep_permissions']))
			{
				$example_replays_permissions = (int) $_POST['sch_exrep_permissions'];

				if ($example_replays_permissions < 0 && $example_replays_permissions > 2)
				{
				$example_replays_permissions = 0;
				}
			}
			else
			{
			$example_replays_permissions = 0;
			}

			// Introduced in v1.1.0: is the scheme based on another one?
			if (isset($_POST['sch_id']))
			{
				$sch_based_on = (int) $_POST['sch_id'];
			}
			else
			{
				$sch_based_on = 0;
			}
			
			// We can store the scheme on the database, that thing I logged on almost 600 lines above.
			$create_scheme_query = $bdd->prepare('INSERT INTO schemes_list VALUES(\'\', :name, :author, :is_member, :password, :submit_date, :submit_date, :description, :version_required_string, 0, :example_replays_permissions, :based_on)');
			$create_scheme_query->execute(array(
			'name' => $sch_name,
			'author' => $sch_author,
			'is_member' => $sch_author_is_member,
			'password' => $sch_password,
			'submit_date' => $timestamp,
			'description' => $description,
			'version_required_string' => $version_required_string,
			'example_replays_permissions' => $example_replays_permissions,
			'based_on' => $sch_based_on));

			$scheme_get_id = $bdd->prepare('SELECT sch_id FROM schemes_list WHERE sch_name = :name');
			$scheme_get_id->execute(array('name' => $sch_name));
			$scheme_id = $scheme_get_id->fetch();
		
			// Last, but not least, let's show the user a friendly message telling the user his scheme has successfully been created, and that he can even download it himself.
			echo '<p>'.$str['sch_editor_scheme_succesfully_created_message'].'</p>';
			echo '<p><a href="download.php?id='.$scheme_id['sch_id'].'">'.$str['sch_editor_download_scheme_message'].'</a></p>';
		}
		else
		{
			// Much shorter: all there is to do is to read the file.
			readfile($file_name);
		}
	break;





	case 'edit';
	if (isset($_POST['sch_id']))
	{
		$sch_id = $_POST['sch_id'];
		
		// Check if the scheme exists.
		$query_check = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_id = :id');
		$query_check->execute(array('id' => $sch_id));
		$query_check_result = $query_check->fetch();
		
		if (!empty($query_check_result))
		{
			$sch_name = htmlspecialchars($query_check_result['sch_name']);
		
			$titre = 'Worms Armageddon - '.$str['sch_editor_sch_editing_title'].' '.$query_check_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$query_check_result['sch_author'].' (#'.$sch_id.')';
			include('../../includes/haut-sans-session-start.php');

			$page_actuelle = $str['sch_editor_sch_editing_title'].' '.$query_check_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$query_check_result['sch_author'].' (#'.$sch_id.')';
			include('../../includes/menu.php');
	
			echo '<h1>'.$str['sch_editor_sch_editing_title'].' '.$query_check_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$query_check_result['sch_author'].' (#'.$sch_id.')</h1>';
	
			// The version required to run the scheme should be recalculated, just in case.
			$version_required_array[] = 5; // Below, v2 schemes (might) crash the game.

			// Round time.
			if (isset($_POST['round_time_2']))
			{
				$round_time_unit = (int) $_POST['round_time_2'];
				$round_time_value = (int) $_POST['round_time'];
			
				if ($round_time_unit === 1)
				{
					if ($round_time_value === 0)
					{
						$round_time_value = 1;
					}
				
					$round_time = 256 - $round_time_value;
				}
				else
				{
					$round_time = (int) $round_time_value;
				}
			}
			else
			{
				// Let's assume (s)he wanted the round time in minutes
				$round_time_value = (int) $_POST['round_time'];
				$round_time = (int) $round_time_value;
			}
		
			// Variables
			$hot_seat_delay = (int) $_POST['hotseat'];
			$retreat_time = (int) $_POST['retreat_time'];
			$rope_retreat_time = (int) $_POST['rope_retreat_time'];
			$turn_time = (int) $_POST['turn_time'];	
			$fall_damage_percentage = (int) $_POST['fall_damage'];
			$fall_damage_byte = dechex((($fall_damage_percentage / 4) * 41) % 128);
			$stockpiling_mode = (int) $_POST['stockpiling_mode'];
			$worm_select = (int) $_POST['worm_select'];
			$sudden_death_event = (int) $_POST['sudden_death_event'];
			$water_rise_speed = (int) $_POST['water_rise_speed'];
			$weapon_crate_probability = (int) $_POST['weapon_crate_probability'];
			$health_crate_probability = (int) $_POST['health_crate_probability'];
			$health_crate_energy = (int) $_POST['health_crate_energy'];
			$utility_crate_probability = (int) $_POST['utility_crate_probability'];
			$hazardous_object_type = (int) $_POST['object_type'];
			$hazardous_object_count = (int) $_POST['object_count'];
			$mine_fuse = (int) $_POST['mine_fuse'];
			$worm_placement = (int) $_POST['worm_placement'];
			$initial_worm_energy = (int) $_POST['initial_worm_energy'];
			$number_of_victories = (int) $_POST['number_of_victories'];

			// "Bool" values
			if (isset($_POST['round_time_display']))
			{
				$display_round_time = 0x01;
			}
			else
			{
				$display_round_time = 0x00;
			}

			if (isset($_POST['action_replays']))
			{
				$action_replays = 0x01;
			}
			else
			{
				$action_replays = 0x00;
			}

			if (isset($_POST['anchor_mode']))
			{
				$anchor_mode = 0x01;
			}
			else
			{
				$anchor_mode = 0x00;
			}

			if (isset($_POST['donor_cards']))
			{
				$donor_cards = 0x01;
			}
			else
			{
				$donor_cards = 0x00;
			}

			if (isset($_POST['dud_mines']))
			{
				$dud_mines = 0x01;
			}
			else
			{
				$dud_mines = 0x00;
			}

			if (isset($_POST['blood_mode']))
			{
				$blood_mode = 0x01;
			}
			else
			{
				$blood_mode = 0x00;
			}

			if (isset($_POST['aqua_sheep']))
			{
				$aqua_sheep = 0x01;
			}
			else
			{
				$aqua_sheep = 0x00;
			}

			if (isset($_POST['sheep_heaven']))
			{
				$sheep_heaven = 0x01;
			}
			else
			{
				$sheep_heaven = 0x00;
			}

			if (isset($_POST['invincibility']))
			{
				$invincibility = 0x01;
			}
			else
			{
				$invincibility = 0x00;
			}

			if (isset($_POST['indestructible_landscape']))
			{
				$indestructible_landscape = 0x01;
			}
			else
			{
				$indestructible_landscape = 0x00;
			}

			if (isset($_POST['upgraded_grenade']))
			{
				$upgraded_grenade = 0x01;
			}
			else
			{
				$upgraded_grenade = 0x00;
			}

			if (isset($_POST['upgraded_shotgun']))
			{
				$upgraded_shotgun = 0x01;
			}
			else
			{
				$upgraded_shotgun = 0x00;
			}

			if (isset($_POST['upgraded_clusters']))
			{
				$upgraded_clusters = 0x01;
			}
			else
			{
				$upgraded_clusters = 0x00;
			}

			if (isset($_POST['upgraded_longbow']))
			{
				$upgraded_longbow = 0x01;
			}
			else
			{
				$upgraded_longbow = 0x00;
			}

			if (isset($_POST['team_weapons']))
			{
				$team_weapons = 0x01;
			}
			else
			{
				$team_weapons = 0x00;
			}
	
			if (isset($_POST['upgraded_longbow']))
			{
				$super_weapons = 0x01;
			}
			else
			{
				$super_weapons = 0x00;
			}
	
			if (isset($_POST['double_damage']))
			{
				$double_damage = 0x01;
			}
			else
			{
				$double_damage = 0x00;
			}


			if ($hazardous_object_type === 0)
			{
				$hazardous_objects_byte = 0;
			}
			else if ($hazardous_object_type === 1 AND $hazardous_object_count === 8)
			{
				$hazardous_objects_byte = 1;
			}
			else if ($hazardous_object_type === 2 AND $hazardous_object_count === 8)
			{
				$hazardous_objects_byte = 2;
			}
			else if ($hazardous_object_type === 3 AND $hazardous_object_count === 8)
			{
				$hazardous_objects_byte = 5;
			}
			else
			{
				$hazardous_objects_byte = 8 + $hazardous_object_type + ($hazardous_object_count * 4);
				$version_required_array[] = 28;
			}


			if ($turn_time >= 128)
			{
				$version_required_array[] = 19.17;
			}
			if ($round_time >= 128)
			{
				$version_required_array[] = 28;
			}
			if ($worm_select === 2)
			{
				$version_required_array[] = 29;
			}
			if ($number_of_victories === 0)
			{
				$version_required_array[] = 29;
			}


			// Now, time to edit the file: I'll just overwrite the previous one.
			$file_name = 'schemes/'.fileNameParser(apostropheParse($query_check_result['sch_name'])).'_by_'.fileNameParser(apostropheParse($query_check_result['sch_author'])).'.wsc';
			
			$scheme_file = fopen($file_name, 'w');
			fputs($scheme_file, 'SCHM'); // Scheme magic number (chars no.0-3)

			// Scheme version
			$sch_version = pack('h', 0x02);
			fputs($scheme_file, $sch_version); // Char no.4

			fputs($scheme_file, pack(packingFormat($hot_seat_delay), dechex($hot_seat_delay))); // Char no.5
			fputs($scheme_file, pack(packingFormat($retreat_time), dechex($retreat_time))); // Char no.6
			fputs($scheme_file, pack(packingFormat($rope_retreat_time), dechex($rope_retreat_time))); // Char no.7
			fputs($scheme_file, pack('h', $display_round_time)); // Char no.8
			fputs($scheme_file, pack('h', $action_replays)); // Char no.9
			fputs($scheme_file, pack(packingFormat($fall_damage_byte), $fall_damage_byte)); // Char no.10
			fputs($scheme_file, pack('h', $anchor_mode)); // Char no.11
			fputs($scheme_file, pack('H2', dechex(0x5F))); // Char no.12, a byte unused by the game. I'll set a magic number telling the scheme has been created by this editor. Hex value: 0x5F, dec value: 95.
			fputs($scheme_file, pack('h', $stockpiling_mode)); // Char no.13
			fputs($scheme_file, pack('h', $worm_select)); // Char no.14
			fputs($scheme_file, pack('h', $sudden_death_event)); // Char no.15
			fputs($scheme_file, pack(packingFormat($water_rise_speed), dechex($water_rise_speed))); // Char no.16
			fputs($scheme_file, pack(packingFormat($weapon_crate_probability), dechex($weapon_crate_probability))); // Char no.17
			fputs($scheme_file, pack('h', $donor_cards)); // Char no.18
			fputs($scheme_file, pack(packingFormat($health_crate_probability), dechex($health_crate_probability))); // Char no.19
			fputs($scheme_file, pack(packingFormat($health_crate_energy), dechex($health_crate_energy))); // Char no.20
			fputs($scheme_file, pack(packingFormat($utility_crate_probability), dechex($utility_crate_probability))); // Char no.21
			fputs($scheme_file, pack(packingFormat($hazardous_objects_byte), dechex($hazardous_objects_byte))); // Char no.22
			fputs($scheme_file, pack(packingFormat($mine_fuse), dechex($mine_fuse))); // Char no.23
			fputs($scheme_file, pack('h', $dud_mines)); // Char no.24
			fputs($scheme_file, pack('h', $worm_placement)); // Char no.25
			fputs($scheme_file, pack(packingFormat($initial_worm_energy), dechex($initial_worm_energy))); // Char no.26
			fputs($scheme_file, pack(packingFormat($turn_time), dechex($turn_time))); // Char no.27
			fputs($scheme_file, pack(packingFormat($round_time), dechex($round_time))); // Char no.28
			fputs($scheme_file, pack(packingFormat($number_of_victories), dechex($number_of_victories))); // Char no.29
			fputs($scheme_file, pack('h', $blood_mode)); // Char no.30
			fputs($scheme_file, pack('h', $aqua_sheep)); // Char no.31
			fputs($scheme_file, pack('h', $sheep_heaven)); // Char no.32
			fputs($scheme_file, pack('h', $invincibility)); // Char no.33
			fputs($scheme_file, pack('h', $indestructible_landscape)); // Char no.34
			fputs($scheme_file, pack('h', $upgraded_grenade)); // Char no.35
			fputs($scheme_file, pack('h', $upgraded_shotgun)); // Char no.36
			fputs($scheme_file, pack('h', $upgraded_clusters)); // Char no.37
			fputs($scheme_file, pack('h', $upgraded_longbow)); // Char no.38
			fputs($scheme_file, pack('h', $team_weapons)); // Char no.39
			fputs($scheme_file, pack('h', $super_weapons)); // Char no.40
	
			// Weapons time! Good thing is that I can do some super-loops! :O
			$counter = 0;
		
			while($counter <= 38) // 1. All weapons supporting crate probabilities and power settings
			{
				$ammo = (int) $_POST['weap'.$counter.'_ammo'];
				$power = (int) $_POST['weap'.$counter.'_power'] - 1;
				$delay = (int) $_POST['weap'.$counter.'_delay'];
				$crates = (int) $_POST['weap'.$counter.'_crates'];

				fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
				fputs($scheme_file, pack(packingFormat($power), dechex($power)));	
				fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
				fputs($scheme_file, pack(packingFormat($crates), dechex($crates)));

				$counter++;
			}
		
			// 2. We just finished with standard weapons, so $counter === 39. The 39th (well, 40th actually) weapon is Jet Pack.
			$ammo = (int) $_POST['weap'.$counter.'_ammo'];
			$power = (int) 5 + $_POST['weap'.$counter.'_power'];
			$delay = (int) $_POST['weap'.$counter.'_delay'];
			$crates = 0;
		
			if ($power === 35) // Default value (5 + 30)
			{
				$power = 0; // Considered as power 1 in game
			}
			if ($power >= 5)
			{
				$version_required_array[] = 29;
			}
		
			fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
			fputs($scheme_file, pack(packingFormat($power), dechex($power)));	
			fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
			fputs($scheme_file, pack('h', dechex($crates)));
		
			$counter++;

			// 3. Let's continue with other utilities
			while($counter <= 43)
			{
				$ammo = (int) $_POST['weap'.$counter.'_ammo'];
				$power = 0;
				$delay = (int) $_POST['weap'.$counter.'_delay'];
				$crates = 0;
			
				fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
				fputs($scheme_file, pack('h', dechex($power)));	
				fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
				fputs($scheme_file, pack('h', dechex($crates)));

				$counter++;
			}

			// 4. Double damage
			fputs($scheme_file, pack('h', dechex($double_damage)));	
			fputs($scheme_file, pack('h', 0));	
			fputs($scheme_file, pack('h', 0));	
			fputs($scheme_file, pack('h', 0));
		
			$counter++;
		
			// 5. Super weapons and Rubber Worm settings
		
			// Some variables before starting
			// First, simple ones
			$rubber_required = false; // Will be changed below.
			$laser_fix_required = false; // Will be changed below, only depends on flames limit.

			$rubber_speed = (int) $_POST['rubber_speed'];
			$rubber_flames_limit = (int) $_POST['rubber_flames_limit'];
			$rubber_crate_limit = (int) $_POST['rubber_crate_limit'];
			$rubber_crate_rate = (int) $_POST['rubber_crate_rate'];
			$rubber_version_override = (int) $_POST['rubber_version_override'];
			$rubber_friction = (int) $_POST['rubber_friction'];
			$rubber_air_resistance = (int) $_POST['rubber_air_resistance'];
			$rubber_wind_influence = (int) $_POST['rubber_wind_influence'];
			$rubber_gravity_modifications = (int) $_POST['rubber_gravity_modifications'];
			$rubber_worms_bounciness = (int) $_POST['rubber_worms_bounciness'];
			$rubber_knocking_force = (int) $_POST['rubber_knocking_force'];

			// Anti sink
			if (isset($_POST['rubber_anti_sink']))
			{
				$rubber_anti_sink = 1;
			}
			else
			{
				$rubber_anti_sink = 0;
			}
		
			// Select worm anytime during the turn
			if (isset($_POST['rubber_swat']))
			{
				$rubber_swat = 1;
				$version_required = 31;
			}
			else
			{
				$rubber_swat = 0;
			}
		
			// Earthquake
			$rubber_earthquake = 0;
		
			if (isset($_POST['rubber_auto_reaim']))
			{
				$rubber_earthquake += 1;
			}
			if (isset($_POST['rubber_circular_aim']))
			{
				$rubber_earthquake += 2;
			}
			if (isset($_POST['rubber_antilock_power']))
			{
				$rubber_earthquake += 4;
			}
			if (isset($_POST['rubber_usw']))
			{
				$rubber_earthquake += 8;
			}
			if (isset($_POST['rubber_kaosmod'])) // It should be weird if the value doesn't exist, but nvm.
			{
				$rubber_kaosmod = (int) $_POST['rubber_kaosmod'];
				switch($rubber_kaosmod)
				{
				case 0;
				break;
			
				case 1;
				$rubber_earthquake += 16;
				break;
			
				case 2;
				$rubber_earthquake += 48;
				break;
			
				case 3;
				$rubber_earthquake += 80;
				break;
			
				case 4;
				$rubber_earthquake += 112;
				break;
			
				case 5;
				$rubber_earthquake += 144;
				break;
			
				default;
				break;
				}
			}

			if ($rubber_earthquake !== 0)
			{
				$version_required_array[] = 31;
			}
		
			// Mole Squadron
			$rubber_mole_squadron = 0;
		
			if (!isset($_POST['rubber_sdet']))
			{
				$rubber_mole_squadron += 1;
			}
			if (!isset($_POST['rubber_ldet']))
			{
				$rubber_mole_squadron += 2;
			}
			if (isset($_POST['rubber_fdpt']))
			{
				$rubber_mole_squadron += 4;
			}
			if (isset($_POST['rubber_improved_rope']))
			{
				$rubber_mole_squadron += 8;
			}
			if (isset($_POST['rubber_ccs']))
			{
				$rubber_mole_squadron += 16;
			}
			if (isset($_POST['rubber_ope']))
			{
				$rubber_mole_squadron += 32;
				$version_required_array[] = 31;
			}
			if (isset($_POST['rubber_wdca']))
			{
				$rubber_mole_squadron += 64;
				$version_required_array[] = 31;
			}
			if (isset($_POST['rubber_fuseex']))
			{
				$rubber_mole_squadron += 128;
				$version_required_array[] = 31;
			}

			if ($rubber_flames_limit !== 0)
			{
				$laser_fix_required = true;
				$version_required_array[] = 29;
			}
			if ($rubber_speed !== 0 OR $rubber_version_override > 82 OR $rubber_knocking_force !== 0)
			{
				$version_required_array[] = 31;
			}
			if ($rubber_version_override > 76)
			{
				$version_required_array[] = 29;
			}
			if ($rubber_version_override > 167)
			{
				$version_required_array[] = 32;
			}
			if ($rubber_version_override > 251)
			{
				$version_required_array[] = 33;
			}
			
			if ($rubber_version_override > 255)
			{
				// Then 2 bytes will be used to store the version number.
				$rubber_version_override -= 256; // Select Worm Crate Probability Byte Value will be truncated.
				$rubber_version_override_2 = 1; // Freeze Crate Probability Byte Value will be set to 1 to reflect the truncation.
			}
			else
			{
				$rubber_version_override_2 = 0; // Freeze Crate Probability.
			}
		
			$rubber_settings = array($rubber_version_override_2, $rubber_knocking_force, $rubber_speed, 0, $rubber_earthquake, $rubber_flames_limit, 0, 0, $rubber_crate_limit, $rubber_crate_rate, $rubber_version_override, $rubber_friction, $rubber_mole_squadron, $rubber_swat, $rubber_air_resistance, $rubber_wind_influence, $rubber_anti_sink, $rubber_gravity_modifications, $rubber_worms_bounciness);

			$rubber_max_value = max($rubber_settings);
			if ($rubber_max_value === 0)
			{
				$rubber_required = false;
			}
			else
			{
				$rubber_required = true;
				$version_required_array[] = 28;
			}
		
			// Time to store all that in the file, and then we're finally done with it!
			while($counter <= 63)
			{
				$rubber_settings_array_key = $counter - 45;
			
				$ammo = (int) $_POST['weap'.$counter.'_ammo'];
				$power = 0;
				$delay = (int) $_POST['weap'.$counter.'_delay'];
				$crates = $rubber_settings[$rubber_settings_array_key];
			
				fputs($scheme_file, pack(packingFormat($ammo), dechex($ammo)));	
				fputs($scheme_file, pack('h', dechex($power)));	
				fputs($scheme_file, pack(packingFormat($delay), dechex($delay)));	
				fputs($scheme_file, pack(packingFormat($crates), dechex($crates)));
			
				$counter++;
			}

			// We're done, finally. Now we can close that file.
			fclose($scheme_file);

			// Time to know the required version.
			$version_required = (string) max($version_required_array);
			
			// Save the new password, if any.
			if (isset($_POST['no_password'])) // Having no password isn't recommended but is possible.
			{
				$sch_password = NULL;
			}
			else if ($_POST['sch_password'] != '') // Let's save the new password.
			{
				$sch_password = sha1($_POST['sch_password']);
			}
			else // The previous password is kept.
			{
				$sch_password = $query_check_result['sch_password'];
			}
		
			// Parse description so it can be saved in the database
			$description = htmlspecialchars($_POST['sch_desc']);

			if ($version_required == 5)
			{
				$version_required_string = '3.5 Beta 1 or later';
			}
			else if ($version_required == 19.17)
			{
				$version_required_string = '3.6.'.$version_required.' Beta or later';
			}
			else if ($version_required == 32)
			{
				$version_required_string = '3.7.0.0 or later';
			}
			else if ($version_required == 33)
			{
				$version_required_string = '3.7.2.1 or later';
			}
			else
			{
				$version_required_string = '3.6.'.$version_required.'.0 Beta or later';
			}
		
			if ($rubber_required)
			{
				$version_required_string .= ' with RubberWorm';
			}
			if ($laser_fix_required AND !$rubber_required) // Flames limit feature
			{
				$version_required_string = '3.6.29.0 with Laser Fix or 3.6.31.0+ with RubberWorm';
			}
			else if ($laser_fix_required AND $rubber_required AND $version_required == 29)
			{
				$version_required_string = '3.6.29.0 with Laser Fix and RubberWorm or 3.6.31.0+ with RubberWorm';
			}

			// Calculate this edit's timestamp.
			$last_edit_timestamp = time();
			
			// Introduced in 0.5.1: who can upload example replays and do they have to be approved?
			if (isset($_POST['sch_exrep_permissions']))
			{
				$example_replays_permissions = (int) $_POST['sch_exrep_permissions'];

				if ($example_replays_permissions < 0 && $example_replays_permissions > 2)
				{
				$example_replays_permissions = 0;
				}
			}
			else
			{
			$example_replays_permissions = 0;
			}
		
			// We can store the scheme on the database, that thing I logged on almost 600 lines above.
			$create_scheme_query = $bdd->prepare('UPDATE schemes_list SET sch_password = :password, sch_last_edit_date = :last_edit_date, sch_desc = :description, sch_version_required = :version_required_string, sch_example_replays_permissions = :example_replays_permissions WHERE sch_id = :id');
			$create_scheme_query->execute(array(
			'password' => $sch_password,
			'last_edit_date' => $last_edit_timestamp,
			'description' => $description,
			'version_required_string' => $version_required_string,
			'example_replays_permissions' => $example_replays_permissions,
			'id' => $sch_id
			));
	
			// Last, but not least, let's show the user a friendly message telling the user his scheme has successfully been edited, and that he can even download it himself.
			echo '<p>'.$str['sch_editor_scheme_succesfully_edited_message'].'</p>';
			echo '<p><a href="download.php?id='.$sch_id.'">'.$str['sch_editor_download_scheme_message'].'</a></p>';
		}
		else
		{
			$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
			include('../../includes/haut-sans-session-start.php');
			
			$page_actuelle = $str['sch_editor_sch_editing_title'];
			include('../../includes/menu.php');
			
			echo '<h1>'.$str['error'].'</h1>';
			echo '<p>'.$str['sch_editor_error_scheme_does_not_exist'].'</p>';
		}
	}
	else
	{
		$titre = 'Worms Armageddon - '.$str['sch_editor'].' - '.$str['error'];
		include('../../includes/haut-sans-session-start.php');

		$page_actuelle = $str['sch_editor_sch_editing_title'];
		include('../../includes/menu.php');
		
		echo '<h1>'.$str['error'].'</h1>';
		echo '<p>'.$str['sch_editor_error_no_id_specified'].'</p>';
	}
	break;





	case 'upload';
	$titre = 'Worms Armageddon - '.$str['sch_editor_sch_uploader_title'];
	include('../../includes/haut-sans-session-start.php');

	$page_actuelle = $str['sch_editor_sch_uploader_title'];
	include('../../includes/menu.php');
	?>
	<h1><?php echo $str['sch_editor_sch_uploader_title']; ?></h1>
	<?php
	// First, let's see if the file has successfully been sent without any errors
	if (isset($_FILES['sch_file']) AND $_FILES['sch_file']['error'] == 0)
	{
        // Then, does it have the correct size (221 bytes for v1 schemes, 297 bytes for v2 schemes)
        if ($_FILES['sch_file']['size'] === 297 OR $_FILES['sch_file']['size'] === 221)
        {
            // Is it the right format?
            $file_infos = pathinfo($_FILES['sch_file']['name']);
            $uploaded_file_format = $file_infos['extension'];
			$uploaded_file_name = apostropheParse($file_infos['filename']);
			$uploaded_file_name_2 = fileNameParser($file_infos['filename']);
			
			if ($_POST['sch_name'] != '') // Introduced in v1.0.0: has the user specified a scheme name? 
			{
				$database_sch_name = htmlspecialchars(apostropheParse($_POST['sch_name']));
				$sch_file_name = fileNameParser($database_sch_name);
			}
			else // If it is empty, the uploaded file's name will be used instead.
			{
				$database_sch_name = $uploaded_file_name;
				$sch_file_name = $uploaded_file_name_2;
			}
            
            if ($uploaded_file_format == 'wsc')
            {
                // Let's store the file in the database and on the server, though it requires checking
				if (isset($_SESSION['id']))
				{
				$sch_author = htmlspecialchars($_SESSION['pseudo']);
				$sch_author_2 = fileNameParser($sch_author);
				}
				else
				{
					if (!empty($_POST['sch_author']))
					{
					$sch_author = htmlspecialchars($_POST['sch_author']);
					$sch_author_2 = fileNameParser($sch_author);
					}
					else
					{
					$sch_author = 'Anonymous';
					$sch_author_2 = $sch_author;
					}
				}
				
				$query_check = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_name = :sch_name AND sch_author = :sch_author');
				$query_check->execute(array('sch_name' => $database_sch_name, 'sch_author' => $sch_author));
				$query_check_result = $query_check->fetch();

				if (!empty($query_check_result))
				{
					echo '<p><strong>'.$str['warning'].'</strong> '.$str['error_scheme_name_by_scheme_author_already_exists'].'</p>';
					$query_check->closeCursor();

					// The magic number will be the timestamp.
					$magic_number = time();
					$database_sch_name .= $magic_number;
					$sch_file_name .= $magic_number;
				}

				$sch_name = $sch_file_name.'_by_'.$sch_author_2; // Base name without extension
				$name = $sch_name.'.wsc';

				$file_content = file_get_contents($_FILES['sch_file']['tmp_name']);
				$errors = array();
				$fixes = array();

				if (substr($file_content, 0, 4) != 'SCHM')
				{
				$errors[] = $str['sch_editor_sch_upload_error_incorrect_signature'];
				}

				if (ord($file_content[4]) == 1)
				{
					if ($_FILES['sch_file']['size'] != 221)
					{
					$errors[] = $str['sch_editor_sch_upload_error_incorrect_size_v1'];
					}
					else
					{
					$file_size = 221;
					$version_required_array[] = 0;
					}
				}
				else if (ord($file_content[4]) == 2)
				{
					if ($_FILES['sch_file']['size'] != 297)
					{
					$errors[] = $str['sch_editor_sch_upload_error_incorrect_size_v2'];
					}
					else
					{
					$file_size = 297;
					$version_required_array[] = 5;
					}
				}
				else
				{
					$errors[] = $str['sch_editor_sch_upload_error_incorrect_version_byte'];
				}

				if (isset($file_size)) // $file_size should be set only if the file size is valid
				{
					$rubber_required = false;
					$laser_fix_required = false;

					for ($i = 5; $i < $file_size; $i++)
					{
						// Let's use a loop for the remainder of the file, and treat each case with a switch
						switch ($i)
						{
						case 6: case 10: case 17: case 19: case 21:
							if (ord($file_content[$i]) > 127)
							{
								$old_value = ord($file_content[$i]);
								$file_content[$i] = chr(127);
							
								if ($i === 6)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_retreat_time_fix']);
								}
								else if ($i === 17)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_weapon_crate_probability_fix']);
								}
								else if ($i === 19)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_health_crate_probability_fix']);
								}
								else if ($i === 21)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_utility_crate_probability_fix']);
								}
								else
								{
									$file_content[$i] = chr(1); // Let's reset it to the default value.

									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_fall_damage_fix']);
								}
							}
						break;
						
						case 13: case 14:
						if (ord($file_content[$i]) > 2)
						{
							$old_value = ord($file_content[$i]);

							if ($i === 13)
							{
								$file_content[$i] = chr(0);

								$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_stockpiling_mode_fix']);
							}
							else
							{
								$file_content[$i] = chr(1);

								$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_worm_selection_method_fix']);
							}
						}
						else if ($i === 14 AND ord($file_content[$i]) === 2)
						{
							$version_required_array[] = 29; // Random Worm Order requires v3.6.29.0, or later.
						}
						break;
						
						case 15:
						if (ord($file_content[$i]) > 3)
						{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(3);

							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sudden_death_event_fix']);
						}
						break;
						
						case 16:
						if (ord($file_content[$i]) > 63)
						{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(2);

							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sudden_death_water_rise_speed_fix']);
						}
						else if (ord($file_content[$i]) > 30 AND ord($file_content[$i]) % 2 === 0)
						{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(2);

							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sudden_death_water_rise_speed_fix']);
						}
						else if (ord($file_content[$i]) > 12 AND ord($file_content[$i]) % 4 === 0)
						{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(2);

							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sudden_death_water_rise_speed_fix']);
						}
						break;
						
						case 22:
						$invalid_values = array(3, 4, 6, 7, 8, 9, 10, 11, 248, 249, 250, 251, 252, 253, 254, 255);
						
						if (in_array(ord($file_content[$i]), $invalid_values))
						{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(5);

							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_object_type_and_count_fix']);
						}
						else if (ord($file_content[$i]) > 5) // Minimum version required: 3.6.28.0.
						{
							$version_required_array[] = 28;
						}
						break;
						
						case 26: // Initial Worm Energy
						if (ord($file_content[$i]) === 0)
						{
							$file_content[$i] = chr(1);
							
							$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_initial_worm_energy_fix']);
						}
						break;
						
						case 27: // Turn time
						if (ord($file_content[$i]) >= 128)
						{
						$file_content[$i] = chr(128); // While changing the required version, let's also set this value to 128.
						$version_required_array[] = 19.17;
						}
						break;
						
						case 28: // Round time
						if (ord($file_content[$i]) >= 128)
						{
						$version_required_array[] = 28;
						}
						break;
						
						case 29: // Number of wins
						if (ord($file_content[$i]) === 0)
						{
						$version_required_array[] = 29;
						}
						break;
						
						case 198: // Jetpack power setting
						if (ord($file_content[$i]) >= 5)
						{
							$version_required_array[] = 29;
						}
						break;
						
						case 256: case 260: case 268: case 280: case 284: case 288: case 292: case 296: // Rubber settings that have been implemented by Pisto.
						if (ord($file_content[$i]) !== 0)
						{
							$version_required_array[] = 28;
							$rubber_required = true;
						}
						break;
						
						case 228: case 232: case 240: case 276: // Rubber31-specific bytes.
						if (ord($file_content[$i]) != 0)
						{
							$rubber_required = true;
							$version_required_array[] = 31;
						}
						break;
						
						case 244: // Flames Limit, setting ported from LaserFix
						if (ord($file_content[$i]) !== 0)
						{
							$laser_fix_required = true;
							$version_required_array[] = 29;
						}
						break;
						
						case 224:
						if (ord($file_content[$i]) != 0)
						{
							$rubber_required = true;
							$version_required_array[] = 33;
							
							if (ord($file_content[$i]) != 1)
							{
								$old_value = ord($file_content[$i]);
								$file_content[$i] = chr(1);
								$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_freeze_cp_fix']);
							}
						}
						break;
						
						case 264: // Version Emulation.
						if (ord($file_content[$i]) != 0)
						{
							$rubber_required = true;

							if (ord($file_content[$i]) > 251)
							{
								$version_required_array[] = 33;
							}
							else if (ord($file_content[$i]) > 167)
							{
								$version_required_array[] = 32;
							}
							else if (ord($file_content[$i]) > 82)
							{
								$version_required_array[] = 31;
							}
							else if (ord($file_content[$i]) > 76)
							{
								$version_required_array[] = 29;
							}
							else
							{
								$version_required_array[] = 28;
							}
							
							if (ord($file_content[224]) == 1 AND ord($file_content[$i]) > 44)
							{
								$old_value = ord($file_content[$i]);
								$file_content[$i] = chr(44);
							}
						}
						break;
						
						case 272:
						if (ord($file_content[$i]) > 31)
						{
							$rubber_required = true;
							$version_required_array[] = 31;
						}
						else if (ord($file_content[$i]) != 0)
						{
							$rubber_required = true;
							$version_required_array[] = 28;
						}
						break;

						case 8: case 9: case 11: case 18: case 24: case 25: case 30: case 31: case 32: case 33: case 34: case 35: case 36: case 37: case 38: case 39: case 40: case 217: // All the bool values
						if (ord($file_content[$i]) > 1)
							{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(1);
							
								if ($i === 8)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_display_round_time_fix']);
								}
								else if ($i === 9)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_action_replay_fix']);
								}
								else if ($i === 11)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_anchor_mode_fix']);
								}
								else if ($i === 18)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_donor_cards_fix']);
								}
								else if ($i === 24)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_dud_mines_fix']);
								}
								else if ($i === 25)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_manual_placement_fix']);
								}
								else if ($i === 30)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_blood_mode_fix']);
								}
								else if ($i === 31)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_aqua_sheep_fix']);
								}
								else if ($i === 32)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sheep_heaven_fix']);
								}
								else if ($i === 33)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_invincibility_fix']);
								}
								else if ($i === 34)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_indestructible_land_fix']);
								}
								else if ($i === 35)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_upgraded_grenade_fix']);
								}
								else if ($i === 36)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_upgraded_shotgun_fix']);
								}
								else if ($i === 37)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_upgraded_clusters_fix']);
								}
								else if ($i === 38)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_upgraded_longbow_fix']);
								}
								else if ($i === 39)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_team_weapons_fix']);
								}
								else if ($i === 40)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_super_weapons_fix']);
								}
								else
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_double_damage_fix']);
								}
							}
						break;
						
						case 200: case 202: case 204: case 206: case 208: case 210: case 212: case 214: case 216: case 218: case 219: case 220: case 222: case 226: case 230: case 234: case 236: case 238: case 242: case 246: case 248: case 250: case 252: case 254: case 258: case 262: case 266: case 270: case 274: case 278: case 282: case 286: case 290: case 294: // Unused bytes (there are 34 of them!).
							if (ord($file_content[$i]) !== 0)
							{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(0);
							
								if ($i === 200)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_jp_cp_fix']);
								}
								else if ($i === 202)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_lg_p_fix']);
								}
								else if ($i === 204)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_lg_cp_fix']);
								}
								else if ($i === 206)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_ls_p_fix']);
								}
								else if ($i === 208)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_ls_cp_fix']);
								}
								else if ($i === 210)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_fw_p_fix']);
								}
								else if ($i === 212)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_fw_cp_fix']);
								}
								else if ($i === 214)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_invis_p_fix']);
								}
								else if ($i === 216)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_invis_cp_fix']);
								}
								else if ($i === 218)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_dd_p_fix']);
								}
								else if ($i === 219)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_dd_d_fix']);
								}
								else if ($i === 220)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_dd_cp_fix']);
								}
								else if ($i === 222)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_freeze_p_fix']);
								}
								else if ($i === 226)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sbb_p_fix']);
								}
								else if ($i === 230)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_minestr_p_fix']);
								}
								else if ($i === 234)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_gsp_p_fix']);
								}
								else if ($i === 236)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_gsp_cp_fix']);
								}
								else if ($i === 238)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_eq_p_fix']);
								}
								else if ($i === 242)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_scales_p_fix']);
								}
								else if ($i === 246)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_mvase_p_fix']);
								}
								else if ($i === 248)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_mvase_cp_fix']);
								}
								else if ($i === 250)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_carp_p_fix']);
								}
								else if ($i === 252)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_carp_cp_fix']);
								}
								else if ($i === 254)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_bullet_p_fix']);
								}
								else if ($i === 258)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_nuke_p_fix']);
								}
								else if ($i === 262)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sw_p_fix']);
								}
								else if ($i === 266)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sally_army_p_fix']);
								}
								else if ($i === 270)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_msquad_p_fix']);
								}
								else if ($i === 274)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_mbbomb_p_fix']);
								}
								else if ($i === 278)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_cdonkey_p_fix']);
								}
								else if ($i === 282)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sbomber_p_fix']);
								}
								else if ($i === 286)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_sheepstr_p_fix']);
								}
								else if ($i === 290)
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_mailstr_p_fix']);
								}
								else
								{
									$fixes[] = str_replace('%1', $old_value, $str['sch_editor_sch_upload_arma_p_fix']);
								}
							}
						break;
						}
					}
				}
				
				if (empty($errors))
				{
					$timestamp = time();
					if (isset($_POST['sch_password']) AND !empty($_POST['sch_password']))
					{
					$sch_password = sha1($_POST['sch_password']);
					}
					else
					{
					$sch_password = NULL;
					}
					
					if (isset($_SESSION['id']))
					{
					$sch_author_is_member = 1;
					$sch_password = NULL; // Confirming this, just in case a nasty guy redirected to this form
					}
					else
					{
					$sch_author_is_member = 0;
					}
					
					if (!empty($fixes))
					{
						file_put_contents($_FILES['sch_file']['tmp_name'], $file_content); // Let's update the file
					}

					$description = htmlspecialchars($_POST['sch_desc']);

					$version_required = max($version_required_array);

					if ($version_required == 5)
					{
						$version_required_string = '3.5 Beta 1 or later';
					}
					else if ($version_required == 19.17)
					{
						$version_required_string = '3.6.'.$version_required.' Beta or later';
					}
					else if ($version_required == 32)
					{
						$version_required_string = '3.7.0.0 or later';
					}
					else if ($version_required == 33)
					{
						$version_required_string = '3.7.2.1 or later';
					}
					else
					{
						$version_required_string = '3.6.'.$version_required.'.0 Beta or later';
					}
	
					if ($rubber_required)
					{
						$version_required_string .= ' with RubberWorm';
					}

					if ($laser_fix_required AND $rubber_required == false AND $version_required == 29) // Flames limit feature only.
					{
						$version_required_string = '3.6.29.0 with Laser Fix or 3.6.31.0+ with RubberWorm';
					}
					else if ($laser_fix_required AND $rubber_required AND $version_required == 29) // Flames limit + other Rubber features that don't require 3.6.31.0 or later.
					{
						$version_required_string = '3.6.29.0 with Laser Fix and RubberWorm or 3.6.31.0+ with RubberWorm';
					}
					
					// Introduced in 0.5.1: who can upload example replays and do they have to be approved?
					if (isset($_POST['sch_exrep_permissions']))
					{
						$example_replays_permissions = (int) $_POST['sch_exrep_permissions'];

						if ($example_replays_permissions < 0 && $example_replays_permissions > 2)
						{
							$example_replays_permissions = 0;
						}
					}
					else
					{
						$example_replays_permissions = 0;
					}

					move_uploaded_file($_FILES['sch_file']['tmp_name'], 'schemes/'.basename($name));
					$create_scheme_query = $bdd->prepare('INSERT INTO schemes_list VALUES(\'\', :name, :author, :is_member, :password, :submit_date, :submit_date, :description, :version_required_string, 0, :example_replays_permissions)');
					$create_scheme_query->execute(array(
					'name' => $database_sch_name,
					'author' => $sch_author,
					'is_member' => $sch_author_is_member,
					'password' => $sch_password,
					'submit_date' => $timestamp,
					'description' => $description,
					'version_required_string' => $version_required_string,
					'example_replays_permissions' => $example_replays_permissions
					));
					
					// Now, replay files.
					$i = 1;
					
					if (replayFileCheck($_FILES['sch_ex_rep1']))
					{
						$replay_file_name_without_extension = '['.$scheme_id['sch_id'].'.'.$sch_name.']_Example_Replay_'.$i;
						$replay_file_name = $replay_file_name_without_extension.'.WAgame';
						
						move_uploaded_file($_FILES['sch_ex_rep1']['tmp_name'], 'replays/'.basename($replay_file_name));
						$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, 0, "1")'); // Value 1 in last column because replays uploaded along with the scheme are automatically approved.
						$add_replay_query->execute(array(
						'sch_id' => $scheme_id['sch_id'],
						'file_name' => $replay_file_name_without_extension,
						'submit_date' => $timestamp
						));

						$i++;
					}
					if (replayFileCheck($_FILES['sch_ex_rep2']))
					{
						$replay_file_name_without_extension = '['.$scheme_id['sch_id'].'.'.$sch_name.']_Example_Replay_'.$i;
						$replay_file_name = $replay_file_name_without_extension.'.WAgame';
						
						move_uploaded_file($_FILES['sch_ex_rep2']['tmp_name'], 'replays/'.basename($replay_file_name));
						$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, 0, "1")');
						$add_replay_query->execute(array(
						'sch_id' => $scheme_id['sch_id'],
						'file_name' => $replay_file_name_without_extension,
						'submit_date' => $timestamp
						));

						$i++;
					}
					if (replayFileCheck($_FILES['sch_ex_rep3']))
					{
						$replay_file_name_without_extension = '['.$scheme_id['sch_id'].'.'.$sch_name.']_Example_Replay_'.$i;
						$replay_file_name = $replay_file_name_without_extension.'.WAgame';
						
						move_uploaded_file($_FILES['sch_ex_rep3']['tmp_name'], 'replays/'.basename($replay_file_name));
						$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, 0, "1")');
						$add_replay_query->execute(array(
						'sch_id' => $scheme_id['sch_id'],
						'file_name' => $replay_file_name_without_extension,
						'submit_date' => $timestamp
						));

						$i++;
					}
					if (replayFileCheck($_FILES['sch_ex_rep4']))
					{
						$replay_file_name_without_extension = '['.$scheme_id['sch_id'].'.'.$sch_name.']_Example_Replay_'.$i;
						$replay_file_name = $replay_file_name_without_extension.'.WAgame';
						
						move_uploaded_file($_FILES['sch_ex_rep4']['tmp_name'], 'replays/'.basename($replay_file_name));
						$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, 0, "1")');
						$add_replay_query->execute(array(
						'sch_id' => $scheme_id['sch_id'],
						'file_name' => $replay_file_name_without_extension,
						'submit_date' => $timestamp
						));

						$i++;
					}
					if (replayFileCheck($_FILES['sch_ex_rep5']))
					{
						$replay_file_name_without_extension = '['.$scheme_id['sch_id'].'.'.$sch_name.']_Example_Replay_'.$i;
						$replay_file_name = $replay_file_name_without_extension.'.WAgame';
						
						move_uploaded_file($_FILES['sch_ex_rep5']['tmp_name'], 'replays/'.basename($replay_file_name));
						$add_replay_query = $bdd->prepare('INSERT INTO sch_example_replays VALUES(\'\', :sch_id, :file_name, :submit_date, 0, "1")');
						$add_replay_query->execute(array(
						'sch_id' => $scheme_id['sch_id'],
						'file_name' => $replay_file_name_without_extension,
						'submit_date' => $timestamp
						));

						$i++;
					}
					
					// Last, but not least, let's show the user a friendly message telling the user his scheme has successfully been uploaded.
					echo '<p>'.$str['sch_editor_scheme_succesfully_uploaded_message'].'</p>';
					
					if (!empty($fixes))
					{
						echo '<p>'.$str['sch_editor_sch_upload_fixes_have_been_applied'].'</p>';
						echo '<ul>';
						$i = sizeof($fixes);

						for ($c = 0; $c < $i; $c++)
						{
							echo '<li>'.$fixes[$c].'</li>';
						}
				
					echo '</ul>';
					
					// Get the scheme ID so you can offer the user to download the scheme with fixes.
					$scheme_get_id = $bdd->prepare('SELECT sch_id FROM schemes_list WHERE sch_name = :name');
					$scheme_get_id->execute(array(
					'name' => $database_sch_name,
					));
					$scheme_id = $scheme_get_id->fetch();
					
					echo '<p><a href="download.php?id='.$scheme_id['sch_id'].'">'.$str['sch_editor_download_scheme_with_fixes_message'].'</a></p>';
					}
				}
				else
				{
					echo '<p>'.$str['sch_editor_sch_upload_error_invalid_scheme_file'].'</p>';
					echo '<ul>';
					$i = sizeof($errors);
				
					for ($c = 0; $c < $i; $c++)
					{
						echo '<li>'.$errors[$c].'</li>';
					}
				
				echo '</ul>';
				}
            }
			else
			{
				echo $str['sch_editor_sch_upload_error_incorrect_extension'];
			}
        }
		else
		{
		echo $str['sch_editor_sch_upload_error_incorrect_size'];
		}
	}
	else
	{
	echo $str['sch_editor_sch_upload_error_unknown'];
	}
	?>
	</p>
	<?php
	break;

	default;
	echo '<h1>'.$str['error'].'</h1>';
	echo '<p>'.$str['error_invalid_action'].'</p>';
	break;
	}
}

include('includes/scheme-editor-bottom.php');
?>