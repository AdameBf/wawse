<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 2)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$image = imagecreatefrompng('../png/stockpiling/default.png');
	}
	else if ($_GET['v'] == 1)
	{
		$image = imagecreatefrompng('../png/stockpiling/accumulative.png');
	}
	else
	{
		$image = imagecreatefrompng('../png/stockpiling/anti-accumulative.png');
	}

	imagepng($image);

	imagedestroy($image);
}
?>