<?php
if (isset($_GET['v']) && $_GET['v'] > 0 && $_GET['v'] <= 255)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.

		$dest = imagecreatefrompng('../png/health-crate-energy.png'); // The image I'll include the number on.
		$source = imagecreatefrompng('../png/numbers/21x21.png'); // Numbers

		$value = (string) $_GET['v'];
		$value_length = strlen($value);

		switch($value_length)
		{
			case 1:
			$value = (int) $value;
			if ($value == 1)
			{
			imagecopy($dest, $source, 24, 3, 0, 21 * $value, 21, 21);
			}
			else if ($value == 9)
			{
			imagecopy($dest, $source, 22, 3, 0, 21 * $value, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 23, 3, 0, 21 * $value, 21, 21);
			}
			break;

			case 2:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];

			// First part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			imagecopy($dest, $source, 18, 3, 0, 21 * $value1, 21, 21);
			imagecopy($dest, $source, 29, 3, 0, 21 * $value2, 21, 21);
			}
			else if ($value1 == 1)
			{
			imagecopy($dest, $source, 19, 3, 0, 21 * $value1, 21, 21);
			}
			else if ($value1 == 9)
			{
			imagecopy($dest, $source, 16, 3, 0, 21 * $value1, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 17, 3, 0, 21 * $value1, 21, 21);
			}

			// Second part of the value
			if ($value2 == 1 && $value1 != 1)
			{
			imagecopy($dest, $source, 29, 3, 0, 21 * $value2, 21, 21);
			}
			else if ($value2 == 1 && $value1 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 28, 3, 0, 21 * $value2, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 29, 3, 0, 21 * $value2, 21, 21);
			}
			break;

			case 3:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];
			$value3 = (int) $value[2];

			// First part of the value: it is either 1 or 2
			if ($value1 == 1)
			{
			imagecopy($dest, $source, 12, 3, 0, 21 * $value1, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 11, 3, 0, 21 * $value1, 21, 21);
			}

			// Second part of the value: can be anything from 0 to 9
			if ($value2 == 1)
			{
			imagecopy($dest, $source, 24, 3, 0, 21 * $value2, 21, 21);
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 22, 3, 0, 21 * $value2, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 23, 3, 0, 21 * $value2, 21, 21);
			}

			// Third part of the value: can be anything from 0 to 9
			if ($value3 == 1)
			{
			imagecopy($dest, $source, 36, 3, 0, 21 * $value3, 21, 21);
			}
			else if ($value3 == 9)
			{
			imagecopy($dest, $source, 34, 3, 0, 21 * $value3, 21, 21);
			}
			else
			{
			imagecopy($dest, $source, 35, 3, 0, 21 * $value3, 21, 21);
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