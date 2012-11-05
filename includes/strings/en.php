<?php
// Pages' head strings
$str['index'] = 'Index';
$str['sch_editor'] = 'Scheme Editor';
$str['view_counting_date'] = 'August 30th, 2012';
$str['category'] = 'W:A Scheme Editor';

// Main page
$str['sch_editor_main_page_title'] = 'Worms Armageddon Scheme Editor';
$str['sch_editor_main_page_content'] = 'Welcome to my W:A Scheme Editor. Here, you can view the users\' schemes, download them, and even create your own schemes. Have fun!';

// Scheme list page
$str['sch_editor_sch_list_title'] = 'Scheme List';
$str['sch_editor_sch_list_pages_label'] = 'Pages:';

$str['sch_editor_sch_list_id_column'] = 'ID';
$str['sch_editor_sch_list_name_column'] = 'Name';
$str['sch_editor_sch_list_author_column'] = 'Author';
$str['sch_editor_sch_list_submit_date_column'] = 'Created on';
$str['sch_editor_sch_list_last_edit_date_column'] = 'Last Edited on';
$str['sch_editor_sch_list_version_required_column'] = 'W:A Version Required';
$str['sch_editor_sch_list_download_count_column'] = 'Download Count';
$str['sch_editor_sch_list_download_column'] = 'Download';

// Errors
$str['error'] = 'Error';
$str['error_invalid_action'] = 'Invalid action.';
$str['error_no_action'] = 'What do you actually want to do? If you don\'t know what you want to do, then there\'s a problem...';
$str['error_scheme_name_by_scheme_author_already_exists'] = 'A scheme with the same name and the same author already exists. This new scheme will be numbered.'; // This one is actually a warning

// Scheme maker/editor page
$str['sch_editor_sch_maker_title'] = 'Create a New Scheme';

$str['sch_editor_sch_name'] = 'Scheme Name';
$str['sch_editor_sch_name_hint'] = 'Unless you\'re ok to see your scheme being called Unnamed Scheme followed by the timestamp, you should name your scheme.';
$str['sch_editor_sch_author'] = 'Your Nickname';
$str['sch_editor_sch_author_hint'] = 'Optional field. If you don\'t give any nickname, then your nickname will be set to Anonymous in the database.';
$str['sch_editor_sch_password'] = 'Scheme\'s Password';
$str['sch_editor_sch_password_hint'] = 'This will allow you to edit your scheme later, even if you didn\'t register here - which is understandable if you don\'t speak French.';
$str['sch_editor_sch_desc'] = 'Scheme\'s Description';
$str['sch_editor_sch_desc_hint'] = 'Describe your scheme here! You should tell:</span>
<ul class="sch_editor_hint">
<li>special rules (such as CBA, AFR, no sitting grenade...), if there are any;</li>
<li>the recommended amount of worms per team;</li>
<li>what kind of maps to use, if your scheme requires special maps...</li>
</ul>';
$str['sch_editor_sch_example_replays'] = 'Example Replays';
$str['sch_editor_sch_example_replays_hint'] = 'There\'s nothing better than replays to show people how your scheme works. Thus, you can upload up to 5 example replays (this limit may be extended in the future).';

