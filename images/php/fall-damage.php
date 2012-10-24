<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 127)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$dest = imagecreatefrompng('../png/fall-damage/off.png'); // There, we'll show the image it as it is.
	}
	else
	{
		$dest = imagecreatefrompng('../png/fall-damage/on.png'); // The image I'll include the number on.
		$value = (string) (($_GET['v'] * 50) % 256) * 2;
		
		$white = imagecolorallocate($dest, 255, 255, 255);		
		imagettftext($dest, 8, 0, 3, 14, $white, '../font/verdana.ttf', $value.'%');
	}

	imagepng($dest);

	imagedestroy($dest);
}
?>