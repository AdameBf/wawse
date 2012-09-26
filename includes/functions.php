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
	$text = str_replace('�', 'a', $text);
	$text = str_replace('�', 'A', $text);
	$text = str_replace('�', 'a', $text);
	$text = str_replace('�', 'A', $text);
	$text = str_replace('�', 'a', $text);
	$text = str_replace('�', 'A', $text);
	$text = str_replace('�', 'a', $text);
	$text = str_replace('�', 'A', $text);
	$text = str_replace('�', 'e', $text);
	$text = str_replace('�', 'E', $text);
	$text = str_replace('�', 'e', $text);
	$text = str_replace('�', 'E', $text);
	$text = str_replace('�', 'e', $text);
	$text = str_replace('�', 'E', $text);
	$text = str_replace('�', 'e', $text);
	$text = str_replace('�', 'E', $text);
	$text = str_replace('�', 'c', $text);
	$text = str_replace('�', 'C', $text);
	$text = str_replace('�', 'i', $text);
	$text = str_replace('�', 'I', $text);
	$text = str_replace('�', 'i', $text);
	$text = str_replace('�', 'I', $text);
	$text = str_replace('�', 'i', $text);
	$text = str_replace('�', 'I', $text);
	$text = str_replace('�', 'i', $text);
	$text = str_replace('�', 'I', $text);
	$text = str_replace('�', 'n', $text);
	$text = str_replace('�', 'N', $text);
	$text = str_replace('�', 'o', $text);
	$text = str_replace('�', 'O', $text);
	$text = str_replace('�', 'o', $text);
	$text = str_replace('�', 'O', $text);
	$text = str_replace('�', 'o', $text);
	$text = str_replace('�', 'O', $text);
	$text = str_replace('�', 'o', $text);
	$text = str_replace('�', 'O', $text);
	$text = str_replace('�', 'Oe', $text);
	$text = str_replace('�', 'ss', $text);
	$text = str_replace('�', 'u', $text);
	$text = str_replace('�', 'U', $text);
	$text = str_replace('�', 'u', $text);
	$text = str_replace('�', 'U', $text);
	$text = str_replace('�', 'u', $text);
	$text = str_replace('�', 'U', $text);
	$text = str_replace('�', 'u', $text);
	$text = str_replace('�', 'U', $text);
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