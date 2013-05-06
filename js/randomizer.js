// Taken from the Mozilla Developer Center
function getRandomInt (min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


// Weapon Ammo Randomization.
// A- Handgun, Prod (slightly more than 1/2 chance to have Inf of them).
function randomAmmoA(elem)
{
	var randomizingSupport = new Array(0, 0, 10, 10, 10, 10, 10 getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 5)];
}

// B- Bazooka, Grenade, Shotgun, Uzi, Fire Punch, Dragon Ball (slightly more than 1/3 chance to have Inf of them).
function randomAmmoB(elem)
{
	var randomizingSupport = new Array(0, 10, 10, getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 4)];
}

// C- Ninja Rope, Parachute (slightly more than 1/6 chance to have Inf of them).
function randomAmmoC(elem)
{
	var randomizingSupport = new Array(0, 10, getRandomInt(0, 10), getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 5)];
}

// D- Bungee (slightly more than 1/8 chance to have Inf of it).
function randomAmmoD(elem)
{
	var randomizingSupport = new Array(0, 10, getRandomInt(0, 5), getRandomInt(0, 10), getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 6)];
}

// E- Petrol Bomb, Mortar (values from 0-5 are very probable; there's a little more than a 1/16 chance to have Inf of them).
function randomAmmoE(elem)
{
	var randomizingSupport = new Array(0, 0, 1, 1, 2, 2, 3, 3, 4, 5, 5, 10, getRandomInt(0, 10), getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 15)];
}

// F- Longbow, Mine, Blow Torch, Pneumatic Drill (values from 0-3 are very probable; there's a little more than a 1/20 chance to have Inf of them).
function randomAmmoF(elem)
{
	var randomizingSupport = new Array(0, 0, 0, 1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 5, 5, 10, getRandomInt(0, 10), getRandomInt(0, 20), getRandomInt(0, 25) * 5, getRandomInt(0, 128));
	elem.value = randomizingSupport[getRandomInt(0, 19)];
}