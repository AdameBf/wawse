var weaponcp = document.getElementById('weapon_crate_probability'),
	weaponcp2 = document.getElementById('weapon_crate_probability_percentage'),
	healthcp = document.getElementById('health_crate_probability'),
	healthcp2 = document.getElementById('health_crate_probability_percentage'),
	utilitycp = document.getElementById('utility_crate_probability'),
	utilitycp2 = document.getElementById('utility_crate_probability_percentage'),
	turnsWithoutCrates = document.getElementById('turns_without_crates');


  // Weapon Crate Probability

  weaponcp.addEventListener('change', function()
  {
  if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 3);
  healthcp2.value = Math.round(healthcp.value / 3);
  utilitycp2.value = Math.round(utilitycp.value / 3);
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 3) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value === '0')
  {
  utilitycp2.value = Math.round(utilitycp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  weaponcp2.value = 0;
  
  var total = parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	healthcp2.value = Math.round(healthcp.value / 2) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value === '0' && parseInt(healthcp.value) < 100)
  {
  weaponcp2.value = 0;
  healthcp2.value = Math.round(healthcp.value);
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value === '0' && parseInt(healthcp.value) >= 100)
  {
  weaponcp2.value = 0;
  healthcp2.value = 100;
  }
  else if (healthcp.value === '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  utilitycp2.value = Math.round(utilitycp.value / 2);
  
  var total = parseInt(weaponcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (healthcp.value === '0' && parseInt(utilitycp.value) >= 100 && weaponcp.value === '0')
  {
  weaponcp2.value = 0;
  utilitycp2.value = 100;
  }
  else if (healthcp.value === '0' && parseInt(utilitycp.value) > 100 && weaponcp.value === '0' && utilitycp.value != '0')
  {
  weaponcp2.value = 0;
  utilitycp2.value = Math.round(utilitycp.value);
  }
  else if (healthcp.value === '0' && utilitycp.value === '0' && parseInt(weaponcp.value) >= 100)
  {
  weaponcp2.value = 100;
  }
  else
  {
  weaponcp2.value = Math.round(weaponcp.value);
  }
  
  turnsWithoutCrates.value = 100 - (parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value));
  
  }, true);


  // Health Crate Probability

  healthcp.addEventListener('change', function()
  {

  if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 3);
  healthcp2.value = Math.round(healthcp.value / 3);
  utilitycp2.value = Math.round(utilitycp.value / 3);
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 3) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value === '0')
  {
  utilitycp2.value = Math.round(utilitycp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  
  var total = parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	healthcp2.value = Math.round(healthcp.value / 2) - difference;
	}
  }
  else if (weaponcp.value != '0' && utilitycp.value === '0' && healthcp.value === '0' && parseInt(weaponcp.value) < 100)
  {
  weaponcp2.value = Math.round(weaponcp.value);
  healthcp2.value = 0;
  }
  else if (weaponcp.value != '0' && utilitycp.value === '0' && healthcp.value === '0' && parseInt(weaponcp.value) >= 100)
  {
  weaponcp2.value = 100;
  healthcp2.value = 0;
  }
  else if (healthcp.value === '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  utilitycp2.value = Math.round(utilitycp.value / 2);
  healthcp2.value = 0;
  
  var total = parseInt(weaponcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (healthcp.value === '0' && parseInt(utilitycp.value) >= 100 && weaponcp.value === '0')
  {
  healthcp2.value = 0;
  utilitycp2.value = 100;
  }
  else if (healthcp.value === '0' && parseInt(utilitycp.value) > 100 && weaponcp.value === '0' && utilitycp.value != '0')
  {
  healthcp2.value = 0;
  utilitycp2.value = Math.round(utilitycp.value);
  }
  else if (weaponcp.value === '0' && utilitycp.value === '0' && parseInt(healthcp.value) >= 100)
  {
  healthcp2.value = 100;
  }
  else
  {
  healthcp2.value = Math.round(healthcp.value);
  }
  
  turnsWithoutCrates.value = 100 - (parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value));

  }, true);


  // Utility Crate Probability

  utilitycp.addEventListener('change', function()
  {

  if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 3);
  healthcp2.value = Math.round(healthcp.value / 3);
  utilitycp2.value = Math.round(utilitycp.value / 3);
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 3) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value != '0' && weaponcp.value === '0')
  {
  utilitycp2.value = Math.round(utilitycp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  
  var total = parseInt(healthcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  healthcp2.value = Math.round(healthcp.value / 2);
  utilitycp2.value = 0;
  
  var total = parseInt(weaponcp2.value) + parseInt(healthcp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	healthcp2.value = Math.round(healthcp.value / 2) - difference;
	}
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value === '0' && parseInt(healthcp.value) < 100)
  {
  healthcp2.value = Math.round(healthcp.value);
  utilitycp2.value = 0;
  }
  else if (healthcp.value != '0' && utilitycp.value === '0' && weaponcp.value === '0' && parseInt(healthcp.value) >= 100)
  {
  healthcp2.value = 100;
  utilitycp2.value = 0;
  }
  else if (healthcp.value === '0' && utilitycp.value != '0' && weaponcp.value != '0')
  {
  weaponcp2.value = Math.round(weaponcp.value / 2);
  utilitycp2.value = Math.round(utilitycp.value / 2);
  
  var total = parseInt(weaponcp2.value) + parseInt(utilitycp2.value);
  
  	if (total > 100)
	{
	var difference = total - 100;
	utilitycp2.value = Math.round(utilitycp.value / 2) - difference;
	}
  }
  else if (utilitycp.value === '0' && parseInt(weaponcp.value) >= 100 && healthcp.value === '0')
  {
  weaponcp2.value = 100;
  utilitycp2.value = 0;
  }
  else if (utilitycp.value === '0' && parseInt(weaponcp.value) > 100 && healthcp.value === '0' && utilitycp.value != '0')
  {
  weaponcp2.value = Math.round(healthcp.value);
  utilitycp2.value = 0;
  }
  else if (weaponcp.value === '0' && healthcp.value === '0' && parseInt(utilitycp.value) >= 100)
  {
  utilitycp2.value = 100;
  }
  else
  {
  utilitycp2.value = Math.round(utilitycp.value);
  }
  
  turnsWithoutCrates.value = 100 - (parseInt(weaponcp2.value) + parseInt(healthcp2.value) + parseInt(utilitycp2.value));

  }, true);