<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 255)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$dest = imagecreatefrompng('../png/wins-required/1-round.png'); // There, we'll show the image it as it is.
	}
	else
	{
		$dest = imagecreatefrompng('../png/wins-required/wins-required.png'); // The image I'll include the number on.
		$source = imagecreatefrompng('../png/numbers/21x21.png'); // Numbers

		$value = (string) $_GET['v'];
		$value_length = strlen($value);

		switch($value_length)
		{
			case 1:
			$value = (int) $value;
			if ($value == 1)
			{
			imagecopy($dest, $source, 24, 18, 0, 21 * $value, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 23, 18, 0, 21 * $value, 21, 21);
			}
			break;

			case 2:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];

			// First part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			imagecopy($dest, $source, 20, 18, 0, 21 * $value1, 21, 21);
			imagecopy($dest, $source, 29, 18, 0, 21 * $value2, 21, 21);
			}
			else if ($value1 == 1)
			{
			imagecopy($dest, $source, 19, 18, 0, 21 * $value1, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 18, 18, 0, 21 * $value1, 21, 21);
			}

			// Second part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else
			{
			imagecopy($dest, $source, 29, 18, 0, 21 * $value2, 21, 21);
			}
			break;

			case 3:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];
			$value3 = (int) $value[2];

			// 111 value
			if ($value == '111')
			{
			imagecopy($dest, $source, 14, 18, 0, 21 * $value1, 21, 21);
			imagecopy($dest, $source, 24, 18, 0, 21 * $value1, 21, 21);
			imagecopy($dest, $source, 34, 18, 0, 21 * $value1, 21, 21);
			}
			
			// First part of the value: it is either 1 or 2
			if ($value1 == 1 && $value != '111')
			{
			imagecopy($dest, $source, 12, 18, 0, 21 * $value1, 21, 21);
			}
			else if ($value1 == 1 && $value == '111')
			{
			}
			else
			{
			imagecopy($dest, $source, 12, 18, 0, 21 * $value1, 21, 21);
			}

			// Second part of the value: can be anything from 0 to 9
			if ($value2 == 1 && $value != '111')
			{
			imagecopy($dest, $source, 24, 18, 0, 21 * $value2, 21, 21);
			}
			else if ($value2 == 1 && $value == '111')
			{
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 22, 18, 0, 21 * $value2, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 23, 18, 0, 21 * $value2, 21, 21);
			}

			// Third part of the value: can be anything from 0 to 9
			if ($value3 == 1 && $value != '111')
			{
			imagecopy($dest, $source, 35, 18, 0, 21 * $value3, 21, 21);
			}
			else if ($value3 == 1 && $value == '111')
			{
			}
			else if ($value3 == 9)
			{
			imagecopy($dest, $source, 33, 18, 0, 21 * $value3, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 34, 18, 0, 21 * $value3, 21, 21);
			}
			break;
			
			default:
			exit();
			break;
		}
	}

	imagepng($dest);

	imagedestroy($dest);
	if (isset($source))
	{
		imagedestroy($source);
	}
}
?>