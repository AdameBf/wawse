<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 63)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	
	if (isset($_GET['aquasheep']))
	{
		if ($_GET['aquasheep'] == 1)
		{
			$src = imagecreatefrompng('../png/weapons/weapon-panel-2.png');
		}
		else
		{
			$src = imagecreatefrompng('../png/weapons/weapon-panel.png');
		}
	}
	else // Let's assume it is disabled.
	{
		$src = imagecreatefrompng('../png/weapons/weapon-panel.png');
	}
	$dest = imagecreatetruecolor(28, 28);

	$value = $_GET['v'];
	
	$row = floor($value / 5);
	$column = $value % 5;
	
	if ($row == 12)
	{
	// Get the appropriate icon.
	imagecopy($dest, $src, 0, 0, 89 + $column * 29, 2 + $row * 29, 28, 28);
	}
	else
	{
	// Get the appropriate icon.
	imagecopy($dest, $src, 0, 0, 31 + $column * 29, 2 + $row * 29, 28, 28);
	}

	imagepng($dest);

	imagedestroy($src);
	imagedestroy($dest);
}
?>