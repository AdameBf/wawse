<?php
// Pages' head strings
$str['index'] = 'Index';
$str['sch_editor'] = 'Scheme Editor';
$str['view_counting_date'] = 'August 30th, 2012';
$str['category'] = 'W:A Scheme Editor';

// Main page
$str['sch_editor_main_page_title'] = 'Worms Armageddon Scheme Editor';
$str['sch_editor_main_page_content'] = 'Welcome to my W:A Scheme Editor. Here, you can view the users\' schemes, download them, and even create your own schemes. Have fun!';

// Errors / Warnings
$str['error'] = 'Error'; // This one is a title.
$str['error_invalid_action'] = 'Invalid action.';
$str['error_no_action'] = 'No action specified.';
$str['error_scheme_name_by_scheme_author_already_exists'] = 'A scheme with the same name and the same author already exists. This new scheme will be numbered.'; // This one is actually a warning.

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
$str['sch_editor_sch_list_edit_column'] = 'Edit';
$str['sch_editor_sch_list_download_example_replays'] = 'Download Example Replays';
$str['sch_editor_sch_list_based_on'] = 'Based on Scheme';

$str['sch_editor_sch_list_no_example_replays'] = 'No Example Replay';

$str['sch_editor_sch_list_replay_approving_interface_link'] = 'Handle';

// Scheme maker/editor page
$str['sch_editor_sch_maker_title'] = 'Create a New Scheme';
$str['sch_editor_sch_editing_title'] = 'Edit Scheme'; // Followed by the scheme name.
$str['sch_editor_sch_editing_title_2'] = 'Edit a Scheme'; // Different from the above "Edit [The] Scheme"; "Edit a Scheme" is shown when there is an error.
$str['sch_editor_sch_creation_based_on_title'] = 'Create a New Scheme based on scheme'; // Followed by the scheme name.
$str['sch_editor_sch_creation_based_on_title_2'] = 'Create a New Scheme based on an existing scheme'; // Same as $str['sch_editor_sch_editing_title_2'].

$str['sch_editor_sch_name'] = 'Scheme Name';
$str['sch_editor_sch_name_hint'] = 'Your scheme will receive the default name Unnamed Scheme followed by a timestamp if you don\'t choose a name.';
$str['sch_editor_sch_name_hint2'] = 'It isn\'t possible to change a scheme\'s name after its creation or upload yet.';
$str['sch_editor_sch_author'] = 'Your Nickname';
$str['sch_editor_sch_author_hint'] = 'Optional field. If you don\'t give any nickname, then your nickname will be set to Anonymous in the database.';
$str['sch_editor_sch_password'] = 'Scheme\'s Password';
$str['sch_editor_sch_password_hint'] = 'This will allow you to edit your scheme later, even if you didn\'t register here - which is understandable if you don\'t speak French.';
$str['sch_editor_sch_password_hint2'] = 'You can change the password required for further edits.';
$str['sch_editor_no_password'] = 'No Password';
$str['sch_editor_sch_desc'] = 'Scheme\'s Description';
$str['sch_editor_sch_desc_hint'] = 'Describe your scheme here! You should tell:</span>
<ul class="sch_editor_hint">
<li>special rules (such as CBA, AFR, no sitting grenade...), if there are any;</li>
<li>the recommended amount of worms per team;</li>
<li>what kind of maps to use, if your scheme requires special maps...</li>
</ul>';

$str['sch_editor_sch_example_replays'] = 'Example Replays';
$str['sch_editor_sch_example_replays_hint'] = 'There\'s nothing better than replays to show people how your scheme works. Thus, you can upload some example replays here (if you want to upload more than 5 - which sounds like a lot! - then you\'ll need to upload them 5 by 5).';
$str['sch_editor_sch_example_replays_permissions_label'] = 'Who can upload example replays?';
$str['sch_editor_sch_example_replays_permissions_opt0'] = 'You (the author) only.';
$str['sch_editor_sch_example_replays_permissions_opt1'] = 'Everyone, but replays have to be approved by the author - I might take over inactive authors though.';
$str['sch_editor_sch_example_replays_permissions_opt2'] = 'Everyone, without any approvement required (I may still act behind though - for example, when the guy didn\'t get how to play the scheme).';

$str['sch_editor_sch_creation_do_not_save_on_database'] = 'Don\'t save this scheme on the database';
$str['sch_editor_sch_creation_do_not_save_on_database_hint'] = 'If you tick this box, then upon submitting the form, you\'ll download the scheme right away, without it is saved on the server and on the database.';

$str['add'] = 'Add';
$str['ammo'] = 'Ammo';
$str['barrels'] = 'Oil Drums';
$str['both'] = 'Both';
$str['crate_probability'] = 'Crate Probability';
$str['default'] = 'Default';
$str['delay'] = 'Delay';
$str['health_points_abbr'] = 'HP';
$str['hint'] = 'Hint';
$str['infinite'] = 'Inf.'; // Either abbreviated or not, depending of how long "Infinite" is in your language.
$str['infinite_abbr'] = 'Inf.'; // The previous string isn't abbreviated in French; hence the repeat in English.
$str['invalid_value'] = 'Invalid Value';
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
$str['weapons_hint']['jetpack'] = 'In the Power column, the value you edit is the amount of fuel, not the byte value. If you set 0 (infinite fuel), the fuel counter will count up. This ability to change the jet pack\'s amount of fuel has been introduced in 3.6.29.0. Default value: 30.';
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
$str['sch_editor_round_time_display_hint'] = 'If this box is checked, the round time will be displayed under the turn time in-game, so players can see how much time remains until Sudden Death.';

