<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 127)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	
	if ($_GET['v'] >= 128 OR $_GET['v'] == 4) // Random fuse.
	{
		$dest = imagecreatefrompng('../png/mine-fuse/random-fuse.png'); // There, we'll show the image it as it is.
	}
	else if ($_GET['v'] >= 0 AND $_GET['v'] <= 3) // 0-3s fuse.
	{
		$dest = imagecreatefrompng('../png/mine-fuse/'.$_GET['v'].'s.png'); // There again, images are already ready.
	}
	else // 5-127s fuse.
	{
		$dest = imagecreatefrompng('../png/mine-fuse/custom-mine-fuse.png'); // The image I'll include the number on.
		$value = (string) $_GET['v'];
		$value_length = strlen($value);
		
		$red = imagecolorallocate($dest, 255, 0, 0);
		if ($value_length == 1)
		{
			imagettftext($dest, 24, 0, 24, 32, $red, '../font/verdana.ttf', $value);
		}
		else if ($value_length == 2)
		{
			imagettftext($dest, 24, 0, 15, 32, $red, '../font/verdana.ttf', $value);
		}
		else
		{
			imagettftext($dest, 24, 0, 4, 32, $red, '../font/verdana.ttf', $value);
		}
	}
	
	imagepng($dest);

	imagedestroy($dest);
}
?>