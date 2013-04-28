// Special thanks to FFie ;)

function checkValue(elem, min, max, default_value = 0, language = 'en')
{
	var value = parseInt(elem.value);
	if (isNaN(value) || value < min || value > max)
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre '+min+' et '+max+'.');
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error : this value must be a number!');
			}
			else
			{
			alert('Error : this value must be a number between '+min+' and '+max+'.');
			}
		}
		elem.value = default_value;
	}
}

function checkValueFallDamage(elem, language = 'en', fall_back_value = 100)
{
var value = parseInt(elem.value);
	if (isNaN(value) || value < 0 || value > 508 || value % 4 != 0)
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			}
			else if (value % 4 != 0 && value >= 0 && value <= 508)
			{
			alert('Erreur : cette valeur doit divisible par 4.');
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre 0 et 508.');
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error: this value must be a number!');
			}
			else if (value % 4 != 0 && value >= 0 && value <= 508)
			{
			alert('Error: this value must be divisible by 4.');
			}
			else
			{
			alert('Error: this value must be a number between 0 and 508.');
			}
		}

		elem.value = fall_back_value;
	}
}

function checkValueHazardousObjectCount(elem, language = 'en', fall_back_value = 8)
{
var value = parseInt(elem.value);
	if (isNaN(value) || value < 1 || value > 250) // Out of boundaries values
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			}
			else if (value == 0)
			{
			alert('Si vous ne voulez aucun objet, alors mettez "Aucun" en type d\'objet.');
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre 1 et 250.');
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error: this value must be a number!');
			}
			else if (value == 0)
			{
			alert('If you want 0 objects, then set "None" as the object type.');
			}
			else
			{
			alert('Error: this value must be a number between 1 and 250.');
			}
		}

		elem.value = fall_back_value;
	}
	else if (value > 30 && value <= 100)
	{
		var modulo_result = value % 5;
		if (modulo_result != 0)
		{
			if (language == 'fr')
			{
			alert('Erreur : si cette valeur est comprise entre 30 et 100, alors elle doit être divisible par 5.');
			}
			else
			{
			alert('Error: if this value is between 30 and 100, then it must be divisible by 5.');
			}

			switch (modulo_result) // Let's round the value
			{
			case 1:
			elem.value = value - 1;
			break;
			
			case 2:
			elem.value = value - 2;
			break;
			
			case 3:
			elem.value = value + 2;
			break;
			
			case 4:
			elem.value = value + 1;
			break;
			}
		}
	}
	else if (value > 100 && value <= 250)
	{
		var modulo_result = value % 10;
		if (modulo_result != 0)
		{
			if (language == 'fr')
			{
			alert('Erreur : si cette valeur est comprise entre 100 et 250, alors elle doit être divisible par 10.');
			}
			else
			{
			alert('Error: if this value is between 100 and 250, then it must be divisible by 10.');
			}

			switch (modulo_result) // Again, let's round the value
			{
			case 1:
			elem.value = value - 1;
			break;
			
			case 2:
			elem.value = value - 2;
			break;
			
			case 3:
			elem.value = value - 3;
			break;
			
			case 4:
			elem.value = value - 4;
			break;
			
			case 5:
			elem.value = value + 5;
			break;
			
			case 6:
			elem.value = value + 4;
			break;
			
			case 7:
			elem.value = value + 3;
			break;
			
			case 8:
			elem.value = value + 2;
			break;
			
			case 9:
			elem.value = value + 1;
			break;
			}
		}
	}
}

function checkValueWeaponAmmo(elem, language = 'en', fall_back_value = 0)
{
	var value = parseInt(elem.value);
	if (isNaN(value) || value < 0 || value > 127)
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			elem.value = fall_back_value;
			}
			else if (value > 127 && value < 256)
			{
			elem.value = 10;
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre 0 et 127.');
			elem.value = fall_back_value;
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error: this value must be a number!');
			elem.value = fall_back_value;
			}
			else if (value > 127 && value < 256)
			{
			elem.value = 10;
			}
			else
			{
			alert('Error: this value must be a number between 0 and 127.');
			elem.value = fall_back_value;
			}
		}
	}
}

function checkValueJetpackPower(elem, language = 'en', fall_back_value = 30)
{
	var value = parseInt(elem.value);
	if (isNaN(value) || value < 0 || value > 250)
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre 0 et 250.');
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error: this value must be a number!');
			}
			else
			{
			alert('Error: this value must be a number between 0 and 250.');
			}
		}

	elem.value = fall_back_value;
	}
}

function checkValueWeaponDelay(elem, language = 'en', fall_back_value = 0)
{
	var value = parseInt(elem.value);
	if (isNaN(value) || value < 0 || value > 128)
	{
		if (language == 'fr')
		{
			if (isNaN(value))
			{
			alert('Erreur : cette valeur doit être un nombre!');
			elem.value = fall_back_value;
			}
			else if (value > 128 && value < 256)
			{
			elem.value = 128;
			}
			else
			{
			alert('Erreur : cette valeur doit être comprise entre 0 et 128.');
			elem.value = fall_back_value;
			}
		}
		else
		{
			if (isNaN(value))
			{
			alert('Error: this value must be a number!');
			elem.value = fall_back_value;
			}
			else if (value > 128 && value < 256)
			{
			elem.value = 128;
			}
			else
			{
			alert('Error: this value must be a number between 0 and 128.');
			elem.value = fall_back_value;
			}
		}
	}
}