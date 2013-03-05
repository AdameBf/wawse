<?php
if (isset($_GET['v']) && $_GET['v'] >= 0 && $_GET['v'] <= 63)
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	if ($_GET['v'] == 0)
	{
		$dest = imagecreatefrompng('../png/water-rise-speed/no-water-rise.png'); // There, we'll show the image it as it is.
	}
	else if ($_GET['v'] == 1)
	{
		$dest = imagecreatefrompng('../png/water-rise-speed/slow-water-rise.png'); // There again, we'll show the image it as it is.
	}
	else if ($_GET['v'] == 2)
	{
		$dest = imagecreatefrompng('../png/water-rise-speed/medium-speeded-water-rise.png'); // And that's so until 3 (I know, I could just have done a switch here).
	}
	else if ($_GET['v'] == 3)
	{
		$dest = imagecreatefrompng('../png/water-rise-speed/fast-water-rise.png'); // Aaaaand here is the last one.
	}
	else // It's a custom water rise speed.
	{
		$dest = imagecreatefrompng('../png/water-rise-speed/custom-water-rise-speed.png'); // The image I'll include the number on.
		$source = imagecreatefrompng('../png/numbers/28x28.png'); // Numbers

		$value = (pow($_GET['v'], 2) * 5) % 256;
		$value = (string) $value;
		$value_length = strlen($value);

		switch($value_length)
		{
			case 1: // Repeats of 0 byte value (16, 32, 48).

			$dest = imagecreatefrompng('../png/water-rise-speed/no-water-rise.png');
			$source = NULL;

			break;

			case 2:
			if ($value == 20) // Repeat(s) of 2 (like 62).
			{
				$dest = imagecreatefrompng('../png/water-rise-speed/medium-speeded-water-rise.png');
				$source = NULL;
			}
			else
			{
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