$str['ammo'] = 'Ammo';
$str['barrels'] = 'Oil Drums'; 
$str['both'] = 'Both';
$str['crate_probability'] = 'Crate Probability';
$str['default'] = 'Default';
$str['delay'] = 'Delay';
$str['health_points_abbr'] = 'HP';
$str['hint'] = 'Hint';
$str['infinite'] = 'Inf.';
$str['manual'] = 'Manual';
$str['mines'] = 'Mines';
$str['none'] = 'None';
$str['none_2'] = 'None'; // Some languages, like French, have different genders. If genders when translating to your language are a problem, then contact me on #worms on GameSurge so I'm aware of that and I'll correct that.
$str['on'] = 'On';
$str['off'] = 'Off';
$str['power'] = 'Power';
$str['random'] = 'Random';
$str['utilities'] = 'Utilities';
$str['warning'] = 'Warning:';
$str['weapon'] = 'Weapon';
$str['weapons_list'] = array('Jet Pack', 'Low Gravity', 'Fast Walk', 'Laser Sight', 'Invisibility', 'Bazooka', 'Homing Missile', 'Mortar', 'Homing Pigeon', 'Sheep Launcher', 'Grenade', 'Cluster Bomb', 'Banana Bomb', 'Battle Axe', 'Earthquake', 'Shotgun', 'Handgun', 'Uzi', 'Minigun', 'Longbow', 'Fire Punch', 'Dragon Ball', 'Kamikaze', 'Suicide Bomber', 'Prod', 'Dynamite', 'Mine', 'Sheep', 'Super Sheep', 'Mole Bomb', 'Air Strike', 'Napalm Strike', 'Mail Strike', 'Mine Strike', 'Mole Squadron', 'Blow Torch', 'Pneumatic Drill', 'Girder', 'Baseball Bat', 'Girder Starter-Pack', 'Ninja Rope', 'Bungee', 'Parachute', 'Teleport', 'Scales of Justice', 'Super Banana Bomb', 'Holy Hand Grenade', 'Flame Thrower', 'Salvation Army', 'MB Bomb', 'Petrol Bomb', 'Skunk','Priceless Ming Vase', 'French Sheep Strike', 'Mike\'s Carpet Bomb', 'Mad Cow', 'Old Woman', 'Concrete Donkey', 'Indian Nuclear Test', 'Armageddon', 'Select Worm', 'Freeze', 'Patsy\'s Magic Bullet');
$str['weapons_hint']['jetpack'] = 'In the Power column, the value you edit is the amount of fuel, not the byte value. If you set 0 (infinite fuel), the fuel counter will count up. This abitility to change the jet pack\'s amount of fuel has been introduced in 3.6.29.0. Default value: 30.';
$str['weapons_hint']['utilities'] = 'You can\'t edit utilities\' crate probability or power (apart for the Jet Pack). Editing other utilities\' power is useless anyway.';
$str['weapons_hint']['super_weapon'] = 'This weapon is a super weapon, so you can\'t edit its power or its crate probability.';
$str['weapons_hint']['select_worm'] = 'Select Worm\'s crate probability is set to 0.5 and will always appear if super weapons are disabled and if all regular weapon\'s crate probability is set to 0. If you want Select Worm to never appear in crates, give it infinite ammunitions or an infinite delay.';
$str['weapons_hint']['girder_starter_pack'] = 'The Girder Starter Pack\'s power setting actually depends on the Girder\'s.';
$str['weapons_hint']['girder'] = 'When editing the Girder\'s power setting, you actually define how far it can be placed, in steps of 200 pixels. 5 = 1,000 pixels; 256 = 51,000 pixels.';
$str['weapons_hint']['ninja_rope'] = 'When editing the Ninja Rope\'s power setting, you actually define its max number of shots, max length and its angle restriction. 5 = infinite shots.';

$str['sch_editor_time_settings'] = 'Time Settings';
$str['sch_editor_hotseat_delay'] = 'Hot Seat Delay';
$str['sch_editor_hotseat_delay_hint'] = 'A few seconds allowing the player to think before the turn actually starts. Any value above 15 seconds is not recommended.';
$str['sch_editor_retreat_time'] = 'Retreat Time';
$str['sch_editor_retreat_time_hint'] = 'Once a player fired, he has a few seconds allowing him to hide after his shot.';
$str['sch_editor_rope_retreat_time'] = 'Rope Retreat Time';
$str['sch_editor_rope_retreat_time_hint'] = 'Once a player fired from an utility, he has a few seconds allowing him to hide after his shot. The Rope Retreat Time is generally longer than the Land Retreat Time.';
$str['sch_editor_turn_time'] = 'Turn Time';
$str['sch_editor_turn_time_hint'] = 'If you want the turn time to be infinite, type 128.';
$str['sch_editor_round_time'] = 'Round Time';
$str['sch_editor_round_time_hint'] = 'Round time can be specified in minutes (0-127) or in seconds (1-128). Sudden death will start a few turns after the round time reached 0. Though setting 0 mins will always result in instant sudden death.';
$str['sch_editor_round_time_display'] = 'Display Round Time';
$str['sch_editor_round_time_display_hint'] = 'If this box is checked, the round time will be displayed under the turn time ingame, so players can see how much time remains until Sudden Death.';