$str['sch_editor_game_settings'] = 'Game Settings';
$str['sch_editor_fall_damage'] = 'Fall Damage';
$str['sch_editor_fall_damage_hint'] = 'Worms generally lose points when falling. You can define this value in percents; the number you input here must be between 0 and 508 and must be dividible by 4. If you disable fall damage, worms will still lose their turn when falling.';
$str['sch_editor_anchor_mode'] = 'Anchor Mode';
$str['sch_editor_anchor_mode_hint'] = 'Worms can\'t walk or jump.';
$str['sch_editor_stockpiling_mode'] = 'Stockpiling Mode';
$str['sch_editor_stockpiling_mode_acc'] = 'Accumulative';
$str['sch_editor_stockpiling_mode_anti'] = 'Anti-accumulative';
$str['sch_editor_stockpiling_mode_hint'] = '[Multi-Round Games] Off: ammunitions are reset at every round. Accumulative: the new ammunitions are added to the previous game\'s ammunitions. Anti-accumulative: the ammunitions are set once and for all at the first round, meaning once an ammunition is used, you won\'t have it back in later rounds.';
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
$str['sch_editor_sudden_death_settings_abbr'] = 'SD Settings'; // Scheme Viewer.
$str['sch_editor_sudden_death_event'] = 'Sudden Death Event';
$str['sch_editor_sudden_death_event_hint'] = 'What happens when the round time reaches 0?';
$str['sch_edit_sd_round_ends'] = 'Round Ends';
$str['sch_edit_sd_nuke'] = 'Nuclear Test';
$str['sch_edit_sd_1hp'] = 'All Worms Have 1 HP';
$str['sch_edit_sd_water_rise_only'] = 'Water Rise Only';
$str['sch_editor_water_rise_speed'] = 'Water Rise Speed';
$str['sch_editor_water_rise_speed_hint'] = 'You can set the water rise speed in pixels per turn.';
$str['sch_editor_water_rise_speed_img_title_attr'] = '(In pixels/turn.)'; // Scheme Viewer.

$str['sch_editor_crate_probability_settings'] = 'Crate Probability Settings';
$str['sch_editor_crate_probability_settings_short'] = 'Crate Probability Settings'; // Scheme Viewer - there are no changes in English, but you may cut "probability" in your translation, like I did in the French translation.
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
$str['sch_editor_hazardous_objects_settings_short'] = 'Hazardous Object Settings'; // Scheme Viewer - same as $str['sch_editor_crate_probability_settings_short'], but the word you may cut is "hazardous".
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
$str['sch_editor_invincibility'] = 'Invincibility';
$str['sch_editor_invincibility_hint'] = 'If enabled, all worms will have infinite health.';
$str['sch_editor_sheep_heaven'] = 'Sheep Heaven';
$str['sch_editor_sheep_heaven_hint'] = 'If this option is enabled, exploding sheeps will jump out from every destroyed crate, not only from crates containing sheep/super sheep. Furthermore, the super sheep\'s flight is longer.';
$str['sch_editor_indestructible_landscape'] = 'Indestructible Landscape';
$str['sch_editor_indestructible_landscape_hint'] = 'If this option is enabled, the landscape can\'t be destroyed.';

$str['sch_editor_rubber_settings'] = 'Rubber Worm Settings';
$str['sch_editor_rubber_settings_warning'] = 'Warning: These settings require WormKit and the wkRubberWorm module. If you edit any of these settings, the scheme could cause desynchronisations between players having Rubber and players not having Rubber. You can disable numeric values by giving them the 0 value.';
$str['sch_editor_rubber_sdet'] = 'Shot Ends Turn';
$str['sch_editor_rubber_sdet_hint'] = 'By default, this setting is enabled.';
$str['sch_editor_rubber_usw'] = 'Unlock "Shot Doesn\'t End Turn" weapons';
$str['sch_editor_rubber_usw_hint'] = 'Unlocks Earthquake, Indian Nuclear Test and Armageddon when shot doesn\'t end turn. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_ldet'] = 'Loss of Control Ends Turn';
$str['sch_editor_rubber_ldet_hint'] = 'By default, this setting is enabled.';
$str['sch_editor_rubber_fdpt'] = 'Fire Doesn\'t Pause Timer';
$str['sch_editor_rubber_fdpt_hint'] = 'Useful when shot doesn\'t end turn.';
$str['sch_editor_rubber_improved_rope'] = 'Improved Rope';
$str['sch_editor_rubber_improved_rope_hint'] = 'If enabled, Worms 2\'s rope physics will be emulated.';
$str['sch_editor_rubber_ccs'] = 'Continuous Crate Shower';
$str['sch_editor_rubber_ccs_hint'] = 'Crates will spawn every 5 seconds.';
$str['sch_editor_rubber_ope'] = 'Objects Can Be Pushed By Explosions';
$str['sch_editor_rubber_ope_hint'] = 'Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_wdca'] = 'Weapons Don\'t Change Automatically';
$str['sch_editor_rubber_wdca_hint'] = 'Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_fuseex'] = 'Extended Fuse';
$str['sch_editor_rubber_fuseex_hint'] = 'Fuse can be set up to 9 seconds. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_auto_reaim'] = 'Automatic Reaiming';
$str['sch_editor_rubber_auto_reaim_hint'] = 'Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_circular_aim'] = 'Circular Aiming';
$str['sch_editor_rubber_circular_aim_hint'] = 'Yes, this option comes from Test-Stuff, but with Rubber it is stored in the scheme file directly. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_antilock_power'] = 'Antilock Power';
$str['sch_editor_rubber_antilock_power_hint'] = 'Another TS option stored in the scheme file. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_knocking_force'] = 'Knocking Force';
$str['sch_editor_rubber_knocking_force_hint'] = 'Set your custom rope knocking force. Note that this also affects bungee knocks. 0 = disable, as always; 1 = lowest force; 100 = default force; 200 = 2× default force; 254 = max, 2.54× force; 255 = forces no rope knocking. Requires RubberWorm for 3.6.31.0 or later.';

$str['sch_editor_rubber_crate_rate'] = 'Crate Rate and Crate Counter';
$str['sch_editor_rubber_crate_rate_hint'] = 'All values, but 0, enables the crate counter.';
$str['sch_editor_rubber_crate_limit'] = 'Crate Limit';
$str['sch_editor_rubber_crate_limit_hint'] = 'If there are too many crates, no more will spawn until some are removed (collected, destroyed or sunk).';

$str['sch_editor_rubber_kaosmod'] = 'Kaosmod';
$str['sch_editor_rubber_kaosmod_hint'] = 'Alters utilities\' crate probabilities. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_worms_bounciness'] = 'Worms Bounciness';
$str['sch_editor_rubber_worms_bounciness_hint'] = 'The value will be divided by 255.';

