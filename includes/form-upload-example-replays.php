<form method="post" action="?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
	<p><!--<label for="sch_ex_rep1" class="aligner"><?php echo $str['sch_editor_sch_example_replays']; ?><br />
	<span class="sch_editor_hint"><?php echo $str['sch_editor_sch_example_replays_hint']; ?></span></label>-->
	<input type="file" name="sch_ex_rep1" id="sch_ex_rep1" class="champ" /><br />
	<input type="file" name="sch_ex_rep2" id="sch_ex_rep2" class="champ" /><br />
	<input type="file" name="sch_ex_rep3" id="sch_ex_rep3" class="champ" /><br />
	<input type="file" name="sch_ex_rep4" id="sch_ex_rep4" class="champ" /><br />
	<input type="file" name="sch_ex_rep5" id="sch_ex_rep5" class="champ" /></p>

	<p><input type="hidden" name="replays_sent" value="true" /><input type="submit" value="<?php echo $str['sch_editor_sch_replay_uploader_button'];?>" class="bouton" /></p>
</form>