$str['sch_editor_game_settings'] = 'Game Settings';
$str['sch_editor_fall_damage'] = 'Fall Damage';
$str['sch_editor_fall_damage_hint'] = 'Worms generally lose points when falling. You can define this value in percents; the number you input here must be between 0 and 508 and must be dividible by 4. If you disable fall damage, worms will still lose their turn when falling.';
$str['sch_editor_anchor_mode'] = 'Anchor Mode';
$str['sch_editor_anchor_mode_hint'] = 'Worms can\'t walk or jump.';
$str['sch_editor_stockpiling_mode'] = 'Stockpiling Mode';
$str['sch_editor_stockpiling_mode_acc'] = 'Accumulative';
$str['sch_editor_stockpiling_mode_anti'] = 'Anti-accumulative';
$str['sch_editor_stockpiling_mode_hint'] = '[Multi-Round Games] Off: ammunitions are reset at every round. Accumulative: the new ammunitions are added to the previous game\'s ammunitions. Anti-accumulative: the ammunitions are set once and for all at the first round, meaning once an ammunition is used, you won\'t see it again in the next rounds.';
$str['sch_editor_worm_select'] = 'Select Worm';
$str['sch_editor_worm_select_hint'] = 'Set the way the worm that will play on a given turn is selected: will it be selected according to the team order, randomly, or will the player be able to choose it himself? If you set Random, the scheme will require v3.6.29.0 or later to be played.';
$str['sch_editor_donor_cards'] = 'Donor Cards';
$str['sch_editor_donor_cards_hint'] = 'If this option is enabled, a donor card will spawn when a team is kicked out.';
$str['sch_editor_worm_placement'] = 'Worm Placement';
$str['sch_editor_worm_placement_hint'] = 'Can the player teleport his worms at the beginning of the game?';
$str['sch_editor_initial_worm_energy'] = 'Initial Worm Energy';
$str['sch_editor_initial_worm_energy_hint'] = 'Each worm will have this amount of energy at the beginning of the game, unless there are handicaps to change it.';
$str['sch_editor_number_of_victories'] = 'Victories Required';
$str['sch_editor_number_of_victories_hint'] = 'If you set 0, 1 round will be played, no more (even if the round ends with a draw). Any value above 3 is not recommended.';

$str['sch_editor_sudden_death_settings'] = 'Sudden Death Settings';
$str['sch_editor_sudden_death_event'] = 'Sudden Death Event';
$str['sch_editor_sudden_death_event_hint'] = 'What happens when the round time reaches 0?';
$str['sch_edit_sd_round_ends'] = 'Round Ends';
$str['sch_edit_sd_nuke'] = 'Nuclear Test';
$str['sch_edit_sd_1hp'] = 'All Worms Have 1 HP';
$str['sch_edit_sd_water_rise_only'] = 'Water Rise Only';
$str['sch_editor_water_rise_speed'] = 'Water Rise Speed';
$str['sch_editor_water_rise_speed_hint'] = 'You can set the water rise speed in pixels per turn.';

$str['sch_editor_crate_probability_settings'] = 'Crate Probability Settings';
$str['sch_editor_weapon_crate_probability'] = 'Weapon Crate Probability';
$str['sch_editor_weapon_crate_probability_hint'] = 'Value in percents:';
$str['sch_editor_health_crate_probability'] = 'Health Crate Probability';
$str['sch_editor_health_crate_probability_hint'] = 'Value in percents:';
$str['sch_editor_utility_crate_probability'] = 'Utility Crate Probability';
$str['sch_editor_utility_crate_probability_hint'] = 'Value in percents:';
$str['sch_editor_health_crate_energy'] = 'Health Crate Energy';
$str['sch_editor_health_crate_energy_hint'] = 'How much health will a worm earn whenever he collects a health crate?';
$str['sch_editor_turns_without_crates'] = 'Turns Without Crates';
$str['sch_editor_turns_without_crates_hint'] = 'Value in percents:';

$str['sch_editor_hazardous_objects_settings'] = 'Hazardous Object Settings';
$str['sch_editor_object_type'] = 'Object Types';
$str['sch_editor_object_type_hint'] = 'Will there be any objects on the landscape? If so, what kind of objects? Mines? Barrels? Both?';
$str['sch_editor_object_count'] = 'Max Object Count';
$str['sch_editor_object_count_hint'] = 'How many objects will there be on the landscape? Well, you can define the maximum number of objects.';
$str['sch_editor_mine_fuse'] = 'Mine Fuse';
$str['sch_editor_mine_fuse_hint'] = 'Once a mine is triggered, how long is the delay before it explodes? Warning: this setting doesn\'t have any effects on the mines players dropped.';
$str['sch_editor_dud_mines'] = 'Dud Mines';
$str['sch_editor_dud_mines_hint'] = 'If you enable this setting, some mines on the landscape won\'t explode.';