$str['sch_editor_rubber_friction'] = 'Friction';
$str['sch_editor_rubber_friction_hint'] = 'How does a worm\'s speed change while he is sliding? 1-95: high friction, 96: default friction, 97-99: low friction, 100: no friction, more than 100: anti-friction, i.e. the worm\'s speed increases while it is sliding.';
$str['sch_editor_rubber_flames_limit'] = 'Flames Limit';
$str['sch_editor_rubber_flames_limit_hint'] = 'Can be set up to 25,500 (255×100). Requires RubberWorm31 (3.6.31.0) or LaserFix (3.6.29.0).';
$str['sch_editor_rubber_speed'] = 'Speed';
$str['sch_editor_rubber_speed_hint'] = 'You can edit objects\' max speed. 16: default, 32: like in current Test Stuff, 255: no limit, like in TS3. Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_anti_worm_sink'] = 'Anti Worm Sink';
$str['sch_editor_rubber_anti_worm_sink_hint'] = 'When a worm sinks, it\'ll respawn where it was before falling into the water. If it sinks again after respawning, then it\'ll die.';
$str['sch_editor_rubber_swat'] = 'Select Worm at Anytime during the Turn';
$str['sch_editor_rubber_swat_hint'] = 'If you can manually select the worm that will play at the beginning of the turn, then with this setting enabled you can select another worm at anytime during any turn. Otherwise, you can only use this feature during a turn where you used the Select Worm weapon; it will last until the end of the current turn (like Low Gravity or Fast Walk for example). Requires RubberWorm for 3.6.31.0 or later.';
$str['sch_editor_rubber_air_resistance'] = 'Air Resistance';
$str['sch_editor_rubber_air_resistance_hint'] = 'Here you can set how fast a flying object loses velocity. If you set an odd value, worms will be affected too.';
$str['sch_editor_rubber_gravity_modifications'] = 'Gravity Modifications';
$str['sch_editor_rubber_gravity_modifications_hint'] = 'Here, you can do several things: you can alter the gravity (grav## settings) so it is stronger or lower, but not only. You can also reverse that gravity (grav-## settings), so worms will walk on the roof (walking will be buggy though), or even create a black hole. It will appear on the center of the map and will attract or push every objects and worms. Its attraction is either constant (meaning it is the same everywhere on the map: cbh(-)## settings) or proportional (the farther from the black hole the object is, the less it is attracted: pbh(-)## settings).';
$str['sch_editor_rubber_wind_influence'] = 'Wind Influence';
$str['sch_editor_rubber_wind_influence_hint'] = 'Here you can set how much the wind affects some of the flying objects. If you set an odd value, then wind affects worms too. A value of 255 corresponds to the wind susceptibility of the Bazooka. Note that this setting won\'t affect objets already affected by the wind (such as bazooka shells, poison, flames...). Crates, graves, barrels won\'t be affected either.';

$str['sch_editor_rubber_version_override'] = 'Version Override';
$str['sch_editor_rubber_version_override_hint'] = 'So, you want the scheme to be played with an older version of the game logic, in order to emulate old bugs and glitches? No problem! Just select it here. Remember to take into consideration the limitations caused by the version you selected: for example, non-standard-sized maps and games with more than 18 worms are not supported.';

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
$str['sch_editor_team_weapons_hint'] = 'When creating a team, players can choose his team weapons amongst 8 weapons. If this option is enabled, each player will start with the weapon he chose. These 8 weapons\' settings will be overwritten.';
$str['sch_editor_super_weapons'] = 'Super Weapons';
$str['sch_editor_super_weapons_hint'] = 'If you enable this option, super weapons may appear in some weapon crates.';
$str['sch_editor_general_weapons_hint'] = 'Some tips before you start editing weapon settings: to give a weapon infinite ammunition, type 10; to give a weapon an infinite delay (thus blocking it), type 128.';
$str['sch_editor_jet_pack_power_message'] = 'Directly input the amount of fuel here (0-250; 0 means infinite and 30 is the default value).';

$str['sch_editor_send'] = 'Ok, I\'m done. Let\'s go!';

$str['sch_editor_error_no_id_specified'] = 'Error: No scheme specified.';
$str['sch_editor_error_scheme_does_not_exist'] = 'Error: No scheme has this ID in the database.';

$str['sch_editor_scheme_succesfully_created_message'] = 'Scheme successfully created!';
$str['sch_editor_scheme_succesfully_edited_message'] = 'Scheme successfully edited!';
$str['sch_editor_download_scheme_message'] = 'Download it here.';

// Scheme uploader
$str['sch_editor_sch_uploader_title'] = 'Upload a Scheme';
$str['sch_editor_sch_uploader_intro'] = 'So, your scheme is ready, and all you want is to upload it here? No problem, just use the following form. The scheme file you upload must be in *.wsc format and must be either 221 or 297 bytes long; replays file must be in *.WAgame format (max. 3 MB). All files must be valid.';
$str['sch_editor_sch_uploader_sch_file'] = 'Your Scheme File';
$str['sch_editor_sch_uploader_sch_name_hint'] = 'If this field is empty, the uploaded file\'s name will be used instead.';
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
$str['sch_editor_download_scheme_with_fixes_message'] = 'Download the scheme with the fixes';

$str['sch_editor_sch_upload_retreat_time_fix'] = 'The Land Retreat Time byte value has been reset to 127 (was %1).'; // Do not change any %1 or %2 in the translation file.
$str['sch_editor_sch_upload_weapon_crate_probability_fix'] = 'The Weapon Crate Probability byte value has been reset to 127 (was %1).';
$str['sch_editor_sch_upload_health_crate_probability_fix'] = 'The Health Crate Probability byte value has been reset to 127 (was %1).';
$str['sch_editor_sch_upload_utility_crate_probability_fix'] = 'The Utility Crate Probability byte value has been reset to 127 (was %1).';
$str['sch_editor_sch_upload_fall_damage_fix'] = 'The Fall Damage byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_stockpiling_mode_fix'] = 'The Stockpiling Mode byte value has been set to 0, i.e. off (was %1).';
$str['sch_editor_sch_upload_worm_selection_method_fix'] = 'The Worm Selection method at the beginning of a turn has been set to "manual" (the byte value was %1).';
$str['sch_editor_sch_upload_sudden_death_event_fix'] = 'The Sudden Death Event has been set to "Water Rise only" (the byte value was %1).';
$str['sch_editor_sch_upload_sudden_death_water_rise_speed_fix'] = 'The Sudden Death Water Rise Speed has been set to 20 pixels/turn, i.e. "Medium" in-game (the byte value was %1).';
$str['sch_editor_sch_upload_object_type_and_count_fix'] = 'The Hazardous Object Type has been set to "both", and the Max Object Count has been set to 8 (the byte controlling both settings\'s value was %1).';
$str['sch_editor_sch_upload_initial_worm_energy_fix'] = 'The Initial Worm Energy has been set to 1 (was 0).';
$str['sch_editor_sch_upload_display_round_time_fix'] = 'The Display Round Time byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_action_replay_fix'] = 'The Action Replay byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_anchor_mode_fix'] = 'The Anchor Mode byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_donor_cards_fix'] = 'The Donor Cards byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_dud_mines_fix'] = 'The Dud Mines byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_manual_placement_fix'] = 'The Manual Placement byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_blood_mode_fix'] = 'The Blood Mode byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_aqua_sheep_fix'] = 'The Aqua Sheep byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_sheep_heaven_fix'] = 'The Sheep Heaven byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_invincibility_fix'] = 'The Invincibility byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_indestructible_land_fix'] = 'The Indestructible Land byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_upgraded_grenade_fix'] = 'The Upgraded Grenade byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_upgraded_shotgun_fix'] = 'The Upgraded Shotgun byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_upgraded_clusters_fix'] = 'The Upgraded Clusters byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_upgraded_longbow_fix'] = 'The Upgraded Longbow byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_team_weapons_fix'] = 'The Team Weapons byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_super_weapons_fix'] = 'The Super Weapons byte value has been reset to 1 (was %1).';
$str['sch_editor_sch_upload_double_damage_fix'] = 'The Double Damage On First Turn byte value has been reset to 1 (was %1).';

