<h1><?php echo $str['sch_editor_sch_editing_title'].' '.$get_scheme_info_result['sch_name'].' '.$str['sch_editor_sch_viewer_by'].' '.$get_scheme_info_result['sch_author'].' (#'.$_GET['id'].')'; ?></h1>
<form method="post" action="scheme-edit-check.php" enctype="multipart/form-data">
	<table class="table_no_borders">
	<tr>
		<td style="width:200px;"><label for="sch_name"><?php echo $str['sch_editor_sch_name']; ?></label></td>
		<td style="width:300px; max-width: 300px;"><input type="text" name="sch_name" id="sch_name" value="<?php echo $get_scheme_info_result['sch_name']; ?>" readonly="readonly" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_name_hint2']; ?></span></td>
	</tr>
	<?php if (!isset($_SESSION['id']))
	{
	?>
	<tr>
		<td><label for="sch_password"><?php echo $str['sch_editor_sch_password']; ?></label></td>
		<td><input type="password" name="sch_password" id="sch_password" maxlength="20" /><br />
		<input type="checkbox" name="no_password" id="no_password" <?php if ($get_scheme_info_result['sch_password'] == NULL) { echo 'checked="checked"'; } ?> /><?php echo $str['sch_editor_no_password']; ?></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_password_hint2']; ?></span></td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td><label for="sch_desc"><?php echo $str['sch_editor_sch_desc']; ?></label></td>
		<td><textarea name="sch_desc" id="sch_desc" rows="4" cols="20" ><?php echo $get_scheme_info_result['sch_desc']; ?></textarea></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_sch_desc_hint']; ?></td>
	</tr>
	<tr>
		<td><?php echo $str['sch_editor_sch_example_replays_permissions_label']; ?></td>
		<td colspan="2"><input type="radio" name="sch_exrep_permissions" value="0" id="opt0" <?php if ($get_scheme_info_result['sch_example_replays_permissions'] == 0) { echo 'checked="checked"'; } ?> /> <label for="opt0" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt0']; ?></label><br />
		<input type="radio" name="sch_exrep_permissions" value="1" id="opt1" <?php if ($get_scheme_info_result['sch_example_replays_permissions'] == 1) { echo 'checked="checked"'; } ?> /> <label for="opt1" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt1']; ?></label><br />
		<input type="radio" name="sch_exrep_permissions" value="2" id="opt2" <?php if ($get_scheme_info_result['sch_example_replays_permissions'] == 2) { echo 'checked="checked"'; } ?> /> <label for="opt2" class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_permissions_opt2']; ?></label></td>
	</tr>
	</table>
	
<table class="table_no_borders_2">
<tr>
	<td style="width:400px;">
	<fieldset style="<?php if ($language == 'fr') { echo 'padding-bottom:14px; padding-top:14px;'; } else { echo 'padding-bottom:22px; padding-top:21px;'; } ?>"><legend><?php echo $str['sch_editor_time_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td style="width:280px;"><label for="hotseat"><?php echo $str['sch_editor_hotseat_delay']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_hotseat_delay_hint']; ?>" /></td>
		<td><input type="text" name="hotseat" id="hotseat" maxlength="3" size="2" value="<?php echo ord($file_content[5]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[5]); ?>', '<?php echo $language; ?>')" />s</td>
	</tr>
	<tr>
		<td><label for="retreat_time"><?php echo $str['sch_editor_retreat_time']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_retreat_time_hint']; ?>" /></td>
		<td><input type="text" name="retreat_time" id="retreat_time" maxlength="3" size="2" value="<?php echo ord($file_content[6]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 127, '<?php echo ord($file_content[6]); ?>', '<?php echo $language; ?>')" />s</td>
	</tr>
	<tr>
		<td><label for="rope_retreat_time"><?php echo $str['sch_editor_rope_retreat_time']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rope_retreat_time_hint']; ?>" /></td>
		<td><input type="text" name="rope_retreat_time" id="rope_retreat_time" maxlength="3" size="2" value="<?php echo ord($file_content[7]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[7]); ?>', '<?php echo $language; ?>')" />s</td>
	</tr>
	<tr>
		<td colspan="2">�</td>
	</tr>
	<tr>
		<td><label for="turn_time"><?php echo $str['sch_editor_turn_time']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_turn_time_hint']; ?>" /></td>
		<td><input type="text" name="turn_time" id="turn_time" maxlength="3" size="2" value="<?php echo ord($file_content[27]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 128, '<?php echo ord($file_content[27]); ?>', '<?php echo $language; ?>')" />s</td>
	</tr>
	<tr>
		<?php
		if (ord($file_content[28]) >= 128)
		{
			$round_time = 256 - ord($file_content[28]);
			$round_time_unit = 1;
		}
		else
		{
			$round_time = ord($file_content[28]);
			$round_time_unit = 0;
		}
		?>
		<td><label for="round_time"><?php echo $str['sch_editor_round_time']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_round_time_hint']; ?>" /></td>
		<td><input type="text" name="round_time" id="round_time" maxlength="3" size="2" value="<?php echo $round_time; ?>" style="font-size: 0.9em;" onchange="if (document.getElementById('round_time_2').selectedIndex == 0) { checkValue(this, 0, 127, 15, '<?php echo $language; ?>') } else { checkValue(this, 1, 128, 90, '<?php echo $language; ?>') }" />
		<select name="round_time_2" id="round_time_2">
			<option value="0" <?php if ($round_time_unit == 0) { echo 'selected="selected"'; } ?>>min</option>
			<option value="1" <?php if ($round_time_unit == 1) { echo 'selected="selected"'; } ?>>s</option>
		</select></td>
	</tr>
	<tr>
		<td><label for="round_time_display"><?php echo $str['sch_editor_round_time_display']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_round_time_display_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="round_time_display" id="round_time_display" <?php if (ord($file_content[8]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	</table>
	</fieldset>

	</td>
	<td style="width:400px;">

		<fieldset><legend><?php echo $str['sch_editor_game_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td style="width:280px;"><label for="anchor_mode"><?php echo $str['sch_editor_anchor_mode']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_anchor_mode_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="anchor_mode" id="anchor_mode" <?php if (ord($file_content[11]) != 0) { echo 'checked="checked"'; } ?> /></td>
		<td></td>
	</tr>
	<tr>
		<td><label for="donor_cards"><?php echo $str['sch_editor_donor_cards']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_donor_cards_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="donor_cards" id="donor_cards" <?php if (ord($file_content[18]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<?php
			$fall_damage = ((ord($file_content[10]) * 50) % 256) * 2;
		?>
		<td><label for="fall_damage"><?php echo $str['sch_editor_fall_damage']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_fall_damage_hint']; ?>" /></td>
		<td style="width: 105px;"><input type="text" name="fall_damage" id="fall_damage" maxlength="3" size="2" value="<?php echo $fall_damage; ?>" style="font-size: 0.9em;" onchange="checkValueFallDamage(this, '<?php echo $language; ?>', '<?php echo $fall_damage; ?>')" />%</td>
	</tr>
	<tr>
		<td><label for="stockpiling_mode"><?php echo $str['sch_editor_stockpiling_mode']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_stockpiling_mode_hint']; ?>" /></td>
		<td><select name="stockpiling_mode" id="stockpiling_mode">
			<option value="0" <?php if (ord($file_content[13]) == 0) { echo 'selected="selected"'; } ?>><?php echo $str['off']; ?></option>
			<option value="1" <?php if (ord($file_content[13]) == 1) { echo 'selected="selected"'; } ?>><?php echo $str['sch_editor_stockpiling_mode_acc']; ?></option>
			<option value="2" <?php if (ord($file_content[13]) == 2) { echo 'selected="selected"'; } ?>><?php echo $str['sch_editor_stockpiling_mode_anti']; ?></option>
		</select></td>
	</tr>
	<tr>
		<td><label for="worm_select"><?php echo $str['sch_editor_worm_select']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_worm_select_hint']; ?>" /></td>
		<td><select name="worm_select" id="worm_select">
			<option value="0" <?php if (ord($file_content[14]) == 0) { echo 'selected="selected"'; } ?>><?php echo $str['off']; ?></option>
			<option value="1" <?php if (ord($file_content[14]) == 1 OR ord($file_content[14]) >= 3) { echo 'selected="selected"'; } ?>><?php echo $str['on']; ?></option>
			<option value="2" <?php if (ord($file_content[14]) == 2) { echo 'selected="selected"'; } ?>><?php echo $str['random']; ?></option>
		</select></td>
	</tr>
	<tr>
		<td><label for="worm_placement"><?php echo $str['sch_editor_worm_placement']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_worm_placement_hint']; ?>" /></td>
		<td><select name="worm_placement" id="worm_placement">
			<option value="0" <?php if (ord($file_content[25]) == 0) { echo 'selected="selected"'; } ?>><?php echo $str['random']; ?></option>
			<option value="1" <?php if (ord($file_content[25]) != 0) { echo 'selected="selected"'; } ?>><?php echo $str['manual']; ?></option>
		</select></td>
	</tr>
	<tr>
		<td><label for="initial_worm_energy"><?php echo $str['sch_editor_initial_worm_energy']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_initial_worm_energy_hint']; ?>" /></td>
		<td><input type="text" name="initial_worm_energy" id="initial_worm_energy" maxlength="3" size="2" value="<?php echo ord($file_content[26]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 1, 255, '<?php echo ord($file_content[26]); ?>', '<?php echo $language; ?>')" /> <?php echo $str['health_points_abbr']; ?></td>
	</tr>
	<tr>
		<td><label for="number_of_victories"><?php echo $str['sch_editor_number_of_victories']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_number_of_victories_hint']; ?>" /></td>
		<td><input type="text" name="number_of_victories" id="number_of_victories" maxlength="3" size="2" value="<?php echo ord($file_content[29]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[29]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	</table>
	</fieldset>
	
	</td>
</tr>
<tr>
	<td colspan="2">
	
	<fieldset><legend><?php echo $str['sch_editor_crate_probability_settings']; ?></legend>
	<?php
		// Let's calculate crate probabilities percentages.
		$crate_probabilities = crateProbabilitiesPercentages(ord($file_content[17]), ord($file_content[19]), ord($file_content[21]));
	?>
	<table class="table_no_borders">
	<tr>
		<td style="width: 280px;"><label for="weapon_crate_probability"><?php echo $str['sch_editor_weapon_crate_probability']; ?></label></td>
		<td style="width: 105px;"><input type="text" name="weapon_crate_probability" id="weapon_crate_probability" maxlength="3" size="2" value="<?php echo ord($file_content[17]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 127, '<?php echo ord($file_content[17]); ?>', '<?php echo $language; ?>')" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_weapon_crate_probability_hint']; ?> <input type="text" name="weapon_crate_probability_percentage" id="weapon_crate_probability_percentage" value="<?php echo $crate_probabilities[0]; ?>" readonly="readonly" size="3" maxlength="3" style="font-size: 0.9em;" />%</span></td>
	</tr>
	<tr>
		<td><label for="health_crate_probability"><?php echo $str['sch_editor_health_crate_probability']; ?></label></td>
		<td><input type="text" name="health_crate_probability" id="health_crate_probability" maxlength="3" size="2" value="<?php echo ord($file_content[19]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 127, '<?php echo ord($file_content[19]); ?>', '<?php echo $language; ?>')" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_health_crate_probability_hint']; ?> <input type="text" name="health_crate_probability_percentage" id="health_crate_probability_percentage" value="<?php echo $crate_probabilities[1]; ?>" readonly="readonly" size="3" maxlength="3" style="font-size: 0.9em;" />%</span></td>
	</tr>
	<tr>
		<td><label for="utility_crate_probability"><?php echo $str['sch_editor_utility_crate_probability']; ?></label></td>
		<td><input type="text" name="utility_crate_probability" id="utility_crate_probability" maxlength="3" size="2" value="<?php echo ord($file_content[21]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 127, '<?php echo ord($file_content[21]); ?>', '<?php echo $language; ?>')" /></td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_utility_crate_probability_hint']; ?> <input type="text" name="utility_crate_probability_percentage" id="utility_crate_probability_percentage" value="<?php echo $crate_probabilities[2]; ?>" readonly="readonly" size="3" maxlength="3" style="font-size: 0.9em;" />%</span></td>
	</tr>
		<tr>
		<td><?php echo $str['sch_editor_turns_without_crates']; ?></td>
		<td style="padding-left: 21px;">-</td>
		<td><span class="sch_editor_hint"><?php echo $str['sch_editor_turns_without_crates_hint']; ?> <input type="text" name="turns_without_crates" id="turns_without_crates" value="<?php echo $crate_probabilities[3]; ?>" readonly="readonly" size="3" maxlength="3" style="font-size: 0.9em;" />%</span></td>
	</tr>
	<tr>
		<td colspan="3">�</td>
	</tr>
	<tr>
		<td><label for="health_crate_energy"><?php echo $str['sch_editor_health_crate_energy']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_health_crate_energy_hint']; ?>" /></td>
		<td><input type="text" name="health_crate_energy" id="health_crate_energy" maxlength="3" size="2" value="<?php echo ord($file_content[20]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[20]); ?>', '<?php echo $language; ?>')" /> <?php echo $str['health_points_abbr']; ?></td>
		<td></td>
	</tr>
	</table>
	</fieldset>
	
	</td>
</tr>
<tr>
	<td>
	
	<fieldset style="<?php if ($language == 'fr') { echo 'padding-bottom:18px; padding-top:17px;'; } else { echo 'padding-bottom:25px; padding-top:25px;'; } ?>"><legend><?php echo $str['sch_editor_sudden_death_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td><label for="sudden_death_event"><?php echo $str['sch_editor_sudden_death_event']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_sudden_death_event_hint']; ?>" /></td>
		<td <?php if ($language === 'fr') { echo 'style="width: 220px;"'; } else { echo 'style="width: 175px"'; } ?>><select name="sudden_death_event" id="sudden_death_event">
			<option value="0" <?php if (ord($file_content[15]) == 0) { echo 'selected="selected"'; } ?>><?php echo $str['sch_edit_sd_round_ends']; ?></option>
			<option value="1" <?php if (ord($file_content[15]) == 1) { echo 'selected="selected"'; } ?>><?php echo $str['sch_edit_sd_nuke']; ?></option>
			<option value="2" <?php if (ord($file_content[15]) == 2) { echo 'selected="selected"'; } ?>><?php echo $str['sch_edit_sd_1hp']; ?></option>
			<option value="3" <?php if (ord($file_content[15]) == 3) { echo 'selected="selected"'; } ?>><?php echo $str['sch_edit_sd_water_rise_only']; ?></option>
		</select></td>
	</tr>
	<tr>
		<td><label for="water_rise_speed"><?php echo $str['sch_editor_water_rise_speed']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_water_rise_speed_hint']; ?>" /></td>
		<td><select name="water_rise_speed" id="water_rise_speed">
		<?php
		$counter = 0;
		$water_rise_pixels = array (0, 5, 13, 20, 21, 29, 37, 45, 52, 53, 61, 64, 69, 77, 80, 84, 85, 93, 101, 109, 116, 117, 125, 133, 141, 148, 149, 157, 165, 173, 180, 181, 189, 197, 205, 208, 212, 213, 221, 229, 237, 244, 245, 253); // Those values will be shown to the user (at first I didn't know the formula).
		$water_rise_bytes = array(0, 1, 19, 2, 55, 43, 47, 3, 26, 25, 27, 8, 33, 13, 4, 18, 23, 11, 15, 29, 22, 57, 5, 63, 45, 30, 9, 21, 17, 61, 6, 39, 37, 31, 51, 12, 14, 41, 53, 49, 35, 10, 7, 59); // Those values are used internally.
	
		while($counter <= 43)
		{
			if ($water_rise_bytes[$counter] == ord($file_content[16]))
			{
				echo '<option value="'.$water_rise_bytes[$counter].'" selected="selected">'.$water_rise_pixels[$counter].' px</option>';
			}
			else
			{
				echo '<option value="'.$water_rise_bytes[$counter].'">'.$water_rise_pixels[$counter].' px</option>';
			}
		
			$counter++;
		}
		?>
		</select></td>
	</tr>
	</table>
	</fieldset>
	
	<fieldset style="<?php if ($language == 'fr') { echo 'padding-bottom:18px; padding-top:18px;'; } else { echo 'padding-bottom:26px; padding-top:25px;'; } ?>"><legend><?php echo $str['sch_editor_hazardous_objects_settings']; ?></legend>
	<?php
		$object_info = hazardousObjectByteDecrypt(ord($file_content[22]));
		
		$object_type = $object_info[0];
		$object_count = $object_info[2];
	?>
	<table class="table_no_borders">
	<tr>
		<td style="width: 280px;"><label for="object_type"><?php echo $str['sch_editor_object_type']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_object_type_hint']; ?>" /></td>
		<td style="width: 105px;"><select name="object_type" id="object_type">
			<option value="0" <?php if ($object_type == 0) { echo 'selected="selected"'; } ?>><?php echo $str['none']; ?></option>
			<option value="1" <?php if ($object_type == 1) { echo 'selected="selected"'; } ?>><?php echo $str['mines']; ?></option>
			<option value="2" <?php if ($object_type == 2) { echo 'selected="selected"'; } ?>><?php echo $str['barrels']; ?></option>
			<option value="3" <?php if ($object_type == 3) { echo 'selected="selected"'; } ?>><?php echo $str['both']; ?></option>
		</select></td>
	</tr>
	<tr>
		<td><label for="object_count"><?php echo $str['sch_editor_object_count']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_object_count_hint']; ?>" /></td>
		<td><input type="text" name="object_count" id="object_count" maxlength="3" size="2" value="<?php echo $object_count; ?>" style="font-size: 0.9em;" onchange="checkValueHazardousObjectCount(this, '<?php echo $language; ?>', '<?php echo $object_count; ?>')" /></td>
	</tr>
	<tr>
		<td colspan="3">�</td>
	</tr>
	<tr>
		<td><label for="mine_fuse"><?php echo $str['sch_editor_mine_fuse']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_mine_fuse_hint']; ?>" /></td>
		<td><input type="text" name="mine_fuse" id="mine_fuse" maxlength="3" size="2" value="<?php echo ord($file_content[23]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 127, '<?php echo ord($file_content[23]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="dud_mines"><?php echo $str['sch_editor_dud_mines']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_dud_mines_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="dud_mines" id="dud_mines" <?php if (ord($file_content[24]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	</table>
	</fieldset>
	
	</td>
	<td>

	<fieldset><legend><?php echo $str['sch_editor_general_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td style="width:280px;"><label for="action_replays"><?php echo $str['sch_editor_action_replays']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_action_replays_hint']; ?>" /></td>
		<td style="padding-left: 25px; width: 80px;"><input type="checkbox" name="action_replays" id="action_replays" <?php if (ord($file_content[9]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="blood_mode"><?php echo $str['sch_editor_blood_mode']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_blood_mode_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="blood_mode" id="blood_mode" <?php if (ord($file_content[30]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="invincibility"><?php echo $str['sch_editor_invincibility']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_invincibility_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="invincibility" id="invincibility" <?php if (ord($file_content[33]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="sheep_heaven"><?php echo $str['sch_editor_sheep_heaven']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_sheep_heaven_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="sheep_heaven" id="sheep_heaven" <?php if (ord($file_content[32]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="indestructible_landscape"><?php echo $str['sch_editor_indestructible_landscape']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_indestructible_landscape_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="indestructible_landscape" id="indestructible_landscape" <?php if (ord($file_content[34]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	</table>
	</fieldset>
	
	<fieldset><legend><?php echo $str['sch_editor_weapon_upgrade_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td style="width:280px;"><label for="aqua_sheep"><?php echo $str['sch_editor_aqua_sheep']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_aqua_sheep_hint']; ?>" /></td>
		<td style="padding-left: 25px; width: 80px;"><input type="checkbox" name="aqua_sheep" id="aqua_sheep" <?php if (ord($file_content[31]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="upgraded_grenade"><?php echo $str['sch_editor_upgraded_grenade']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_upgraded_grenade_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="upgraded_grenade" id="upgraded_grenade" <?php if (ord($file_content[35]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="upgraded_clusters"><?php echo $str['sch_editor_upgraded_clusters']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_upgraded_clusters_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="upgraded_clusters" id="upgraded_clusters" <?php if (ord($file_content[37]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="upgraded_shotgun"><?php echo $str['sch_editor_upgraded_shotgun']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_upgraded_shotgun_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="upgraded_shotgun" id="upgraded_shotgun" <?php if (ord($file_content[36]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="upgraded_longbow"><?php echo $str['sch_editor_upgraded_longbow']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_upgraded_longbow_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="upgraded_longbow" id="upgraded_longbow" <?php if (ord($file_content[38]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	</table>
	</fieldset>
	
	</td>
</tr>
<tr>
	<td colspan="2">

	<fieldset><legend><?php echo $str['sch_editor_weapon_settings']; ?></legend>
	<table class="table_no_borders">
	<tr>
		<td><label for="team_weapons"><?php echo $str['sch_editor_team_weapons']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_team_weapons_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="team_weapons" id="team_weapons" <?php if (ord($file_content[39]) != 0) { echo 'checked="checked"'; } ?> /></td>
		<td style="width:280px; vertical-align: middle;" rowspan="2"><label for="double_damage"><?php echo $str['sch_editor_double_damage']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_double_damage_hint']; ?>" /></td>
		<td style="padding-left: 25px; vertical-align: middle;" rowspan="2"><input type="checkbox" name="double_damage" id="double_damage" <?php if (ord($file_content[217]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="super_weapons"><?php echo $str['sch_editor_super_weapons']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_super_weapons_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="super_weapons" id="super_weapons" <?php if (ord($file_content[40]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	</table>
	
	<p class="ziprar"><em><?php echo $str['sch_editor_general_weapons_hint']; ?></em></p>
	<!-- Let's finally go for weapons! -->
	
	<table class="normal_table" style="text-align: center; margin-top: 1.5em; width: 540px; margin-left: auto; margin-right: auto;">
	<tr>
		<th style="width: 220px;"><ins><?php echo $str['weapon']; ?></ins></th>
		<th style="width: 80px;"><ins><?php echo $str['ammo']; ?></ins></th>
		<th style="width: 80px;"><ins><?php echo $str['power']; ?></ins></th>
		<th style="width: 80px;"><ins><?php echo $str['delay']; ?></ins></th>
		<th style="width: 80px;"><ins><?php echo $str['crate_probability']; ?></ins></th>
	</tr>
	<tr>
		<th colspan="5"><?php echo $str['utilities']; ?></th>
	</tr>
	<?php
	$weapons_power = array(true, false, false, false, false, //   Utilities
						   true, true, true, true, true, //       F1
						   true, true, true, true, false, //      F2
						   true, true, true, true, true, //       F3
						   true, true, true, false, true, //      F4
						   true, true, true, true, true, //       F5
						   true, true, false, false, false, //    F6
						   true, true, true, true, false, //      F7
						   true, true, true, true, false, //      F8
						   false, true, true, false, false, //    F9
						   true, true, false, false, false, //    F10
						   true, true, false, false, false, //    F11
						   false, false, false); //				  F12
						   
	$weapons_crate_probability = array(false, false, false, false, false, //   Utilities
									   true, true, true, true, true, //       F1
									   true, true, true, true, false, //      F2
									   true, true, true, true, true, //       F3
									   true, true, true, false, true, //      F4
									   true, true, true, true, true, //       F5
									   true, true, false, false, false, //    F6
									   true, true, true, true, false, //      F7
									   true, true, true, true, false, //      F8
									   false, true, true, false, false, //    F9
									   true, true, false, false, false, //    F10
									   true, true, false, false, false, //    F11
									   false, false, false); //				  F12
	
	$counter_weapon = 0;
	
	while ($counter_weapon < 5)
	{
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) - 4;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		
		if ($power < 0)
		{
			$power = 30;
		}

		if($counter_weapon === 0)
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['jetpack'].'" />';
		}
		else
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['utilities'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($counter_weapon === 0)
		{
		echo '<td><input type="text" name="weap39_power" id="weap39_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" title="'.$str['sch_editor_jet_pack_power_message'].'" onchange="checkValueJetpackPower(this, \''.$language.'\', \''.$power.'\')" /></td>';
		}
		else
		{
		echo '<td style="text-align: center;">-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<td>-</td>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	<tr>
		<th colspan="5">F1</th>
	</tr>
	<?php
	while ($counter_weapon < 10)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon]; ?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" maxlength="3" size="2" value="<?php echo $power; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, '<?php echo $power; ?>', '<?php echo $language; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" maxlength="3" size="2" value="<?php echo $crate_prob; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo $crate_prob; ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F2</th>
	</tr>
	<?php
	while ($counter_weapon < 15)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];

		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F3</th>
	</tr>
	<?php
	while ($counter_weapon < 20)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon]; ?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" maxlength="3" size="2" value="<?php echo $power; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, '<?php echo $power; ?>', '<?php echo $language; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" maxlength="3" size="2" value="<?php echo $crate_prob; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo $crate_prob; ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F4</th>
	</tr>
	<?php
	while ($counter_weapon < 25)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon]; 
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>

	<tr>
		<th colspan="5">F5</th>
	</tr>
	<?php
	while ($counter_weapon < 30)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];	?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_power" maxlength="3" size="2" value="<?php echo $power; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, '<?php echo $power; ?>', '<?php echo $language; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_crates" maxlength="3" size="2" value="<?php echo $crate_prob; ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo $crate_prob; ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F6</th>
	</tr>
	<?php
	while ($counter_weapon < 35)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon]; 
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F7</th>
	</tr>
	<?php
	while ($counter_weapon < 40)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].' '.$str['weapons_hint']['girder_starter_pack'].'" />';
		}
		else if($counter_weapon === 37)
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['girder'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F8</th>
	</tr>
	<?php
	while ($counter_weapon < 45)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		else if($counter_weapon === 40)
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['ninja_rope'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F9</th>
	</tr>
	<?php
	while ($counter_weapon < 50)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F10</th>
	</tr>
	<?php
	while ($counter_weapon < 55)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F11</th>
	</tr>
	<?php
	while ($counter_weapon < 60)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$power = ord($file_content[42 + $weapons_id[$counter_weapon] * 4]) + 1;
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
		$crate_prob = ord($file_content[44 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		if(!$weapons_crate_probability[$counter_weapon])
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<?php
		if($weapons_power[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_power" id="weap'.$weapons_id[$counter_weapon].'_power" maxlength="3" size="2" value="'.$power.'" style="font-size: 0.9em;" onchange="checkValue(this, 1, 256, \''.$power.'\', \''.$language.'\')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<?php
		if($weapons_crate_probability[$counter_weapon])
		{
			echo '<td><input type="text" name="weap'.$weapons_id[$counter_weapon].'_crates" id="weap'.$weapons_id[$counter_weapon].'_crates" maxlength="3" size="2" value="'.$delay.'" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, \''.$delay.'\', '.$language.')" /></td>';
		}
		else
		{
		echo '<td>-</td>';
		}
		?>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	
	<tr>
		<th colspan="5">F12</th>
	</tr>
	<?php
	while ($counter_weapon < 63)
	{
		$ammo = ord($file_content[41 + $weapons_id[$counter_weapon] * 4]);
		$delay = ord($file_content[43 + $weapons_id[$counter_weapon] * 4]);
	?>
	<tr>
		<td style="text-align: left;"><?php echo $str['weapons_list'][$counter_weapon];
		
		if ($counter_weapon === 60)
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].' '.$str['weapons_hint']['select_worm'].'" />';
		}
		else // Freeze and Patsy's Magic Bullet are both super weapons
		{
		echo ' <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="'.$str['weapons_hint']['super_weapon'].'" />';
		}
		?></td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_ammo" maxlength="3" size="2" value="<?php echo $ammo; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponAmmo(this, '<?php echo $language; ?>', '<?php echo $ammo; ?>')" /></td>
		<td>-</td>
		<td><input type="text" name="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" id="weap<?php echo $weapons_id[$counter_weapon]; ?>_delay" maxlength="3" size="2" value="<?php echo $delay; ?>" style="font-size: 0.9em;" onchange="checkValueWeaponDelay(this, '<?php echo $language; ?>', '<?php echo $delay; ?>')" /></td>
		<td>-</td>
	</tr>
	<?php
	
	$counter_weapon++;
	}
	?>
	</table>
	</fieldset>
	
	</td>
</tr>
<tr>
	<td colspan="2">
	
	<fieldset><legend><?php echo $str['sch_editor_rubber_settings']; ?></legend>
	<p class="ziprar"><em><?php echo $str['sch_editor_rubber_settings_warning']; ?></em></p>
	<?php
	// Settings stored in the Mole Squadron Crate Probability Byte.
	$mole_squadron_settings = ord($file_content[272]);
	
	if ($mole_squadron_settings % 2 == 1)
	{
		$sdet = true;
	}
	if ($mole_squadron_settings % 4 >= 2)
	{
		$ldet = true;
	}
	if ($mole_squadron_settings % 8 >= 4)
	{
		$fdpt = true;
	}
	if ($mole_squadron_settings % 16 >= 8)
	{
		$irope = true;
	}
	if ($mole_squadron_settings % 32 >= 16)
	{
		$ccs = true;
	}
	if ($mole_squadron_settings % 64 >= 32)
	{
		$ope = true;
	}
	if ($mole_squadron_settings % 128 >= 64)
	{
		$wdca = true;
	}
	if ($mole_squadron_settings >= 128)
	{
		$fuseex = true;
	}


	// Settings stored in the Earthquake Crate Probability Byte.
	$earthquake_settings = ord($file_content[272]);
	
	if ($earthquake_settings % 2 == 1)
	{
		$auto_reaim = true;
	}
	if ($earthquake_settings % 4 >= 2)
	{
		$cira = true;
	}
	if ($earthquake_settings % 8 >= 4)
	{
		$alp = true;
	}
	if ($earthquake_settings % 16 >= 8)
	{
		$usw = true;
	}
	
	if ($earthquake_settings % 32 >= 16)
	{
		if ($earthquake_settings % 64 >= 32)
		{
			if ($earthquake_settings % 128 >= 64)
			{
				$kaosmod = 4;
			}
			else
			{
				$kaosmod = 2;
			}
		}
		else if ($earthquake_settings % 128 >= 64)
		{
			$kaosmod = 3;
		}
		else if ($earthquake_settings > 128)
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
		$kaosmod = 0;
	}
	?>
	<table class="table_no_borders">
	<tr>
		<td style="width:280px;"><label for="rubber_sdet"><?php echo $str['sch_editor_rubber_sdet']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_sdet_hint']; ?>" /></td>
		<td style="padding-left: 25px; width: 80px;"><input type="checkbox" name="rubber_sdet" id="rubber_sdet" <?php  if (!isset($sdet)) { echo 'checked="checked"'; } // Yes, this inconsistency still has to be fixed. ?> /></td>
		<td style="width:280px;"><label for="rubber_crate_rate"><?php echo $str['sch_editor_rubber_crate_rate']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_crate_rate_hint']; ?>" /></td>
		<td style="width:105px;"><input type="text" name="rubber_crate_rate" id="rubber_crate_rate" maxlength="3" size="2" value="<?php echo ord($file_content[260]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[260]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_usw"><?php echo $str['sch_editor_rubber_usw']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_usw_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_usw" id="rubber_usw" <?php  if (isset($usw)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_crate_limit"><?php echo $str['sch_editor_rubber_crate_limit']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_crate_limit_hint']; ?>" /></td>
		<td><input type="text" name="rubber_crate_limit" id="rubber_crate_limit" maxlength="3" size="2" value="<?php echo ord($file_content[256]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[256]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_ldet"><?php echo $str['sch_editor_rubber_ldet']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_ldet_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_ldet" id="rubber_ldet" <?php  if (!isset($ldet)) { echo 'checked="checked"'; } // This inconsistency still has to be fixed as well. ?> /></td>
		<td><label for="rubber_kaosmod"><?php echo $str['sch_editor_rubber_kaosmod']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_kaosmod_hint']; ?>" /></td>
		<td><select name="rubber_kaosmod" id="rubber_kaosmod">
		<?php
		$counter = 0;
	
		while($counter <= 5)
		{
			if ($counter == 0)
			{
				if ($kaosmod == 0)
				{
					echo '<option value="0" selected="selected">'.$str['none'].'</option>';
				}
				else
				{
					echo '<option value="0">'.$str['none'].'</option>';
				}
			}
			else
			{
				if ($kaosmod == $counter)
				{
					echo '<option value="'.$counter.'" selected="selected">kaosmod'.$counter.'</option>';
				}
				else
				{
					echo '<option value="'.$counter.'">kaosmod'.$counter.'</option>';
				}
			}
		
		$counter++;
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td><label for="rubber_fdpt"><?php echo $str['sch_editor_rubber_fdpt']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_fdpt_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_fdpt" id="rubber_fdpt" <?php  if (isset($fdpt)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_knocking_force"><?php echo $str['sch_editor_rubber_knocking_force']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_knocking_force_hint']; ?>" /></td>
		<td><input type="text" name="rubber_knocking_force" id="rubber_knocking_force" maxlength="3" size="2" value="<?php echo ord($file_content[228]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[228]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_improved_rope"><?php echo $str['sch_editor_rubber_improved_rope']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_improved_rope_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_improved_rope" id="rubber_improved_rope" <?php  if (isset($irope)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_worms_bounciness"><?php echo $str['sch_editor_rubber_worms_bounciness']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_worms_bounciness_hint']; ?>" /></td>
		<td><input type="text" name="rubber_worms_bounciness" id="rubber_worms_bounciness" maxlength="3" size="2" value="<?php echo ord($file_content[296]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[296]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_ccs"><?php echo $str['sch_editor_rubber_ccs']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_ccs_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_ccs" id="rubber_ccs" <?php  if (isset($ccs)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_friction"><?php echo $str['sch_editor_rubber_friction']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_friction_hint']; ?>" /></td>
		<td><input type="text" name="rubber_friction" id="rubber_friction" maxlength="3" size="2" value="<?php echo ord($file_content[268]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[268]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_ope"><?php echo $str['sch_editor_rubber_ope']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_ope_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_ope" id="rubber_ope" <?php  if (isset($ope)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_flames_limit"><?php echo $str['sch_editor_rubber_flames_limit']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_flames_limit_hint']; ?>" /></td>
		<td><input type="text" name="rubber_flames_limit" id="rubber_flames_limit" maxlength="3" size="2" value="<?php echo ord($file_content[244]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[244]); ?>', '<?php echo $language; ?>')" /> � 100</td>
	</tr>
	<tr>
		<td><label for="rubber_wdca"><?php echo $str['sch_editor_rubber_wdca']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_wdca_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_wdca" id="rubber_wdca" <?php  if (isset($wdca)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_speed"><?php echo $str['sch_editor_rubber_speed']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_speed_hint']; ?>" /></td>
		<td><input type="text" name="rubber_speed" id="rubber_speed" maxlength="3" size="2" value="<?php echo ord($file_content[232]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[232]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_fuseex"><?php echo $str['sch_editor_rubber_fuseex']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_fuseex_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_fuseex" id="rubber_fuseex" <?php  if (isset($fuseex)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_air_resistance"><?php echo $str['sch_editor_rubber_air_resistance']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_air_resistance_hint']; ?>" /></td>
		<td><input type="text" name="rubber_air_resistance" id="rubber_air_resistance" maxlength="3" size="2" value="<?php echo ord($file_content[280]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[280]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td><label for="rubber_wind_influence"><?php echo $str['sch_editor_rubber_wind_influence']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_wind_influence_hint']; ?>" /></td>
		<td><input type="text" name="rubber_wind_influence" id="rubber_wind_influence" maxlength="3" size="2" value="<?php echo ord($file_content[284]); ?>" style="font-size: 0.9em;" onchange="checkValue(this, 0, 255, '<?php echo ord($file_content[284]); ?>', '<?php echo $language; ?>')" /></td>
	</tr>
	<tr>
		<td><label for="rubber_auto_reaim"><?php echo $str['sch_editor_rubber_auto_reaim']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_auto_reaim_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_auto_reaim" id="rubber_auto_reaim" <?php  if (isset($auto_reaim)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_gravity_modifications"><?php echo $str['sch_editor_rubber_gravity_modifications']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_gravity_modifications_hint']; ?>" /></td>
		<td><select name="rubber_gravity_modifications" id="rubber_gravity_modifications">
		<?php
		$counter = 0;
		$value = 0;
		
		$gravity_value = ord($file_content[292]);
	
		// Natural gravity settings
		while($counter <= 63)
		{
			if ($counter == 0 && $gravity_value == 0)
			{
				echo '<option value="0" selected="selected">'.$str['none_2'].'</option>';
			}
			else if ($counter == 0)
			{
				echo '<option value="0">'.$str['none_2'].'</option>';
			}
			else if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">grav'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">grav'.$counter.'</option>';
			}
		
			$counter++;
			$value++;
		}
		
		// Reversed gravity
		while($counter >= 1)
		{
			if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">grav-'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">grav-'.$counter.'</option>';
			}
		
			$counter--;
			$value++;
		}
		
		// Constant black hole (cbh) mode
		while($counter <= 31)
		{
			if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">cbh'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">cbh'.$counter.'</option>';
			}
		
			$counter++;
			$value++;
		}
		
		// Reversed cbh gravity
		while($counter >= 1)
		{
			if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">cbh-'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">cbh-'.$counter.'</option>';
			}
		
			$counter--;
			$value++;
		}
		
		// Proportional black hole (pbh) mode
		while($counter <= 31)
		{
			if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">pbh'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">pbh'.$counter.'</option>';
			}
		
			$counter++;
			$value++;
		}
		
		// Reversed pbh gravity
		while($counter >= 1)
		{
			if ($gravity_value == $value)
			{
				echo '<option value="'.$value.'" selected="selected">pbh-'.$counter.'</option>';
			}
			else
			{
				echo '<option value="'.$value.'">pbh-'.$counter.'</option>';
			}

			$counter--;
			$value++;
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td><label for="rubber_circular_aim"><?php echo $str['sch_editor_rubber_circular_aim']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_circular_aim_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_circular_aim" id="rubber_circular_aim" <?php  if (isset($cira)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_anti_worm_sink"><?php echo $str['sch_editor_rubber_anti_worm_sink']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_anti_worm_sink_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_anti_worm_sink" id="rubber_anti_worm_sink" <?php if (ord($file_content[288]) != 0) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td><label for="rubber_antilock_power"><?php echo $str['sch_editor_rubber_antilock_power']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_antilock_power_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_antilock_power" id="rubber_antilock_power" <?php  if (isset($alp)) { echo 'checked="checked"'; } ?> /></td>
		<td><label for="rubber_swat"><?php echo $str['sch_editor_rubber_swat']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_swat_hint']; ?>" /></td>
		<td style="padding-left: 25px;"><input type="checkbox" name="rubber_swat" id="rubber_swat" <?php if (ord($file_content[276]) % 2 == 1) { echo 'checked="checked"'; } ?> /></td>
	</tr>
	<tr>
		<td colspan="4">�</td>
	</tr>
	<tr>
		<td><label for="rubber_version_override"><?php echo $str['sch_editor_rubber_version_override']; ?></label> <img src="../../images/sch-editor-hint-icon.png" alt="(Hover for a tip)" title="<?php echo $str['sch_editor_rubber_version_override_hint']; ?>" /></td>
		<td colspan="3">
		<?php
		// Emulated Version.
		$emulated_version = ord($file_content[264]);
		
		// Add 256 * the Freeze CP value (which currently can only be 0 or 1).
		$emulated_version += 256 * $file_content[224];
		?>
		<select name="rubber_version_override" id="rubber_version_override">
			<option value="0" <?php if ($emulated_version == 0) { echo 'selected="selected"'; } ?>><?php echo $str['none_2']; ?></option>
			<?php
			$counter = 1;
	
			while($counter < count($versions_list))
			{
				if ($emulated_version == $counter)
				{
					echo '<option value="'.$counter.'" selected="selected">'.$versions_list[$counter].'</option>';
				}
				else
				{
					echo '<option value="'.$counter.'">'.$versions_list[$counter].'</option>';
				}
		
				$counter++;
			}
			?>
		</select></td>
	</tr>
	</table>
	</fieldset>
	
	</td>
</tr>
<tr>
	<?php $sch_id = (int) $_GET['id']; ?>
	<td colspan="2" style="text-align:center;">
	<p><input type="hidden" name="action" value="edit" /><input type="hidden" name="sch_id" value="<?php echo $sch_id; ?>" /><input type="submit" value="<?php echo $str['sch_editor_send']; ?>" /></p>
	</td>
</tr>
</table>
</form>