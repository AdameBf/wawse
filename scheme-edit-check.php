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
	
	$titre = 'Worms Armageddon - '.$str['sch_editor_sch_maker_title'];
	include('../../includes/haut-sans-session-start.php');

	$page_actuelle = $str['sch_editor_sch_maker_title'];
	include('../../includes/menu.php');

		$sch_name = $_POST['sch_name'];
	
		echo '<h1>'.$str['sch_editor_sch_maker_title'].': '.$sch_name.'</h1>';

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
		$sch_author = $_SESSION['pseudo'];
		$sch_password = null;
		}
		else
		{
			if(isset($_POST['sch_author']) AND !empty($_POST['sch_author']))
			{
				$sch_author = $_POST['sch_author'];
			}
			else
			{
				$sch_author = 'Anonymous';
			}
			
			if (isset($_POST['sch_password']) AND !empty($_POST['sch_password']))
			{
				$sch_password = sha1($_POST['password']);
			}
			else
			{
				$sch_password = null;
			}
		}

		$query_check = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_name = :sch_name AND sch_author = :sch_author');
		$query_check->execute(array('sch_name' => fileNameParser($sch_name), 'sch_author' => fileNameParser($sch_author)));
		$query_check_result = $query_check->fetch();

		if (!empty($query_check_result))
		{
			echo '<p><strong>'.$str['warning'].'</strong> '.$str['error_scheme_name_by_scheme_author_already_exists'].'</p>';
			$query_check->closeCursor();

			// And the magic number is... the timestamp. :O
			$magic_number = time();
			$sch_name .= $magic_number;
		}

		//Let's replace characters in the author name and the file name
		$sch_name = fileNameParser($sch_name);
		$sch_author = fileNameParser($sch_author);
		
		if (empty($sch_name))
		{
			$sch_name = 'Unnamed_scheme_'.time();
		}

		$file_name = 'schemes/'.$sch_name.'_by_'.$sch_author.'.wsc';
	
		// Latest version required to run the scheme. It will be an array where the highest data will be picked, with max()
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
		$worm_placement = (int) $_POST['mine_fuse'];
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

		if (isset($_POST['god_mode']))
		{
		$god_mode = 0x01;
		}
		else
		{
		$god_mode = 0x00;
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
		fputs($scheme_file, pack(packingFormat($round_time), dechex($round_time))); // Char no.28 - buggy value if it is set in seconds...
		fputs($scheme_file, pack(packingFormat($number_of_victories), dechex($number_of_victories))); // Char no.29
		fputs($scheme_file, pack('h', $blood_mode)); // Char no.30
		fputs($scheme_file, pack('h', $aqua_sheep)); // Char no.31
		fputs($scheme_file, pack('h', $sheep_heaven)); // Char no.32
		fputs($scheme_file, pack('h', $god_mode)); // Char no.33
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
		$rubber_enabled = false; // Will be changed below
		$laser_fix_enabled = false; // Will be changed below, only depends on flames limit

		$rubber_speed = (int) $_POST['rubber_speed'];
		$rubber_flames_limit = (int) $_POST['rubber_flames_limit'];
		$rubber_crate_limit = (int) $_POST['rubber_crate_limit'];
		$rubber_crate_rate = (int) $_POST['rubber_crate_rate'];
		$rubber_version_override = (int) $_POST['rubber_version_override'];
		$rubber_friction = (int) $_POST['rubber_friction'];
		$rubber_air_viscosity = (int) $_POST['rubber_air_viscosity'];
		$rubber_wind_influence = (int) $_POST['rubber_wind_influence'];
		$rubber_gravity_modifications = (int) $_POST['rubber_gravity_modifications'];
		$rubber_worms_bounciness = (int) $_POST['rubber_worms_bounciness'];

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
		$laser_fix_enabled = true;
		$version_required_array[] = 29;
		}
		if ($rubber_speed !== 0 OR $rubber_version_override > 82)
		{
		$version_required_array[] = 31;
		}
	
		$rubber_settings = array(0, 0, $rubber_speed, 0, $rubber_earthquake, $rubber_flames_limit, 0, 0, $rubber_crate_limit, $rubber_crate_rate, $rubber_version_override, $rubber_friction, $rubber_mole_squadron, $rubber_swat, 	$rubber_air_viscosity, $rubber_wind_influence, $rubber_anti_sink, $rubber_gravity_modifications, $rubber_worms_bounciness);

		$rubber_max_value = max($rubber_settings);
		if ($rubber_max_value === 0)
		{
		$rubber_enabled = false;
		}
		else
		{
		$rubber_enabled = true;
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
	
		// Parse description so it can be saved in the database
		$description = htmlspecialchars($_POST['sch_desc']);

		if ($version_required == 5)
		{
		$version_required_string = '3.5 Beta 1';
		}
		else if ($version_required == 19.17)
		{
		$version_required_string = '3.6.'.$version_required.' Beta';
		}
		else
		{
		$version_required_string = '3.6.'.$version_required.'.0 Beta';
		}
	
		if ($rubber_enabled)
		{
		$version_required_string .= ' with RubberWorm';
		}
		if ($rubber_enabled AND $version_required === 31)
		{
		$version_required_string = '3.6.31.0 with RubberWorm31';
		}
		if ($laser_fix_enabled) // Flames limit feature
		{
		$version_required_string = '3.6.29.0 with Laser Fix or 3.6.31.0 with RubberWorm31';
		}
	
		if (isset($magic_number))
		{
		$timestamp = $magic_number;
		}
		else
		{
		$timestamp = time();
		}
	
		// We can store the scheme on the database, that thingie I logged on almost 600 lines above.
		$create_scheme_query = $bdd->prepare('INSERT INTO schemes_list VALUES(\'\', :name, :author, :is_member, :password, :submit_date, :submit_date, :description, :version_required_string, 0)');
		$create_scheme_query->execute(array(
		'name' => $sch_name,
		'author' => $sch_author,
		'is_member' => $sch_author_is_member,
		'password' => $sch_password,
		'submit_date' => $timestamp,
		'description' => $description,
		'version_required_string' => $version_required_string
		));

		$scheme_get_id = $bdd->prepare('SELECT sch_id FROM schemes_list WHERE sch_name = :name');
		$scheme_get_id->execute(array(
		'name' => $sch_name,
		));
		$scheme_id = $scheme_get_id->fetch();
	
		// Last, but not least, let's show the user a friendly message telling the user his scheme has successfully been created, and that he can even download it himself.
		echo '<p>'.$str['sch_editor_scheme_succesfully_created_message'].'</p>';
		echo '<p><a href="http://www.worms-univers.com/worms-armageddon/scheme-editor/download.php?id='.$scheme_id['sch_id'].'">'.$str['sch_editor_download_scheme_message'].'</a></p>';

	break;

	case 'edit';
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
            $uploaded_file_name = fileNameParser($file_infos['filename']);
            $allowed_format = array('wsc');
            if (in_array($uploaded_file_format, $allowed_format))
            {
                // Let's store the file in the database and on the server, though it requires checking
				if (isset($_SESSION['id']))
				{
				$sch_author = fileNameParser($_SESSION['pseudo']);
				}
				else
				{
				$sch_author = fileNameParser($_POST['sch_author']);
				}
				
				$query_check = $bdd->prepare('SELECT * FROM schemes_list WHERE sch_name = :sch_name AND sch_author = :sch_author');
				$query_check->execute(array('sch_name' => $uploaded_file_name, 'sch_author' => $sch_author));
				$query_check_result = $query_check->fetch();

				if (!empty($query_check_result))
				{
					echo '<p><strong>'.$str['warning'].'</strong> '.$str['error_scheme_name_by_scheme_author_already_exists'].'</p>';
					$query_check->closeCursor();

					// And the magic number is... the timestamp. :O
					$magic_number = time();
					$uploaded_file_name .= $magic_number;
				}
			
				$name = $uploaded_file_name.'_by_'.$sch_author.'.'.$uploaded_file_format;
				$sch_name = $uploaded_file_name.'_by_'.$sch_author; // Base name without extension
				
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
					$rubber_enabled = false;
					$laser_fix_enabled = false;
					for ($i = 5; $i < $file_size; $i++)
					{
						// Let's use a loop for the remainder of the file, and treat each case with a switch
						switch ($i)
						{
						case 5: case 6: case 7: case 10: case 17: case 19: case 21:
							if (ord($file_content[$i]) > 127)
							{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(127);
							
								if ($i === 5)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Le temps de réflexion avant les tours a été remis à 127 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Hotseat Time byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else if ($i === 6)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Le temps de retraite a été remis à 127 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Land Retreat Time byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else if ($i === 7)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Le temps de retraite après avoir lâché une arme depuis la corde a été remis à 127 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Rope Retreat Time byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else if ($i === 17)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La probabilité d\'apparition d\'une caisse d\'armes a été remise à 127 (elle était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Weapon Crate Probability byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else if ($i === 19)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La probabilité d\'apparition d\'une caisse de santé a été remise à 127 (elle était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Health Crate Probability byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else if ($i === 21)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La probabilité d\'apparition d\'une caisse d\'utilitaires a été remise à 127 (elle était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Utility Crate Probability byte value has been reset to 127 (was '.$old_value.')';
									}
								}
								else
								{
								$file_content[$i] = chr(1); // Let's reset it to the default value.
									if ($language === 'fr')
									{
									$fixes[] = 'L\'octet activant les dégâts de chute a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Fall Damage byte value has been reset to 1 (was '.$old_value.')';
									}
								}
							}
						break;
						
						case 13: case 14:
						if (ord($file_content[$i]) > 2)
						{
						$old_value = ord($file_content[$i]);

							if ($i === 13)
							{
							$file_content[$i] = chr(2);
								if ($language === 'fr')
								{
								$fixes[] = 'La méthode de stockage des munitions a été mise à "anti-accumulation" (la valeur était à '.$old_value.')';
								}
								else
								{
								$fixes[] = 'The Stockpiling Mode byte value has been set to 2, i.e. anti-accumulative (was '.$old_value.')';
								}
							}
							else
							{
							$file_content[$i] = chr(1);
								if ($language == 'fr')
								{
								$fixes[] = 'La méthode de sélection de ver au début d\'un tour a été mise à "manuel" (la valeur était à '.$old_value.')';
								}
								else
								{
								$fixes[] = 'The Worm Selection method at the beginning of a turn has been set to "manual" (the byte value was '.$old_value.')';
								}
							}
						}
						else if ($i === 14 AND ord($file_content[$i]) === 2)
						{
						$version_required_array[] = 29;
						}
						break;
						
						case 15:
						if (ord($file_content[$i]) > 3)
						{
						$old_value = ord($file_content[$i]);
						$file_content[$i] = chr(3);
							if ($language == 'fr')
							{
							$fixes[] = 'L\'évènement qui arrive à la mort subite a été mis à "montée de l\'eau uniquement" (la valeur était à '.$old_value.')';
							}
							else
							{
							$fixes[] = 'The Sudden Death Event has been set to "Water Rise only" (the byte value was '.$old_value.')';
							}
						}
						break;
						
						case 16:
						if (ord($file_content[$i]) > 63)
						{
						$old_value = ord($file_content[$i]);
						$file_content[$i] = chr(2);

							if ($language == 'fr')
							{
							$fixes[] = 'La vitesse de la montée de l\'eau à la mort subite a été mise à 20 pixels par tour (l\'octet valait '.$old_value.')';
							}
							else
							{
							$fixes[] = 'The Sudden Death Water Rise Speed has been set to 20 pixels/turn (the byte value was '.$old_value.')';
							}
						}
						else if (ord($file_content[$i]) > 30 AND ord($file_content[$i]) % 2 === 0)
						{
						$old_value = ord($file_content[$i]);
						$file_content[$i] = chr(2);

							if ($language == 'fr')
							{
							$fixes[] = 'La vitesse de la montée de l\'eau à la mort subite a été mise à 20 pixels par tour (l\'octet valait '.$old_value.')';
							}
							else
							{
							$fixes[] = 'The Sudden Death Water Rise Speed has been set to 20 pixels/turn (the byte value was '.$old_value.')';
							}
						}
						else if (ord($file_content[$i]) > 12 AND ord($file_content[$i]) % 4 === 0)
						{
						$old_value = ord($file_content[$i]);
						$file_content[$i] = chr(2);

							if ($language == 'fr')
							{
							$fixes[] = 'La vitesse de la montée de l\'eau à la mort subite a été mise à 20 pixels par tour (l\'octet valait '.$old_value.')';
							}
							else
							{
							$fixes[] = 'The Sudden Death Water Rise Speed has been set to 20 pixels/turn (the byte value was '.$old_value.')';
							}
						}
						break;
						
						case 22:
						$invalid_values = array(3, 4, 6, 7, 8, 9, 10, 11, 248, 249, 250, 251, 252, 253, 254, 255);
						
						if (in_array(ord($file_content[$i]), $invalid_values))
						{
						$old_value = ord($file_content[$i]);
						$file_content[$i] = chr(5);

							if ($language == 'fr')
							{
							$fixes[] = 'Le type d\'objets a été mis sur "les deux", et le nombre d\'objets à 8 (l\'octet stockant ces deux informations valait '.$old_value.')';
							}
							else
							{
							$fixes[] = 'The Hazardous Object Type has been set to "both", and the Max Object Count has been set to 8 (the byte controlling both settings\'s value was '.$old_value.')';
							}
						}
						else if (ord($file_content[$i]) > 5) // Minimum version required: 3.6.28.0.
						{
						$version_required_array[] = 28;
						}
						break;
						
						case 26: // Initial Worm Energy
						if (ord($file_content[$i]) === 0)
						{
							if ($language == 'fr')
							{
							$fixes[] = 'La santé initiale des vers a été mise à 1 (elle était à 0)';
							}
							else
							{
							$fixes[] = 'The Initial Worm Energy has been set to 1 (was 0)';
							}
						}
						break;
						
						case 27: // Turn time
						if (ord($file_content[$i]) >= 128)
						{
						$file_content[$i] = chr(128); // Let's use this version required calculation to reset the byte to 128
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
						
						case 256: case 260: case 268: case 280: case 284: case 288: case 292: case 296: // Rubber settings
						if (ord($file_content[$i]) !== 0)
						{
						$version_required_array[] = 28;
						$rubber_required = true;
						}
						break;
						
						case 232: case 240: case 276: // Rubber 31 settings
						if (ord($file_content[$i]) !== 0)
						{
						$version_required_array[] = 31;
						$rubber_required = true;
						}
						break;
						
						case 244: // Flames limit, setting ported from LaserFix
						if (ord($file_content[$i]) !== 0)
						{
						$laser_fix_enabled = true;
						$version_required_array[] = 29;
						}
						break;
						
						case 264:
						if (ord($file_content[$i]) > 82)
						{
						$rubber_required = true;
						$version_required_array[] = 31;
						}
						break;
						
						case 272:
						if (ord($file_content[$i]) > 31)
						{
						$rubber_required = true;
						$version_required_array[] = 31;
						}
						break;

						case 8: case 9: case 11: case 18: case 24: case 25: case 30: case 31: case 32: case 33: case 34: case 35: case 36: case 37: case 38: case 39: case 40: case 217: // All the bool values
						if (ord($file_content[$i]) > 1)
							{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(1);
							
								if ($i === 8)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'L\'octet activant l\'affichage du temps de la manche a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Display Round Time byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 9)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'L\'octet activant les replays instantanés a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Action Replay byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 11)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode artillerie a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Anchor Mode byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 18)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant les cartes de donneur a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Donor Cards byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 24)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant les mines mortes a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Dud Mines byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 25)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le placement manuel a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Manual Placement byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 30)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode sang a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Blood Mode byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 31)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mouton aquatique a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Aqua Sheep byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 32)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode paradis des moutons a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Sheep Heaven byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 33)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode divin a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The God Mode byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 34)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode terrain indestructible a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Indestructible Land byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 35)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode grenade améliorée a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Upgraded Grenade byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 36)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode fusil de chasse amélioré a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Upgraded Shotgun byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 37)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode armes à fragments améliorées a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Upgraded Clusters byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 38)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant le mode arc améliorée a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Upgraded Longbow byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 39)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant les armes d\'équipe a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Team Weapons byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else if ($i === 40)
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant les super armes a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Super Weapons byte value has been reset to 1 (was '.$old_value.')';
									}
								}
								else
								{
									if ($language == 'fr')
									{
									$fixes[] = 'L\'octet activant les dégâts doublés au premier tour a été remis à 1 (il était à '.$old_value.')';
									}
									else
									{
									$fixes[] = 'The Double Damage On First Turn byte value has been reset to 1 (was '.$old_value.')';
									}
								}
							}
						break;
						
						case 200: case 202: case 204: case 206: case 208: case 210: case 212: case 214: case 216: case 218: case 219: case 220: case 222: case 224: case 226: case 228: case 230: case 234: case 236: case 238: case 242: case 246: case 248: case 250: case 252: case 254: case 258: case 262: case 266: case 270: case 274: case 278: case 282: case 286: case 290: case 294: // Unused bytes (there are 36 of them!)
							if (ord($file_content[$i]) !== 0)
							{
							$old_value = ord($file_content[$i]);
							$file_content[$i] = chr(0);
							
								if ($i === 200)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver un jet pack dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Jet Pack Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 202)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la faible pesanteur a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Low Gravity Power setting\'s byte value has been reset to 0 (was '.$old_value.' - this setting has no effect.)';
									}
								}
								else if ($i === 204)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver une faible pesanteur dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Low Gravity Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 206)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la visée laser a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Laser Sight Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 208)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver une visée laser dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Laser Sight Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 210)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la marche rapide a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Fast Walk Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 212)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver une marche rapide dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Fast Walk Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 214)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'invisibilité a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Invisibility Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 216)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver l\'invisibilité dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Invisibility Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 218)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance des dégâts doublés (:O) a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Double Damage Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 219)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Le délai des dégâts doublés a été remise à 0 (il était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Double Damage Delay setting has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 220)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver les dégâts doublés dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Double Damage Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 222)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du gel a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Freeze\'s Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 224)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver le gel dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Freeze\'s Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 226)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la super bombe banane a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Super Banana Bomb Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 228)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver la super bombe banane dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Super Banana Bomb Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 230)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'attaque à la mine a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Mine Strike Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 234)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du kit de démarrage de poutres a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet, il faut éditer la puissance de la poutre.';
									}
									else
									{
									$fixes[] = 'The Girder Starter Pack Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect; you need to edit the Girder\'s Power setting.';
									}
								}
								else if ($i === 236)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver le kit de démarrage de poutres dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Girder Starter Pack Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 238)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du séisme a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Earthquake Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 242)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la balance de la justice a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet, et en fait je me demande comment vous voulez modifier les effets de cette arme =).';
									}
									else
									{
									$fixes[] = 'The Scales of Justice Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect, and I actually wonder how you want to change the default effects of that weapon =).';
									}
								}
								else if ($i === 246)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du Vase Ming a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Ming Vase Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 248)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver le Vase Ming dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a d\'effet qu\'avec wkLaserFix, qui est fait pour une ancienne version de W:A (3.6.29.0).';
									}
									else
									{
									$fixes[] = 'The Ming Vase Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting only has effect in wkLaserFix, which is for an older W:A version (3.6.29.0).';
									}
								}
								else if ($i === 250)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la bombe en tapis de Mike a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Mike\'s Carpet Bomb Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 252)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'Les chances de trouver la bombe en tapis de Mike dans une caisse ont été remises à 0 (elles étaient à '.$old_value.') - l\'option n\'a d\'effet qu\'avec wkLaserFix, qui est fait pour une ancienne version de W:A (3.6.29.0).';
									}
									else
									{
									$fixes[] = 'The Mike\'s Carpet Bomb Crate Probability byte value has been reset to 0 (was '.$old_value.') - this setting only has effect in wkLaserFix, which is for an older W:A version (3.6.29.0).';
									}
								}
								else if ($i === 254)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la balle magique de Patsy a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Patsy\'s Magic Bullet Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 258)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du test nucléaire indien a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Indian Nuclear Test Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 262)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la sélection de ver a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet et est inutile de toute manière.';
									}
									else
									{
									$fixes[] = 'The Select Worm Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect and is useless anyway.';
									}
								}
								else if ($i === 266)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'armée du salut a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Salvation Army Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 270)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'escadron de taupes a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Mole Squadron Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 274)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de la bombe MB a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The MB Bomb Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 278)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'âne de ciment a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Concrete Donkey Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 282)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance du bombardier kamikaze a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet ; je me demande pourquoi cette arme si faible est considérée comme une super arme...';
									}
									else
									{
									$fixes[] = 'The Suicide Bomber Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect; I always wondered why such a weak weapon is considered as a super weapon...';
									}
								}
								else if ($i === 286)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'attaque au mouton français a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The French Sheep Strike Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else if ($i === 290)
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'attaque postale a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Mail Strike Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
								}
								else
								{
									if ($language === 'fr')
									{
									$fixes[] = 'La puissance de l\'Armageddon a été remise à 0 (elle était à '.$old_value.') - l\'option n\'a aucun effet.';
									}
									else
									{
									$fixes[] = 'The Armageddon Power setting\'s byte value has been reset to 0 (was '.$old_value.') - this setting has no effect.';
									}
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
					
					if ($version_required == 0)
					{
					$version_required_string = '3.0.0.0';
					}
					else if ($version_required == 5)
					{
					$version_required_string = '3.5 Beta 1';
					}
					else if ($version_required == 19.17)
					{
					$version_required_string = '3.6.'.$version_required.' Beta';
					}
					else
					{
					$version_required_string = '3.6.'.$version_required.'.0 Beta';
					}
	
					if ($rubber_enabled)
					{
					$version_required_string .= ' with RubberWorm';
					}
					if ($rubber_enabled AND $version_required === 31)
					{
					$version_required_string = '3.6.31.0 with RubberWorm31';
					}
					if ($laser_fix_enabled) // Flames limit feature
					{
					$version_required_string = '3.6.29.0 with Laser Fix or 3.6.31.0 with RubberWorm31';
					}
					
					move_uploaded_file($_FILES['sch_file']['tmp_name'], 'schemes/'.basename($name));
					$create_scheme_query = $bdd->prepare('INSERT INTO schemes_list VALUES(\'\', :name, :author, :is_member, :password, :submit_date, :submit_date, :description, :version_required_string, 0)');
					$create_scheme_query->execute(array(
					'name' => $uploaded_file_name,
					'author' => $sch_author,
					'is_member' => $sch_author_is_member,
					'password' => $sch_password,
					'submit_date' => $timestamp,
					'description' => $description,
					'version_required_string' => $version_required_string
					));
					
					$scheme_get_id = $bdd->prepare('SELECT sch_id FROM schemes_list WHERE sch_name = :name');
					$scheme_get_id->execute(array(
					'name' => $uploaded_file_name,
					));
					$scheme_id = $scheme_get_id->fetch();
					
					// Last, but not least, let's show the user a friendly message telling the user his scheme has successfully been uploaded, and that he can even download it himself.
					echo '<p>'.$str['sch_editor_scheme_succesfully_uploaded_message'].'</p>';
					echo '<p><a href="http://www.worms-univers.com/worms-armageddon/scheme-editor/download.php?id='.$scheme_id['sch_id'].'">'.$str['sch_editor_download_scheme_message'].'</a></p>';
					
					if (!empty($fixes))
					{
						echo '<p>'.$str['sch_editor_sch_upload_fixes_have_been_applied'].'</p>';
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