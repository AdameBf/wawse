<?php
if (isset($_GET['v']) && $_GET['v'] == 0 || $_GET['v'] == 1)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$image = imagecreatefrompng('../png/dud-mines/off.png');
	}
	else
	{
		$image = imagecreatefrompng('../png/dud-mines/on.png');
	}

	imagepng($image);

	imagedestroy($image);
}
?>