$str['sch_editor_sch_upload_jp_cp_fix'] = 'The Jet Pack Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.'; // I'm listing weapons separately because some may need different articles in front of them in other languages (like in French, for example).
$str['sch_editor_sch_upload_lg_p_fix'] = 'The Low Gravity Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_lg_cp_fix'] = 'The Low Gravity Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_ls_p_fix'] = 'The Laser Sight Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_ls_cp_fix'] = 'The Laser Sight Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_fw_p_fix'] = 'The Fast Walk Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_fw_cp_fix'] = 'The Fast Walk Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_invis_p_fix'] = 'The Invisibility Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_invis_cp_fix'] = 'The Invisibility Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_dd_p_fix'] = 'The Double Damage Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_dd_d_fix'] = 'The Double Damage Delay setting has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_dd_cp_fix'] = 'The Double Damage Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_freeze_p_fix'] = 'The Freeze\'s Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_freeze_cp_fix'] = 'The Freeze\'s Crate Probability byte value has been reset to 1 (was %1) - there are less than 512 emulable versions currently.';
$str['sch_editor_sch_upload_sbb_p_fix'] = 'The Super Banana Bomb Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_minestr_p_fix'] = 'The Mine Strike Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_gsp_p_fix'] = 'The Girder Starter Pack Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect; you need to edit the Girder\'s Power setting.';
$str['sch_editor_sch_upload_gsp_cp_fix'] = 'The Girder Starter Pack Crate Probability byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_eq_p_fix'] = 'The Earthquake Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_scales_p_fix'] = 'The Scales of Justice Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect, and I actually wonder how you would have liked to change the default effects of that weapon anyway. =)';
$str['sch_editor_sch_upload_mvase_p_fix'] = 'The Ming Vase Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_mvase_cp_fix'] = 'The Ming Vase Crate Probability byte value has been reset to 0 (was %1) - this setting only has effect in wkLaserFix, which is for an older W:A version (3.6.29.0).';
$str['sch_editor_sch_upload_carp_p_fix'] = 'The Mike\'s Carpet Bomb Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_carp_cp_fix'] = 'The Mike\'s Carpet Bomb Crate Probability byte value has been reset to 0 (was %1) - this setting only has effect in wkLaserFix, which is for an older W:A version (3.6.29.0).';
$str['sch_editor_sch_upload_bullet_p_fix'] = 'The Patsy\'s Magic Bullet Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_nuke_p_fix'] = 'The Indian Nuclear Test Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_sw_p_fix'] = 'The Select Worm Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect and would be useless anyway.';
$str['sch_editor_sch_upload_sally_army_p_fix'] = 'The Salvation Army Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_msquad_p_fix'] = 'The Mole Squadron Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_mbbomb_p_fix'] = 'The MB Bomb Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_cdonkey_p_fix'] = 'The Concrete Donkey Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_sbomber_p_fix'] = 'The Suicide Bomber Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect; I always wondered why such a weak weapon is considered as a super weapon...';
$str['sch_editor_sch_upload_sheepstr_p_fix'] = 'The French Sheep Strike Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_mailstr_p_fix'] = 'The Mail Strike Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';
$str['sch_editor_sch_upload_arma_p_fix'] = 'The Armageddon Power setting\'s byte value has been reset to 0 (was %1) - this setting has no effect.';

// Scheme viewer
$str['sch_editor_sch_viewer_title'] = 'View a Scheme:';
$str['sch_editor_sch_viewer_by'] = 'by'; // It's on purpose that I didn't capitalize the "b".

$str['sch_editor_sch_viewer_sch_download_label'] = 'Download:'; // With a colon because in some languages (such as French), there is a non-breaking space (Alt+0160) in front of that colon.
$str['sch_editor_sch_viewer_sch_download_link'] = 'Download';
$str['sch_editor_sch_viewer_sch_download_count_downloaded'] = 'downloaded';
$str['sch_editor_sch_viewer_sch_download_count_times'] = 'times';
$str['sch_editor_sch_viewer_sch_name'] = 'Name:';
$str['sch_editor_sch_viewer_sch_author'] = 'Author:';
$str['sch_editor_sch_viewer_sch_created_on'] = 'Created on:';
$str['sch_editor_sch_viewer_sch_last_edited_on'] = 'Last edited on:';
$str['sch_editor_sch_viewer_sch_required_version'] = 'Required Version:';
$str['sch_editor_sch_viewer_sch_desc'] = 'Description:';
$str['sch_editor_sch_viewer_sch_no_desc'] = 'None';
$str['sch_editor_sch_viewer_sch_example_replays'] = 'Example Replays:';
$str['sch_editor_sch_viewer_sch_no_example_replays'] = 'None';
$str['sch_editor_sch_viewer_sch_based_on_the_current_one'] = 'Schemes based on this scheme:';
$str['sch_editor_sch_viewer_sch_based_on_the_current_one_sg'] = 'Scheme based on this scheme:'; // Singular.

$str['sch_editor_sch_viewer_actions'] = 'Actions:';
$str['sch_editor_sch_viewer_edit_link'] = 'Edit this Scheme';
$str['sch_editor_sch_viewer_create_based_on_link'] = 'Create a New Scheme based on this one';
$str['sch_editor_sch_viewer_add_exrep_link'] = 'Add Example Replays';
$str['sch_editor_sch_viewer_handle_exrep_link'] = 'Handle Example Replays';

