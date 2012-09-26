<?php
function fileNameParser($text)
{
	$text = str_replace(' ', '_', $text);
	$text = str_replace('<', '\[', $text);
	$text = str_replace('>', '\]', $text);
	$text = str_replace('/', '\.', $text);
	$text = str_replace('|', '\.', $text);
	$text = str_replace('\\', '\.', $text);
	$text = str_replace('"', '', $text);
	$text = str_replace('\'', '`', $text);
	$text = str_replace('\*', '', $text);
	$text = str_replace(':', '', $text);
	$text = str_replace('\?', '', $text);
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
	$format = 'H*'; // I don't think it's the right behaviour, though
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
	else
	{
	return 'en';
	}
}

function onceTwice($text)
{
	// - English
	$text = str_replace('1 times', 'once', $text);
	$text = str_replace('2 times', 'twice', $text);
	
	// - French: no changes.
	
	// Once we're done with all the languages, let's return the new text.
	return $text;
}
?>