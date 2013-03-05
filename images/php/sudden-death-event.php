<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 3)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$image = imagecreatefrompng('../png/sudden-death-events/round-ends.png');
	}
	else if ($_GET['v'] == 1)
	{
		$image = imagecreatefrompng('../png/sudden-death-events/nuclear-strike.png');
	}
	else if ($_GET['v'] == 2)
	{
		$image = imagecreatefrompng('../png/sudden-death-events/1hp.png');
	}
	else
	{
		$image = imagecreatefrompng('../png/sudden-death-events/water-rise-only.png');
	}

	imagepng($image);

	imagedestroy($image);
}
?>