$str['sch_editor_sch_view_action_replays'] = 'I. Replays'; // This string should be as short as this.

$str['sch_editor_sch_viewer_no_weapons'] = 'There are no weapons in this scheme.';

$str['sch_editor_sch_viewer_error_title'] = 'Scheme Viewing Error';
$str['sch_editor_sch_viewer_error_scheme_not_found'] = 'Scheme not found.';
$str['sch_editor_sch_viewer_error_no_id_specified'] = 'Errm, what scheme do you want me to load? I mean, I can\'t load schemes without an ID, a bit like calculators can\'t multiply any numbers if these numbers are not specified... (Well, I hope you got my point.)';
$str['sch_editor_sch_viewer_error_invalid_sch_signature'] = 'Invalid scheme signature. There, how did that file land on this server, if it had an invalid signature? =o';

$str['sch_editor_sch_viewer_weapon_column'] = '<abbr title="Weapon">W</abbr>'; // These are abbreviations shown on top of the weapons table. Translate the words between "" and change the abbreviation between > and <.
$str['sch_editor_sch_viewer_ammo_column'] = '<abbr title="Ammunition">A</abbr>';
$str['sch_editor_sch_viewer_power_column'] = '<abbr title="Power">P</abbr>';
$str['sch_editor_sch_viewer_delay_column'] = '<abbr title="Delay">D</abbr>';
$str['sch_editor_sch_viewer_crate_prob_column'] = '<abbr title="Crate Probability">CP</abbr>';

$str['sch_editor_sch_viewer_double_damage'] = 'Double Damage'; // Feel free to add a non-breaking space at the end of this string if your language needs one before ":" (a non-breaking space's can be typed with Alt+255).
$str['sch_editor_sch_viewer_jp_power_hint'] = '(In fuel units.)';

$str['sch_editor_sch_viewer_not_a_rubber_scheme'] = 'This scheme isn\'t a RubberWorm scheme.';
$str['sch_editor_sch_viewer_with_crate_count_enabled'] = 'with Crate Count enabled';
$str['sch_editor_sch_viewer_rubber_no_friction'] = 'No Friction';
$str['sch_editor_sch_viewer_rubber_black_hole'] = 'Black Hole';
$str['sch_editor_sch_viewer_rubber_version_override'] = 'Emulated Version';
$str['sch_editor_sch_viewer_rubber_air_resistance_63'] = 'Identical to water\'s';
$str['sch_editor_sch_viewer_rubber_affects_worms'] = 'affects both worms and objects';
$str['sch_editor_sch_viewer_rubber_affects_objects'] = 'only affects objects';
$str['sch_editor_sch_viewer_rubber_wind_influence_bazooka'] = 'Identical to the one applied to a Bazooka shell';
$str['sch_editor_sch_viewer_rubber_proportional_black_hole'] = 'Proportional';
$str['sch_editor_sch_viewer_rubber_central_black_hole'] = 'Central';

// Upload example replays
$str['sch_editor_sch_replay_uploader_title'] = 'Attach Example Replays to Scheme'; // This string is completed by " #$id ($name $by $author)" - yes, the $by differs between languages.
$str['sch_editor_sch_replay_uploader_intro'] = 'Have good example replays to show how this scheme works? Well, just upload them!';
$str['sch_editor_sch_replay_uploader_successful'] = 'Replays Successfully Uploaded.';
$str['sch_editor_sch_replay_uploader_authoring_submit_button'] = 'Go!'; // By "authoring" I mean, typing the scheme author's name and his password. And this string corresponds to the text that appears on the submit button at the bottom of that "authoring" form.
$str['sch_editor_sch_replay_uploader_wrong_user'] = 'You\'re not the member who created this scheme!';
$str['sch_editor_sch_replay_uploader_login_to_attach_replays'] = 'Please log in to attach replays to this scheme (since the author is a member who decided he was the only one allowed to upload example replays).';
$str['sch_editor_sch_replay_uploader_button'] = 'Send us these replays';
$str['sch_editor_sch_replay_uploader_error_uatginam'] = 'Nice try getting me there :P.'; // UATGINAM = Uploading Although The Guy Is Not A Member.

// Example replays approving interface
$str['sch_editor_sch_replay_approving_interface_title'] = 'Approving Pending Example Replays for Scheme'; // Same as line 374.
$str['sch_editor_sch_replay_approving_interface_please_enter_sch_pwd'] = 'Please enter the scheme password';

$str['sch_editor_sch_replay_approving_interface_please_login'] = 'Please log in to approve/reject replays (since the scheme\'s author is a member).';
$str['sch_editor_sch_replay_approving_interface_wrong_sch_password'] = 'Incorrect or unspecified password.';
$str['sch_editor_sch_replay_approving_interface_error_message'] = 'Either the specified scheme doesn\'t exist, or its replays don\'t have to be approved.';

$str['sch_editor_sch_replay_approving_waiting_for_approvement_replays'] = 'Replays Waiting for Approvement';
$str['sch_editor_sch_replay_approving_approved_replays'] = 'Approved Replays';
$str['sch_editor_sch_replay_approving_rejected_replays'] = 'Rejected Replays';

$str['sch_editor_sch_replay_approving_no_replays_waiting_for_approvement'] = 'No Replays Waiting for Approvement.';
$str['sch_editor_sch_replay_approving_no_approved_replays'] = 'No Approved Replays.';
$str['sch_editor_sch_replay_approving_no_rejected_replays'] = 'No Rejected Replays.';

$str['sch_editor_sch_replay_approving_action_message'] = 'Replay #%1 has been %2.'; // I.e. the message that appears on the page where database edits are made ("action")
$str['sch_editor_sch_replay_approving_approved'] = 'approved'; // Replaces the %2 in the above line.
$str['sch_editor_sch_replay_approving_rejected'] = 'rejected'; // Same as above.

$str['sch_editor_sch_replay_approving_no_example_replays_at_all'] = 'No example replays are attached to this scheme.';

$str['sch_editor_sch_exrep_appr_file_id_column'] = 'ID';
$str['sch_editor_sch_exrep_appr_file_name_column'] = 'File Name';
$str['sch_editor_sch_exrep_appr_upload_date_column'] = 'Upload Date';

$str['sch_editor_sch_exrep_appr_approve_column'] = 'Approve';
$str['sch_editor_sch_exrep_appr_reject_column'] = 'Reject';