$str['sch_editor_general_settings'] = 'General Settings';
$str['sch_editor_action_replays'] = 'Instant Action Replays';
$str['sch_editor_action_replays_hint'] = '[Offline] Automatically replays a shot that caused lots of damage.';
$str['sch_editor_blood_mode'] = 'Blood';
$str['sch_editor_blood_mode_hint'] = 'If enabled, blood effects will be drawn when a worm are damaged.';
$str['sch_editor_god_mode'] = 'God Mode';
$str['sch_editor_god_mode_hint'] = 'If enabled, all worms will have infinite health.';
$str['sch_editor_sheep_heaven'] = 'Sheep Heaven';
$str['sch_editor_sheep_heaven_hint'] = 'If this option is enabled, exploding sheeps will jump out from every destroyed crate, not only from crates containing sheep/super sheep. Furthermore, the super sheep\'s flight is longer.';
$str['sch_editor_indestructible_landscape'] = 'Indestructible Landscape';
$str['sch_editor_indestructible_landscape_hint'] = 'If this option is enabled, the landscape can\'t be destroyed.';

$str['sch_editor_rubber_settings'] = 'Rubber Worm Settings';
$str['sch_editor_rubber_settings_warning'] = 'Warning: These settings require WormKit and the wkRubberWorm module. If you edit any of these settings, the scheme could cause desynchronisations between players having Rubber and players not having Rubber. You can disable numeric values by giving them the 0 value.';
$str['sch_editor_rubber_sdet'] = 'Shot Ends Turn';
$str['sch_editor_rubber_sdet_hint'] = 'By default, this setting is enabled.';
$str['sch_editor_rubber_usw'] = 'Unlock "Shot Doesn\'t End Turn" weapons';
$str['sch_editor_rubber_usw_hint'] = 'Unlocks Earthquake, Indian Nuclear Test and Armageddon when shot doesn\'t end turn. Requires RubberWorm31.';
$str['sch_editor_rubber_ldet'] = 'Loss of Control Ends Turn';
$str['sch_editor_rubber_ldet_hint'] = 'By default, this setting is enabled.';
$str['sch_editor_rubber_fdpt'] = 'Fire Doesn\'t Pause Timer';
$str['sch_editor_rubber_fdpt_hint'] = 'Useful when shot doesn\'t end turn.';
$str['sch_editor_rubber_improved_rope'] = 'Improved Rope';
$str['sch_editor_rubber_improved_rope_hint'] = 'If enabled, Worms 2\'s rope physics will be emulated.';
$str['sch_editor_rubber_ccs'] = 'Continuous Crate Shower';
$str['sch_editor_rubber_ccs_hint'] = 'Crates will spawn every 5 seconds.';
$str['sch_editor_rubber_ope'] = 'Objects Can Be Pushed By Explosions';
$str['sch_editor_rubber_ope_hint'] = 'Requires RubberWorm31.';
$str['sch_editor_rubber_wdca'] = 'Weapons Don\'t Change Automatically';
$str['sch_editor_rubber_wdca_hint'] = 'Requires RubberWorm31.';
$str['sch_editor_rubber_fuseex'] = 'Extended Fuse';
$str['sch_editor_rubber_fuseex_hint'] = 'Fuse can be set up to 9 seconds. Requires RubberWorm31.';
$str['sch_editor_rubber_auto_reaim'] = 'Automatic Reaiming';
$str['sch_editor_rubber_auto_reaim_hint'] = 'Requires RubberWorm31.';
$str['sch_editor_rubber_circular_aim'] = 'Circular Aiming';
$str['sch_editor_rubber_circular_aim_hint'] = 'Yes, this option comes from Test-Stuff, but with Rubber it is stored in the scheme file directly. Requires RubberWorm31.';
$str['sch_editor_rubber_antilock_power'] = 'Antilock Power';
$str['sch_editor_rubber_antilock_power_hint'] = 'Another TS option stored in the scheme file. Requires RubberWorm31.';
$str['sch_editor_rubber_knocking_force'] = 'Knocking Force';
$str['sch_editor_rubber_knocking_force_hint'] = 'Set your custom rope knocking force. Note that this also affects bungee knocks. 0 = disable, as always; 1 = lowest force; 100 = default force; 200 = 2× default force; 254 = max, 2.54× force; 255 = forces no rope knocking.';

