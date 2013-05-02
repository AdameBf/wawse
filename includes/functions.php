<?php
function fileNameParser($text)
{
	$text = str_replace(' ', '_', $text);
	$text = str_replace('<', '[', $text);
	$text = str_replace('>', ']', $text);
	$text = str_replace('/', '.', $text);
	$text = str_replace('|', '.', $text);
	$text = str_replace('\\', '.', $text);
	$text = str_replace('"', '``', $text);
	$text = str_replace('\'', '`', $text);
	$text = str_replace('*', '', $text);
	$text = str_replace(':', '.', $text);
	$text = str_replace('?', '.', $text);
	$text = str_replace('!', '.', $text);
	$text = str_replace('%', '', $text);
	$text = str_replace('á', 'a', $text);
	$text = str_replace('Á', 'A', $text);
	$text = str_replace('à', 'a', $text);
	$text = str_replace('À', 'A', $text);
	$text = str_replace('â', 'a', $text);
	$text = str_replace('Â', 'A', $text);
	$text = str_replace('ä', 'a', $text);
	$text = str_replace('Ä', 'A', $text);
	$text = str_replace('é', 'e', $text);
	$text = str_replace('É', 'E', $text);
	$text = str_replace('è', 'e', $text);
	$text = str_replace('È', 'E', $text);
	$text = str_replace('ê', 'e', $text);
	$text = str_replace('Ê', 'E', $text);
	$text = str_replace('ë', 'e', $text);
	$text = str_replace('Ë', 'E', $text);
	$text = str_replace('ç', 'c', $text);
	$text = str_replace('Ç', 'C', $text);
	$text = str_replace('í', 'i', $text);
	$text = str_replace('Í', 'I', $text);
	$text = str_replace('ì', 'i', $text);
	$text = str_replace('Ì', 'I', $text);
	$text = str_replace('î', 'i', $text);
	$text = str_replace('Î', 'I', $text);
	$text = str_replace('ï', 'i', $text);
	$text = str_replace('Ï', 'I', $text);
	$text = str_replace('ñ', 'n', $text);
	$text = str_replace('Ñ', 'N', $text);
	$text = str_replace('ó', 'o', $text);
	$text = str_replace('Ó', 'O', $text);
	$text = str_replace('ò', 'o', $text);
	$text = str_replace('Ò', 'O', $text);
	$text = str_replace('ô', 'o', $text);
	$text = str_replace('Ô', 'O', $text);
	$text = str_replace('ö', 'o', $text);
	$text = str_replace('Ö', 'O', $text);
	$text = str_replace('Œ', 'Oe', $text);
	$text = str_replace('ß', 'ss', $text);
	$text = str_replace('ú', 'u', $text);
	$text = str_replace('Ú', 'U', $text);
	$text = str_replace('ù', 'u', $text);
	$text = str_replace('Ù', 'U', $text);
	$text = str_replace('û', 'u', $text);
	$text = str_replace('Û', 'U', $text);
	$text = str_replace('ü', 'u', $text);
	$text = str_replace('Ü', 'U', $text);
	$text = str_replace('__', '_', $text);
	
	return $text;
}

function packingFormat($value)
{
$format = NULL;

	if ($value >= 0 && $value <= 15)
	{
	$format = 'h';
	}
	else if ($value >= 16 && $value <= 255)
	{
	$format = 'H*';
	}
	else
	{
	$new_value = $value % 256; // Something limited to 255 is limited to 255, period. If you don't respect this, then don't cry for unexpected values. :P
	$format = packingFormat($new_value); // Yes, recursivity kicks in. (This is the first time I have a recursive function, actually.)
	}
	
return $format;
}

function setLanguage($language)
{
	if ($language === 'fr')
	{
		return $language;
	}
	else if ($language === 'en')
	{
		return $language;
	}
	else if ($language === 'nl')
	{
		return $language;
	}
	else
	{
		return 'en';
	}
}

function onceTwice($text)
{
	// - English
	$text = str_replace('downloaded 0 times', 'never downloaded', $text);
	$text = str_replace(' 1 times', ' once', $text);
	$text = str_replace(' 2 times', ' twice', $text);
	
	// - French:
	$text = str_replace('téléchargé 0 fois', 'jamais téléchargé', $text);
	
	// Once we're done with all the languages, let's return the new text.
	return $text;
}

function validHazardsByteValue($value) // When generating the image on the scheme view page.
{
	$value = (int) $value;
	
	if ($value >= 0 && $value <= 2)
	{
	return true;
	}
	else if ($value == 5)
	{
	return true;
	}
	else if ($value >= 12 && $value <= 247)
	{
	return true;
	}
	else
	{
	return false;
	}
}