// My schemes - this section probably won't be created (before a while?).
$str['sch_editor_my_schemes_title'] = 'My Schemes';

// Changelog
$str['sch_editor_changelog'] = 'Changelog';
$str['sch_editor_changelog_intro'] = 'Here\'s the scheme editor\'s changelog.';

$str['sch_editor_changelog_v0_1_0_date'] = 'August 29th, 2012';
$str['sch_editor_changelog_v0_1_0_item1'] = 'First release of the scheme editor, allowing the user to create a scheme and to download it. Available in French and English.';

$str['sch_editor_changelog_v0_1_1_date'] = 'August 30th, 2012';
$str['sch_editor_changelog_v0_1_1_item1'] = '[Improvement] On the scheme creation page: the first few numeric options now use text fields instead of option zones, as suggested by FFie (and with her help). Not finished yet.';
$str['sch_editor_changelog_v0_1_1_item2'] = 'Created this changelog.';

$str['sch_editor_changelog_v0_1_2_date'] = 'August 31st, 2012';
$str['sch_editor_changelog_v0_1_2_item1'] = '[Fixed bug] The round time is now correctly stored if it is defined in seconds. In v0.1.0, the value was incorrectly stored (for example, the 90s value was stored as 39s); in v0.1.1, it was always stored in minutes.';
$str['sch_editor_changelog_v0_1_2_item2'] = '[Fixed] Dates were always shown in French in this changelog.';

$str['sch_editor_changelog_v0_2_0_date'] = 'September 1st, 2012';
$str['sch_editor_changelog_v0_2_0_item1'] = '[Improvement] The creation form has been reorganised so it is smaller, as GreeN suggested.';
$str['sch_editor_changelog_v0_2_0_item2'] = '[Improvement] Finished to apply FFie\'s suggestion.';

$str['sch_editor_changelog_v0_2_1_date'] = 'September 3rd, 2012';
$str['sch_editor_changelog_v0_2_1_item1'] = '[Fixed] Some values (Hotseat Delay, Land Retreat Time and Rope Retreat Time) could be set up to 255 in the editor while the real limit is 127.';

$str['sch_editor_changelog_v0_3_0_date'] = 'September 14th, 2012';
$str['sch_editor_changelog_v0_3_0_item1'] = '[New feature] It is now possible to upload schemes on the database.';

$str['sch_editor_changelog_v0_4_0_date'] = 'September 16th, 2012';
$str['sch_editor_changelog_v0_4_0_item1'] = '[New feature] Added the schemes list.';

$str['sch_editor_changelog_v0_4_1_date'] = 'October 6th, 2012';
$str['sch_editor_changelog_v0_4_1_item1'] = '[Fixed] After in-game testing, I realised that only the Land Retreat Time was limited to 127. The Hotseat Delay and the Rope Retreat Time can be set up to 255 again.';
$str['sch_editor_changelog_v0_4_1_item2'] = '[Fixed] Uploaded schemes without any author name had an empty author field. Now, if no author name is given, the author name will be set to Anonymous.';
$str['sch_editor_changelog_v0_4_1_item3'] = 'Plus some other minor fixes I\'ve released on the previous days and I didn\'t list.';

$str['sch_editor_changelog_v0_4_2_date'] = 'October 24th, 2012';
$str['sch_editor_changelog_v0_4_2_item1'] = '[Improvement] Added custom knocking force setting, RubberWorm v0.0.1.12\'s new feature.';

$str['sch_editor_changelog_v0_5_0_date'] = 'November 5th, 2012';
$str['sch_editor_changelog_v0_5_0_item1'] = '[New feature] Example replays can now be attached to an uploaded scheme, and they\'re downloadable on the scheme list. (It should be possible to attach them to a scheme after its creation/upload in the future.) <em class="ziprar">(Downloading these replays actually didn\'t work: see explanation below.)</em>';
$str['sch_editor_changelog_v0_5_0_item2'] = '[Fixed] Downloading a scheme with a parsed name now works successfully. <em class="ziprar">(This "fix" actually broke scheme download entirely: the required file with the new function wasn\'t loaded on the page managing all scheme downloads - thus triggering a fatal error. Since the same "fix" was applied to replay download, it was broken as well.)</em>';

$str['sch_editor_changelog_v0_5_1_date'] = 'December 1st, 2012';
$str['sch_editor_changelog_v0_5_1_item1'] = '[Fixed] Scheme and replay downloading, accidentally broken in v0.5.0 even with schemes/replays which name doesn\'t need parsing, is now possible again.';

$str['sch_editor_changelog_v0_5_2_date'] = 'January 13th, 2013';
$str['sch_editor_changelog_v0_5_2_item1'] = '[Improvement] Added versions between 3.6.31.0 and 3.7.0.0 in the "Version Override" drop-down list, since it is possible to emulate them with RubberWorm v0.0.1.13.';

$str['sch_editor_changelog_v0_5_2a_date'] = 'January 14th, 2013';
$str['sch_editor_changelog_v0_5_2a_item1'] = '[Minor fix] The Rope Retreat Time and the Hot Seat Delay were still limited to 127 in the uploading scheme part. They\'re now limited to 255.';

$str['sch_editor_changelog_v0_6_0_date'] = 'February 14th, 2013';
$str['sch_editor_changelog_v0_6_0_item1'] = '[New feature] Example replays can now be attached after a scheme\'s creation or upload. Scheme authors can also decide who is allowed to upload replays (author only/everyone but there\'s an approvement system/everyone without approvements, though I can check from time to time or act upon request).';
$str['sch_editor_changelog_v0_6_0_item2'] = '[Improvement] You can now attach more than 5 replays to a scheme, however you still only can upload 5 replays at once - if you want more, do it in two/three/four... times; I don\'t want my server to burn, you know. =)';
$str['sch_editor_changelog_v0_6_0_item3'] = '[Fixed] The replay checking function has been slightly changed, because it used to block some valid replays while testing this version.';

$str['sch_editor_changelog_v0_6_0a_date'] = 'March 5th, 2013';
$str['sch_editor_changelog_v0_6_0a_item1'] = 'The English translation has been corrected by Clown.';

$str['sch_editor_changelog_v0_6_0b_date'] = 'March 6th, 2013';
$str['sch_editor_changelog_v0_6_0b_item1'] = '[Fixed bug] When creating a scheme, the Mine Fuse value was accidentally also saved as the Worm Placement value. <em class="ziprar">(In fact there was no Mine Fuse value at all; see the related fix in v0.6.1.)</em>';