$str['sch_editor_rubber_crate_rate'] = 'Crate Rate and Crate Counter';
$str['sch_editor_rubber_crate_rate_hint'] = 'All values, but 0, enables the crate counter.';
$str['sch_editor_rubber_crate_limit'] = 'Crate Limit';
$str['sch_editor_rubber_crate_limit_hint'] = 'If there are too many crates, no more will spawn until some are removed (collected, destroyed or sunk).';

$str['sch_editor_rubber_kaosmod'] = 'Kaosmod';
$str['sch_editor_rubber_kaosmod_hint'] = 'Alters utilities\' crate probabilities. Requires RubberWorm31.';
$str['sch_editor_rubber_worms_bounciness'] = 'Worms Bounciness';
$str['sch_editor_rubber_worms_bounciness_hint'] = 'The value will be divided by 255.';
$str['sch_editor_rubber_friction'] = 'Friction';
$str['sch_editor_rubber_friction_hint'] = 'How does a worm\'s speed change while he is sliding? 1-95: high friction, 96: default friction, 97-99: low friction, 100: no friction, more than 100: anti-friction, i.e. the worm\'s speed increases while it is sliding.';
$str['sch_editor_rubber_flames_limit'] = 'Flames Limit';
$str['sch_editor_rubber_flames_limit_hint'] = 'Can be set up to 25,500 (255×100). Requires RubberWorm31 (3.6.31.0) or LaserFix (3.6.29.0).';
$str['sch_editor_rubber_speed'] = 'Speed';
$str['sch_editor_rubber_speed_hint'] = 'You can edit objects\' max speed. 16: default, 32: like in current Test Stuff, 255: no limit, like in TS3. Requires RubberWorm31.';
$str['sch_editor_rubber_anti_worm_sink'] = 'Anti Worm Sink';
$str['sch_editor_rubber_anti_worm_sink_hint'] = 'When a worm sinks, it\'ll respawn where it was before falling into the water. If it sinks again after respawning, then it\'ll die.';
$str['sch_editor_rubber_swat'] = 'Select Worm Anytime during the Turn';
$str['sch_editor_rubber_swat_hint'] = 'If you can manually select the worm that will play at the beginning of the turn, then with this setting enabled you can select another worm at anytime during any turn. Otherwise, you can only use this feature during a turn where you used the Select Worm weapon; it will last until the end of the current turn (like Low Gravity or Fast Walk for example). Requires RubberWorm31.';
$str['sch_editor_rubber_air_viscosity'] = 'Air Viscosity';
$str['sch_editor_rubber_air_viscosity_hint'] = 'Here you can set how fast a flying object loses velocity. If you set an odd value, worms will be affected too.';
$str['sch_editor_rubber_gravity_modifications'] = 'Gravity Modifications';
$str['sch_editor_rubber_gravity_modifications_hint'] = 'Here, you can do several things: you can alter the gravity ("grav##" settings) so it is stronger or lower, but not only. You can also reverse that gravity ("grav-##" settings), so worms will walk on the roof (walking is buggy thought), or even create a black hole. It will appear on the center of the map and will attract or push every objects and worms. Its attraction is either constant (meaning it is the same everywhere on the map: "cbh(-)##" settings) or proportional (the farther from the black hole the object is, the less it is attracted: "pbh(-)##" settings).';
$str['sch_editor_rubber_wind_influence'] = 'Wind Influence';
$str['sch_editor_rubber_wind_influence_hint'] = 'Here you can set how much the wind affects some of the flying objects. If you set an odd value, then wind affects worms too. A value of 255 corresponds to the wind susceptibility of the Bazooka. Note that this setting won\'t affect objets already affected by the wind (such as bazooka shells, poison, flames...). Crates, graves, barrels won\'t be affected either.';

$str['sch_editor_rubber_version_override'] = 'Version Override';
$str['sch_editor_rubber_version_override_hint'] = 'So, you want the scheme to be played with an older version of the game logic, in order to emulate old bugs and glitches for example? No problem, then, just select it here. Remember to take into consideration the limitations caused by the version you selected: for example, non-standard-sized maps and games with more than 18 worms are not supported.';

