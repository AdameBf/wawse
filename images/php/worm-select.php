<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 2)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$image = imagecreatefrompng('../png/worm-select/off.png');
	}
	else if ($_GET['v'] == 1)
	{
		$image = imagecreatefrompng('../png/worm-select/on.png');
	}
	else
	{
		$image = imagecreatefrompng('../png/worm-select/random.png');
	}

	imagepng($image);

	imagedestroy($image);
}
?>