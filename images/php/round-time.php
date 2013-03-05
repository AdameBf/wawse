<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 255)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] >= 128) // Then round time is in seconds.
	{
		$dest = imagecreatefrompng('../png/round-time/round-time-seconds.png'); // The image I'll include the number on.
		$source = imagecreatefrompng('../png/numbers/24x24.png'); // Numbers

		$value = 256 - $_GET['v'];
		$value = (string) $value;
		$value_length = strlen($value);

		switch($value_length)
		{
			case 1:
			$value = (int) $value;
			if ($value == 1)
			{
			imagecopy($dest, $source, 23, 25, 0, 24 * $value, 24, 24);
			}
			else if ($value == 9)
			{
			imagecopy($dest, $source, 22, 25, 0, 24 * $value, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 22, 25, 0, 24 * $value, 24, 24);
			}
			break;

			case 2:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];

			// First part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			imagecopy($dest, $source, 18, 25, 0, 24 * $value1, 24, 24);
			imagecopy($dest, $source, 27, 25, 0, 24 * $value2, 24, 24);
			}
			else if ($value1 == 1)
			{
			imagecopy($dest, $source, 16, 25, 0, 24 * $value1, 24, 24);
			}
			else if ($value1 == 9)
			{
			imagecopy($dest, $source, 15, 25, 0, 24 * $value1, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 16, 25, 0, 24 * $value1, 24, 24);
			}

			// Second part of the value
			if ($value2 == 1 && $value1 != 1)
			{
			imagecopy($dest, $source, 30, 25, 0, 24 * $value2, 24, 24);
			}
			else if ($value2 == 1 && $value1 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 27, 25, 0, 24 * $value2, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 28, 25, 0, 24 * $value2, 24, 24);
			}
			break;

			case 3:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];
			$value3 = (int) $value[2];

			// First part of the value: it is always 1. However, plan a special centering method for 111.
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			imagecopy($dest, $source, 11, 25, 0, 24 * $value1, 24, 24);
			imagecopy($dest, $source, 22, 25, 0, 24 * $value2, 24, 24);
			imagecopy($dest, $source, 33, 25, 0, 24 * $value3, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 10, 25, 0, 24 * $value1, 24, 24);
			}

			// Second part of the value: it is at most 2
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 1)
			{
			imagecopy($dest, $source, 21, 25, 0, 24 * $value2, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 21, 25, 0, 24 * $value2, 24, 24);
			}

			// Third part of the value: can be anything from 0 to 9
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value3 == 1)
			{
			imagecopy($dest, $source, 33, 25, 0, 24 * $value3, 24, 24);
			}
			else if ($value3 == 9)
			{
			imagecopy($dest, $source, 33, 25, 0, 24 * $value3, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 34, 25, 0, 24 * $value3, 24, 24);
			}
			break;
			
			default:
			exit();
			break;
		}
	}
	else
	{
		$dest = imagecreatefrompng('../png/round-time/round-time-minutes.png'); // The image I'll include the number on.
		$source = imagecreatefrompng('../png/numbers/24x24.png'); // Numbers

		$value = (string) $_GET['v'];
		$value_length = strlen($value);

		switch($value_length)
		{
			case 1:
			$value = (int) $value;
			if ($value == 1)
			{
			imagecopy($dest, $source, 23, 26, 0, 24 * $value, 24, 24);
			}
			else if ($value == 9)
			{
			imagecopy($dest, $source, 21, 26, 0, 24 * $value, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 22, 26, 0, 24 * $value, 24, 24);
			}
			break;

			case 2:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];

			// First part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			imagecopy($dest, $source, 17, 26, 0, 24 * $value1, 24, 24);
			imagecopy($dest, $source, 27, 26, 0, 24 * $value2, 24, 24);
			}
			else if ($value1 == 1)
			{
			imagecopy($dest, $source, 16, 26, 0, 24 * $value1, 24, 24);
			}
			else if ($value1 == 9)
			{
			imagecopy($dest, $source, 15, 26, 0, 24 * $value1, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 15, 26, 0, 24 * $value1, 24, 24);
			}

			// Second part of the value
			if ($value2 == 1 && $value1 != 1)
			{
			imagecopy($dest, $source, 28, 26, 0, 24 * $value2, 24, 24);
			}
			else if ($value2 == 1 && $value1 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 26, 26, 0, 24 * $value2, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 28, 26, 0, 24 * $value2, 24, 24);
			}
			break;

			case 3:
			$value1 = (int) $value[0];
			$value2 = (int) $value[1];
			$value3 = (int) $value[2];

			// First part of the value: it is always 1. However, plan a special centering method for 111.
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			imagecopy($dest, $source, 11, 26, 0, 24 * $value1, 24, 24);
			imagecopy($dest, $source, 22, 26, 0, 24 * $value2, 24, 24);
			imagecopy($dest, $source, 33, 26, 0, 24 * $value3, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 10, 26, 0, 24 * $value1, 24, 24);
			}

			// Second part of the value: it is at most 2
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 1)
			{
			imagecopy($dest, $source, 22, 26, 0, 24 * $value2, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 21, 26, 0, 24 * $value2, 24, 24);
			}

			// Third part of the value: can be anything from 0 to 9
			if ($value1 == 1 && $value2 == 1 && $value3 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value3 == 1)
			{
			imagecopy($dest, $source, 35, 26, 0, 24 * $value3, 24, 24);
			}
			else if ($value3 == 9)
			{
			imagecopy($dest, $source, 34, 26, 0, 24 * $value3, 24, 24);
			}
			else
			{
			imagecopy($dest, $source, 35, 26, 0, 24 * $value3, 24, 24);
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