$str['sch_editor_weapon_upgrade_settings'] = 'Weapon Upgrade Settings';
$str['sch_editor_aqua_sheep'] = 'Aqua Sheep';
$str['sch_editor_aqua_sheep_hint'] = 'If this option is enabled, the Super Sheep will turn into an Aqua Sheep, and will be able to travel underwater.';
$str['sch_editor_upgraded_grenade'] = 'Upgraded Grenade';
$str['sch_editor_upgraded_grenade_hint'] = 'If this option is enabled, grenades will be more powerful.';
$str['sch_editor_upgraded_clusters'] = 'Upgraded Cluster Weapons';
$str['sch_editor_upgraded_clusters_hint'] = 'If this option is enabled, cluster weapons will contain even more clusters.';
$str['sch_editor_upgraded_shotgun'] = 'Upgraded Shotgun';
$str['sch_editor_upgraded_shotgun_hint'] = 'If this option is enabled, shotgun will fire 2 bullets per shot.';
$str['sch_editor_upgraded_longbow'] = 'Upgraded Longbow';
$str['sch_editor_upgraded_longbow_hint'] = 'If this option is enabled, longbow will be more powerful.';

$str['sch_editor_weapon_settings'] = 'Weapon Settings';
$str['sch_editor_double_damage'] = 'Double Damage On The First Turn';
$str['sch_editor_double_damage_hint'] = 'If this option is enabled, damage inflicted on the first turn will be doubled. There\'s no way to port that to more turns or to the whole game.';
$str['sch_editor_team_weapons'] = 'Team Weapons';
$str['sch_editor_team_weapons_hint'] = 'When creating a team, players can choose his team weapons amongst 8 weapons. If this option is enabled, each player will start with the weapon he chose. These 8 weapons\' settings will be overridden.';
$str['sch_editor_super_weapons'] = 'Super Weapons';
$str['sch_editor_super_weapons_hint'] = 'If you enable this option, super weapons may appear in some weapon crates.';
$str['sch_editor_general_weapons_hint'] = 'Some tips before you start editing weapon settings: to give a weapon infinite ammunitions, type 10; to give a weapon an infinite delay (thus blocking it), type 128.';
$str['sch_editor_jet_pack_power_message'] = 'Directly input the amount of fuel here (0-250; 0 means infinite and 30 is the default value).';

$str['sch_editor_send'] = 'Ok, I\'m done. Let\'s go!';

$str['sch_editor_scheme_succesfully_created_message'] = 'Scheme successfully created!';
$str['sch_editor_download_scheme_message'] = 'Download it here.';

// Scheme uploader
$str['sch_editor_sch_uploader_title'] = 'Upload a Scheme';
$str['sch_editor_sch_uploader_intro'] = 'So, your scheme is already ready, and all you want is to upload it here? No problem, just use the following form. The scheme file you upload must be in *.wsc format and must be either 221 or 297 bytes long; replays file must be in *.WAgame format (max. 3 MB). All files must be valid.';
$str['sch_editor_sch_uploader_sch_file'] = 'Your Scheme File';
$str['sch_editor_sch_upload_button'] = 'Send us your piece of art! =)';
$str['sch_editor_sch_upload_error_invalid_scheme_file'] = 'Invalid scheme file. The following errors were found:';
$str['sch_editor_sch_upload_error_incorrect_extension'] = 'Incorrect file extension.';
$str['sch_editor_sch_upload_error_incorrect_size'] = 'Incorrect file size.';
$str['sch_editor_sch_upload_error_incorrect_signature'] = 'Incorrect file signature.';
$str['sch_editor_sch_upload_error_incorrect_size_v1'] = 'A v1 scheme file is 221 bytes long.';
$str['sch_editor_sch_upload_error_incorrect_size_v2'] = 'A v2 scheme file is 297 bytes long.';
$str['sch_editor_sch_upload_error_incorrect_version_byte'] = 'Incorrect scheme version.';
$str['sch_editor_sch_upload_error_unknown'] = 'Unknown error.';
$str['sch_editor_scheme_succesfully_uploaded_message'] = 'Scheme successfully uploaded!';
$str['sch_editor_sch_upload_fixes_have_been_applied'] = '<strong>Note:</strong> The following fixes have been applied:';

// Scheme viewer
$str['sch_editor_sch_viewer_title'] = 'View a Scheme:';
$str['sch_editor_sch_viewer_by'] = 'by'; // It's on purpose that I didn't capitalize the "b".