function hazardousObjectByteDecrypt($value, $language = 'en') // Might only be using this on the scheme viewing page though; I won't bother replacing old occurences.
{
	$value = (int) $value;
	
	if ($language == 'fr')
	{
		$object_types_array = array('Aucun', 'Mines', 'Barils', 'Mines et Barils');
	}
	else
	{
		$object_types_array = array('None', 'Mines', 'Barrels', 'Both Mines and Barrels');
	}
	$object_counts_array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250);
	
	if (validHazardsByteValue($value))
	{
		// Object Type
		if ($value < 12)
		{
			// Then we have the old values.
			switch ($value)
			{
				case 0:
				$object_type = $object_types_array[0];
				$object_type_numeric_value = 0;
				break;
				
				case 1:
				$object_type = $object_types_array[1];
				$object_type_numeric_value = 1;
				break;
				
				case 2:
				$object_type = $object_types_array[2];
				$object_type_numeric_value = 2;
				break;
				
				case 5:
				$object_type = $object_types_array[3];
				$object_type_numeric_value = 3;
				break;
				
				default:
				$object_type = $object_types_array[1];
				$object_type_numeric_value = 1;
				break;
			}
			
			$object_count = 8;
		}
		else
		{
			$object_type_numeric_value = $value % 4;
			$object_type = $object_types_array[$object_type_numeric_value];
			$object_count = $object_counts_array[($value - 8 - $object_type_numeric_value) / 4];
		}
		
		$results = array($object_type_numeric_value, $object_type, $object_count);
	}
	else
	{
		$results = array(1, $object_types_array[1], 8);
	}
	
	return $results;
}

function replayFileCheck($file) // Warning, this function hasn't been tested yet.
{
	if (isset($file) AND $file['error'] == 0)
	{
		if ($file['size'] <= 3000000)
		{
			$file_infos = pathinfo($file['name']);
            $uploaded_file_format = $file_infos['extension'];
            $uploaded_file_name = $file_infos['filename'];
            $uploaded_file_name_2 = fileNameParser($file_infos['filename']);
            
            if ($uploaded_file_format == 'WAgame')
            {
				// Then let's check a few things in the file proving it is valid
				$file_content = file_get_contents($file['tmp_name']);
				
				if ($file_content[0] == 'W' && $file_content[1] == 'A') // Signature, firstly.
				{
					// Let's continue, then.
					if (ord($file_content[9]) == 0 || ord($file_content[9]) == 255) // It seems that values can be -1 (0xFFFFFFFF), 1, 2 or 3, so the 3 other bytes are either 0x00 or 0xFF...
					{
						if (ord($file_content[10]) == ord($file_content[9]) && ord($file_content[11]) == ord($file_content[9])) // ... but these 3 bytes always have the same value.
						{
							// Should be enough, for now at least.
							return true;
						}
					}
				}
			}
		}
	}
	
	return false;
}

function echoWaterRiseSpeedTitleAttribute($byte_value) // Doesn't work; this will need some further investigating.
{
	$value = (pow(ord($byte_value), 2) * 5) / 2;
	
	if ($value != 0 && $value != 5 && $value != 20 && $value != 45)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function crateProbabilitiesPercentages($weapon_crates_byte, $health_crates_byte, $utility_crates_byte)
{
	if (max($weapon_crates_byte, $health_crates_byte, $utility_crates_byte) == 0) // Since the script will rely on a division, let's immediately avoid divisions by zero.
	{
		$results = array(0, 0, 0, 100);
		return $results;
	}
	else
	{
		$divider = 3;
		
		if ($weapon_crates_byte == 0)
		{
			$divider--;
		}
		if ($health_crates_byte == 0)
		{
			$divider--;
		}
		if ($utility_crates_byte == 0)
		{
			$divider--;
		}
		
		$weapon_crates = round($weapon_crates_byte / $divider);
		$health_crates = round($health_crates_byte / $divider);
		$utility_crates = round($utility_crates_byte / $divider);
		
		$total = $weapon_crates + $health_crates + $utility_crates;
		
		if ($total > 100)
		{
			$difference = $total - 100;
			$no_crates = 0;
			
			if ($difference > $utility_crates)
			{
				$utility_crates = 0;
				$difference -= $utility_crates;
				
				if ($difference > $health_crates)
				{
					$health_crates = 0;
					$difference -= $health_crates;
					
					$weapon_crates -= $difference;
				}
				else
				{
					$health_crates -= $difference;
				}
			}
			else
			{
				$utility_crates -= $difference;
			}
		}
		else
		{
			$no_crates = 100 - $total;
		}
		
		$results = array($weapon_crates, $health_crates, $utility_crates, $no_crates);
		return $results;
	}
}

function weaponsInScheme($scheme_file_content) // Checks whether or not a scheme contains any weapons ammunition and crate probabilities.
{
	$bytes_array = array(); // This array will contain every weapon's ammuntion and every regular weapon's crate probability.

	// Weapons ammunition.
	$i = 0;
	while ($i < 63)
	{
		$bytes_array[] = ord($scheme_file_content[41 + $i * 4]);
		$i++;
	}
	
	// Regular weapons crate probabilities.
	$i = 0;
	while ($i < 38)
	{
		$bytes_array[] = ord($scheme_file_content[44 + $i * 4]);
		$i++;
	}

	// Checking if any of all those values exceeds 0.
	if (max($bytes_array) == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function isRubberScheme($scheme_file_content) // Checks whether or not a scheme is a RubberWorm scheme.
{
	$bytes_array = array(); // This array will contain every super weapon's crate probability that stores one or more RubberWorm settings.
	
	$i = 46;
	while ($i < 64)
	{
		if ($i != 48 AND $i != 51 AND $i != 52)
		{
			$bytes_array[] = ord($scheme_file_content[44 + $i * 4]);
		}

		$i++;
	}
	
	if (max($bytes_array) == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function apostropheParse($text)
{
	if (strpos($text, "\'") !== false)
	{
		while (strpos($text, "\'") !== false)
		{
			$text = str_replace("\'", "'", $text);
		}
	}

	return $text;
}
?>