$str['sch_editor_changelog_v0_6_1_date'] = 'March 9th, 2013';
$str['sch_editor_changelog_v0_6_1_item1'] = '[Fixed bug] An update on December 1st (the day where v0.5.1 was released) broke scheme creating; the database field storing example replays attaching permission was incorrectly called with an extra $ sign in front of its name. This is now fixed; scheme creating is working again. Credit goes to Patricio (a Chilean player) for reporting the bug.';
$str['sch_editor_changelog_v0_6_1_item2'] = '[Fixed bug] Due to an error in the scheme creation validation script, the scheme password wasn\'t saved properly when creating a scheme.';
$str['sch_editor_changelog_v0_6_1_item3'] = '[Fixed bug] Due to another error (blind copy-pasting, this time) in the scheme creation form, the Mine Fuse field actually allowed to input the Object Count value a second time.';
$str['sch_editor_changelog_v0_6_1_item4'] = '[Fixed bug] For schemes requiring v3.7.0.0 (due to emulating a version between 3.6.31.0 and 3.7.0.0), the required version string called v3.7.0.0 "3.6.32.0".';
$str['sch_editor_changelog_v0_6_1_item5'] = '[Fixed bug] Schemes without name were indeed named "Unnamed_scheme" when creating the file, but this wasn\'t stored in the database. As a result, it wasn\'t possible to download them. There again, thanks to Patricio for letting me know about this.';

$str['sch_editor_changelog_v0_6_2_date'] = 'March 11th, 2013';
$str['sch_editor_changelog_v0_6_2_item1'] = '[Change] When uploading a scheme with an invalid Stockpiling Mode value, the default is now to disable Stockpiling, rather than enabling Anti-Stockpiling mode.';
$str['sch_editor_changelog_v0_6_2_item2'] = '[Change] Strings from this changelog page and the scheme uploading form validating page have been moved to the string files. This makes the translation process much easier, because strings aren\'t scattered in several files anymore. This also had the effet of decreasing the form validating page\'s size significantly. While I was at it, I also fixed some of the moved strings.';
$str['sch_editor_changelog_v0_6_2_item3'] = '[Fixed bug] When uploading a scheme with an Initial Worm Energy byte value set to 0, this value wasn\'t changed to 1 in the scheme file, despite the message saying otherwise.';
$str['sch_editor_changelog_v0_6_2_item4'] = '[Fixed bug] When uploading a scheme, the Override Version RubberWorm setting didn\'t set the Required Version database field properly: it didn\'t detect v3.6.29.0 or v3.7.0.0, and didn\'t say that RubberWorm was required for versions emulable with v3.6.28.0 or v3.6.29.0.';

$str['sch_editor_changelog_v0_7_0_date'] = 'March 13th, 2013';
$str['sch_editor_changelog_v0_7_0_item1'] = '[New feature] Added the scheme viewer, so you can now view a scheme before downloading it.';
$str['sch_editor_changelog_v0_7_0_item2'] = '[Change] The Air Viscosity option has been renamed to Air Resistance, for more consistency with what actually happens in-game (thanks to Deadcode).';
$str['sch_editor_changelog_v0_7_0_item3'] = '[Fixed bug] The Scheme Upload validating page did not recognize the Custom Knocking force (Super Banana\'s Crate Probability) as a RubberWorm setting.';

$str['sch_editor_changelog_v0_7_1_date'] = 'March 22nd, 2013';
$str['sch_editor_changelog_v0_7_1_item1'] = '[Improvement] Versions from 3.7.0.0 to 3.7.2.1 have been added for emulation, thus making the Scheme Editor fully compatible with RubberWorm for v3.7.2.1\'s settings.';
$str['sch_editor_changelog_v0_7_1_item2'] = '[Change] Language files loading has been optimized.';

$str['sch_editor_changelog_v0_7_2_date'] = 'March 25th, 2013';
$str['sch_editor_changelog_v0_7_2_item1'] = '[Fixed bug] In English, on the Scheme Viewing page, a download count ending with (but different from) "1" or "2" was incorrectly shown. (For example, instead of "downloaded 12 times", "download 1twice" was shown.)';
$str['sch_editor_changelog_v0_7_2_item2'] = '[Partial fix] V0.6.1 repaired scheme storing on the database. However, schemes created between December 1st, 2012 and March 9th, 2013 still aren\'t in the database. A couple of these schemes have been added to the database.';
$str['sch_editor_changelog_v0_7_2_item3'] = '[Fixed bug] V0.6.1 also fixed how Unnamed Scheme are saved on the database, but there again, this hasn\'t been applied to schemes (well, there only was one in that case, actually) created before the fix, thus preventing the scheme from being viewed or downloaded. Now, the affected scheme can be downloaded or viewed properly.';

$str['sch_editor_changelog_v0_7_3_date'] = 'April 14th, 2013';
$str['sch_editor_changelog_v0_7_3_item1'] = '[Improvement] It is now possible to download Example Replays from the Scheme Viewing page (rather than just from the Scheme List page, which is inconsistent).';
$str['sch_editor_changelog_v0_7_3_item2'] = '[Fixed bug] In French, in this Changelog, the second v0.7.2 entry was cut, due to a missing diple ("&gt;").';

$str['sch_editor_changelog_v0_7_4_date'] = 'April 26th, 2013';
$str['sch_editor_changelog_v0_7_4_item1'] = '[Fixed bugs] With a tweaked Flames Limit setting, the Version Required field was misleading in some cases:';
$str['sch_editor_changelog_v0_7_4_item1a'] = 'If a scheme was uploaded with a tweaked Flames Limit setting, the Version Required field would pretend the scheme wouldn\'t be compatible with RubberWorm for 3.7.2.1.';
$str['sch_editor_changelog_v0_7_4_item1b'] = 'If other features were changed in addition to Flames Limit, and if none of them required RubberWorm for 3.6.31.0 or 3.7.x.x, the Version Required field would pretend the scheme doesn\'t require RubberWorm in v3.6.29.0.';
$str['sch_editor_changelog_v0_7_4_item1c'] = 'If other features were changed in addition to Flames Limit, and if any of them required RubberWorm for 3.6.31.0 or 3.7.x.x, the Version Required field would still pretend the scheme is compatible with LaserFix for v3.6.29.0.';
$str['sch_editor_changelog_v0_7_4_item2'] = '[Change] For more consistency, the "or later" mention has been added where applicable in the Version Required database field.';
$str['sch_editor_changelog_v0_7_4_item3'] = 'Note that the above changes don\'t apply to existing schemes.';
$str['sch_editor_changelog_v0_7_4_item4'] = '[Fixed bug] Due to an error, "Wind Influence" and "Air Resistance" settings\' values were showing as "n - .", with no text after the hyphen.';

