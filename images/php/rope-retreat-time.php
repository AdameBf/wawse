<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 255)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.

	$dest = imagecreatefrompng('../png/rope-retreat-time.png'); // The image I'll include the number on.
	$source = imagecreatefrompng('../png/numbers/28x28.png'); // Numbers

	$value = (string) $_GET['v'];
	$value_length = strlen($value);

	switch($value_length)
	{
		case 1:
		$value = (int) $value;
		if ($value == 1)
		{
			imagecopy($dest, $source, 22, 5, 0, 28 * $value, 28, 28);
		}
		else if ($value == 9)
		{
			imagecopy($dest, $source, 20, 5, 0, 28 * $value, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 21, 5, 0, 28 * $value, 28, 28);
		}
		break;

		case 2:
		$value1 = (int) $value[0];
		$value2 = (int) $value[1];

		// First part of the value
		if ($value2 == 1 && $value1 == 1)
		{
			imagecopy($dest, $source, 14, 5, 0, 28 * $value1, 28, 28);
			imagecopy($dest, $source, 27, 5, 0, 28 * $value2, 28, 28);
		}
		else if ($value1 == 1)
		{
			imagecopy($dest, $source, 14, 5, 0, 28 * $value1, 28, 28);
		}
		else if ($value1 == 9)
		{
			imagecopy($dest, $source, 11, 5, 0, 28 * $value1, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 12, 5, 0, 28 * $value1, 28, 28);
		}

		// Second part of the value
		if ($value2 == 1 && $value1 != 1)
		{
			imagecopy($dest, $source, 29, 5, 0, 28 * $value2, 28, 28);
		}
		else if ($value2 == 1 && $value1 == 1)
		{
			// Nothing, we already did it earlier.
		}
		else if ($value2 == 9)
		{
			imagecopy($dest, $source, 27, 5, 0, 28 * $value2, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 28, 5, 0, 28 * $value2, 28, 28);
		}
		break;

		case 3:
		$value1 = (int) $value[0];
		$value2 = (int) $value[1];
		$value3 = (int) $value[2];

		// First part of the value: it is either 1 or 2
		if ($value1 == 1)
		{
			imagecopy($dest, $source, 6, 5, 0, 28 * $value1, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 5, 5, 0, 28 * $value1, 28, 28);
		}

		// Second part of the value: can be anything from 0 to 9
		if ($value2 == 1)
		{
			imagecopy($dest, $source, 21, 5, 0, 28 * $value2, 28, 28);
		}
		else if ($value2 == 9)
		{
			imagecopy($dest, $source, 20, 5, 0, 28 * $value2, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 20, 5, 0, 28 * $value2, 28, 28);
		}

		// Third part of the value: can be anything from 0 to 9
		if ($value3 == 1)
		{
			imagecopy($dest, $source, 36, 5, 0, 28 * $value3, 28, 28);
		}
		else if ($value3 == 9)
		{
			imagecopy($dest, $source, 35, 5, 0, 28 * $value3, 28, 28);
		}
		else
		{
			imagecopy($dest, $source, 36, 5, 0, 28 * $value3, 28, 28);
		}
		break;

		default:
		exit();
		break;
	}

	imagepng($dest);

	imagedestroy($dest);
	imagedestroy($source);
}
?>