$str['sch_editor_sch_viewer_sch_download_label'] = 'Download:';
$str['sch_editor_sch_viewer_sch_download_link'] = 'Download';
$str['sch_editor_sch_viewer_sch_download_count_downloaded'] = 'downloaded';
$str['sch_editor_sch_viewer_sch_download_count_times'] = 'times';
$str['sch_editor_sch_viewer_sch_name'] = 'Name:';
$str['sch_editor_sch_viewer_sch_author'] = 'Author:';
$str['sch_editor_sch_viewer_sch_created_on'] = 'Created on:';
$str['sch_editor_sch_viewer_sch_last_edited_on'] = 'Last edited on:';
$str['sch_editor_sch_viewer_sch_required_version'] = 'Required Version:';
$str['sch_editor_sch_viewer_sch_desc'] = 'Description:';

$str['sch_editor_sch_view_action_replays'] = 'I. Replays';

$str['sch_editor_sch_viewer_error_title'] = 'Scheme Viewing Error';
$str['sch_editor_sch_viewer_error_scheme_not_found'] = 'Scheme not found.';
$str['sch_editor_sch_viewer_error_no_id_specified'] = 'Errm, what scheme do you want me to load? I mean, I can\'t load schemes without an ID, a bit like calculators can\'t multiply any numbers if these numbers are not specified... (Well, I hope you got my point.)';
$str['sch_editor_sch_viewer_error_invalid_sch_signature'] = 'Invalid scheme signature. There, how did that file land on this server, if it had an invalid signature? :O';

// My schemes
$str['sch_editor_my_schemes_title'] = 'My Schemes';

// Changelog
$str['sch_editor_changelog'] = 'Changelog';
$str['sch_editor_changelog_intro'] = 'Here\'s the scheme editor\'s changelog.';
$str['sch_editor_changelog_v0_1_0_item1'] = 'First release of the scheme editor, allowing the user to create a scheme and to download it. Available in French and English.';
$str['sch_editor_changelog_v0_1_1_item1'] = '[Improvement] On the scheme creation page: the first few numeric options now use text fields instead of option zones, as suggested by FFie (and with her help). Not finished yet.';
$str['sch_editor_changelog_v0_1_1_item2'] = 'Created this changelog.';
$str['sch_editor_changelog_v0_1_2_item1'] = '[Fixed bug] The round time is now correctly stored if it is defined in seconds. In v0.1.0, the value was incorrectly stored (for example, the 90s value was stored as 39s); in v0.1.1, it was always stored in minutes.';
$str['sch_editor_changelog_v0_1_2_item2'] = '[Fixed] Dates were always shown in French in this changelog.';
$str['sch_editor_changelog_v0_2_0_item1'] = '[Improvement] The creation form has been reorganised so it is smaller, as GreeN suggested.';
$str['sch_editor_changelog_v0_2_0_item2'] = '[Improvement] Finished to apply FFie\'s suggestion.';
$str['sch_editor_changelog_v0_2_1_item1'] = '[Fixed] Some values (Hotseat Delay, Land Retreat Time and Rope Retreat Time) could be set up to 255 in the editor while the real limit is 127.';
$str['sch_editor_changelog_v0_3_0_item1'] = '[Improvement] It is now possible to upload schemes on the database.';
$str['sch_editor_changelog_v0_4_0_item1'] = '[Improvement] Added the schemes list.';
$str['sch_editor_changelog_v0_4_1_item1'] = '[Fixed] After ingame testing, I realised that only the Land Retreat Time was limited to 127. The Hotseat Delay and the Rope Retreat Time can be set up to 255 again.';
$str['sch_editor_changelog_v0_4_1_item2'] = '[Fixed] Uploaded schemes without any author name had an empty author field. Now, if no author name is given, the author name will be set to Anonymous.';
$str['sch_editor_changelog_v0_4_1_item3'] = 'Plus some other minor fixes I\'ve released on the previous days and I didn\'t list.';
$str['sch_editor_changelog_v0_4_2_item1'] = '[Improvement] Added custom knocking force setting, RubberWorm v0.0.1.12\'s new feature.';
$str['sch_editor_changelog_v0_4_3_item1'] = '[Fixed] Downloading a scheme with a parsed name now works succesfully.';

// Link to the page that allows us to select another language
$str['sch_editor_change_language'] = 'Select Another Language';
?>