$str['sch_editor_changelog_v1_0_0_date'] = 'April 28th, 2013';
$str['sch_editor_changelog_v1_0_0_item1'] = '[New feature] It is now possible to Edit a Scheme.';
$str['sch_editor_changelog_v1_0_0_item2'] = '[Improvement] It is now possible to rename a scheme you\'re Uploading.';
$str['sch_editor_changelog_v1_0_0_item3'] = '[Improvement] Example Replays Adding and Handling interfaces are now accessible via the Scheme Viewing page.';
$str['sch_editor_changelog_v1_0_0_item4'] = '[Fixed] On the Scheme Viewing page, if the Description field is empty, a "None" mention will now be shown (before, nothing was shown at all).';
$str['sch_editor_changelog_v1_0_0_item5'] = '[Fixed bug] Due to an error on the Scheme Viewing page, the "Automatic Reaiming" and "Circular Aiming" displayed values actually were reversed: enabling one of them would cause the Scheme Viewer to mark it as "Off", and disabling one of them would cause the Scheme Viewer to mark it as "On".';
$str['sch_editor_changelog_v1_0_0_item6'] = '[Fixed bugs] Bugs making some pages invalid according to the W3C XHTML 1.0 Strict standards:';
$str['sch_editor_changelog_v1_0_0_item6a'] = 'On the Scheme Uploading page, a &lt;td&gt; tag was closed, but never opened. It has been removed.';
$str['sch_editor_changelog_v1_0_0_item6b'] = 'On the Scheme Creating page, two &lt;td&gt; tags were opened, but never closed. They\'re now closed.';
$str['sch_editor_changelog_v1_0_0_item6c'] = 'Note that these bugs didn\'t affect the displayed page; they\'ve been fixed only because they made the affected pages invalid.';
$str['sch_editor_changelog_v1_0_0_item7'] = '[Fixed bugs] Bugs with the Scheme List\'s paging system:';
$str['sch_editor_changelog_v1_0_0_item7a'] = 'Due to an error, the paging system on the Scheme List didn\'t work: it would only show the page with the oldest schemes. Note that this didn\'t affect the public version of the scheme editor, because at that time schemes were still fitting on a single page; the bug has been noticed on my local version.';
$str['sch_editor_changelog_v1_0_0_item7b'] = 'Due to another error, the paging system on the Scheme List would be affected by example replays if more than one was attached to any of the displayed schemes: for example, only 27 schemes (instead of 30) would be shown on a page where 4 example replays were attached to the same scheme.';
$str['sch_editor_changelog_v1_0_0_item8'] = '[Fixed bugs] Bugs with functions checking user input in the Scheme Creation form:';
$str['sch_editor_changelog_v1_0_0_item8a'] = 'If an invalid Victories Count value was entered, the value was reset to 100 instead of 1.';
$str['sch_editor_changelog_v1_0_0_item8b'] = 'Weapon Power and Weapon Crate Probability check functions weren\'t working, due to missing quotation marks (and sometimes commas).';

$str['sch_editor_changelog_v1_0_1_date'] = 'April 29th, 2013';
$str['sch_editor_changelog_v1_0_1_item1'] = '[Fixed] On the Scheme Viewing page, if Aqua Sheep was disabled, the Aqua Sheep icon was still shown as the Super Sheep icon in the weapon settings table.';
$str['sch_editor_changelog_v1_0_1_item2'] = '[Fixed] On the same page, most buttons\' corners weren\'t transparent.';

$str['sch_editor_changelog_v1_0_2_date'] = 'April 30th, 2013';
$str['sch_editor_changelog_v1_0_2_item1'] = '[New translation] A partial Dutch translation by Piki1802 (with some help from DarkOne and HHC) is now available.';
$str['sch_editor_changelog_v1_0_2_item2'] = '[Change] This page is now named changelog.php instead of version-history.php.';
$str['sch_editor_changelog_v1_0_2_item3'] = '[Fixed bug] The apostrophe (\') char is now correctly parsed in Scheme Names, Authors\' Names, and Descriptions (thanks to Piki1802 for helping me realizing the bug was here). <em class="ziprar">(This fix was incomplete, and Viewing a Scheme with an apostrophe in its name or author name became impossible - note that the editor converts apostrophes to grave accents and antislashes to periods in file names. The fix has been completed in v1.0.3.)</em>';
$str['sch_editor_changelog_v1_0_2_item4'] = '[Fixed] When uploading a scheme, the user will now only be offered to download the uploaded scheme if fixes have been applied to it (which is more consistent).';
$str['sch_editor_changelog_v1_0_2_item5'] = '[Fixed] If the Freeze Crate Probability byte value has been fixed when uploading a scheme, it will now be mentioned among fixes.';
$str['sch_editor_changelog_v1_0_2_item6'] = '[Fixed] In French, the Battle Axe was incorrectly called "hache d\'armes", which means "Weapon Axe" (just like in W:A before it was fixed in v3.7.0.0).';

$str['sch_editor_changelog_v1_0_3_date'] = 'May 1st, 2013';
$str['sch_editor_changelog_v1_0_3_item1'] = '[Fixed bug] Due to a missing underscore on the main page of the editor, you had to reselect your language every time you visited that main page (as the missing underscore prevented the language cookie from being recognized).';
$str['sch_editor_changelog_v1_0_3_item2'] = '[Fixed bug] Since v1.0.2, it was impossible to View a Scheme with an apostrophe in its name/author name (there again, thanks to Piki1802 for helping me realizing the bug was present).';

$str['sch_editor_changelog_v1_1_0_date'] = 'May 2nd, 2013';
$str['sch_editor_changelog_v1_1_0_item1'] = '[New feature] It is now possible to create a scheme based on an existing one.';
$str['sch_editor_changelog_v1_1_0_item2'] = '[New feature] It is now possible to create a scheme without saving it on the server and in the database.';
$str['sch_editor_changelog_v1_1_0_item3'] = '[Change] The "Select Another Language" links are no longer translatable. These links are a stopgap until I implement flags anyway.';
?>