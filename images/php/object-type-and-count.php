<?php
require('../../includes/functions.php');

if (isset($_GET['v']) && validHazardsByteValue($_GET['v']))
{
	header ('Content-type: image/png'); // PNG will be the best format for this kind of use.
	
	// Firstly, what are the Object Type and Count?
	// For that, let's just run a pre-made function, hazardousObjectByteDecrypt()
	$results = hazardousObjectByteDecrypt($_GET['v']);
	
	$object_type = $results[0];
	$object_count = $results[2];
	
	// Now, we need to load the images
	if ($object_type == 0)
	{
		$dest = imagecreatefrompng('../png/hazardous-objects/none.png'); // There, we won't need to load numbers, as we're already done.
	}
	else
	{
		$source = imagecreatefrompng('../png/numbers/14x14.png'); // Numbers
		
		if ($object_type == 1)
		{
			$dest = imagecreatefrompng('../png/hazardous-objects/mines.png');
		}
		else if ($object_type == 2)
		{
			$dest = imagecreatefrompng('../png/hazardous-objects/barrels.png');
		}
		else
		{
			$dest = imagecreatefrompng('../png/hazardous-objects/both.png');
		}
	
		$obj_count = (string) $object_count; // Required for length testing? Not sure...
		$value_length = strlen($obj_count);

		switch($value_length)
		{
			case 1:
			$value = (int) $obj_count;
			
			if ($object_count == 1)
			{
			imagecopy($dest, $source, 55, 4, 0, 14, 14, 14);
			}
			else if ($object_count == 9)
			{
			imagecopy($dest, $source, 54, 4, 0, 126, 14, 14);
			}
			else
			{
			imagecopy($dest, $source, 54, 4, 0, 14 * $value, 14, 14);
			}
			break;

			case 2:
			$value1 = (int) $obj_count[0];
			$value2 = (int) $obj_count[1];

			// First part of the value
			if ($value2 == 1 && $value1 == 1)
			{
			imagecopy($dest, $source, 49, 4, 0, 14 * $value1, 14, 14);
			imagecopy($dest, $source, 56, 4, 0, 14 * $value2, 14, 14);
			}
			else if ($value1 == 1)
			{
			imagecopy($dest, $source, 47, 4, 0, 14 * $value1, 14, 14);
			}
			else if ($value1 == 9)
			{
			imagecopy($dest, $source, 46, 4, 0, 14 * $value1, 14, 14);
			}
			else
			{
			imagecopy($dest, $source, 46, 4, 0, 14 * $value1, 14, 14);
			}

			// Second part of the value
			if ($value2 == 1 && $value1 != 1)
			{
			imagecopy($dest, $source, 54, 4, 0, 14 * $value2, 14, 14);
			}
			else if ($value2 == 1 && $value1 == 1)
			{
			// Nothing, we already did it earlier.
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 54, 4, 0, 14 * $value2, 14, 14);
			}
			else
			{
			imagecopy($dest, $source, 54, 4, 0, 14 * $value2, 14, 14);
			}
			break;

			case 3:
			$value1 = (int) $obj_count[0];
			$value2 = (int) $obj_count[1];
			// (Third part of this value is always 0.)

			// First part of the value: it is either 1 or 2
			if ($value1 == 1)
			{
			imagecopy($dest, $source, 40, 4, 0, 14 * $value1, 14, 14);
			}
			else
			{
			imagecopy($dest, $source, 39, 4, 0, 14 * $value1, 14, 14);
			}

			// Second part of the value: can be anything from 0 to 9
			if ($value2 == 1)
			{
			imagecopy($dest, $source, 47, 4, 0, 14 * $value2, 14, 14);
			}
			else if ($value2 == 9)
			{
			imagecopy($dest, $source, 46, 4, 0, 14 * $value2, 14, 14);
			}
			else
			{
			imagecopy($dest, $source, 46, 4, 0, 14 * $value2, 14, 14);
			}

			// Third part of the value: it is always 0
			imagecopy($dest, $source, 54, 4, 0, 0, 14, 14);
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