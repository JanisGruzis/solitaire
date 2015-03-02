<?php

require_once 'vendor/autoload.php';

echo 'Welcome to Solitaire!' . PHP_EOL;
echo 'Today`s menu of solitaire games includes:' . PHP_EOL;
echo "\t1. The Towers (t)" . PHP_EOL;
echo "\t2. Forty Thieves (f)" . PHP_EOL;
echo "\t3. Sixteens (s)" . PHP_EOL;
echo 'All to change you. Enjoy!' . PHP_EOL;

while (true)
{
	echo 'Which version of solitaire would you like to play? ';
	$command = strtolower(trim(fgets(STDIN)));

	$game = null;
	switch ($command)
	{
		case 't':
			$game = new \Solitaire\Game\TowersGame();
			break;
		case 'f':
			$game = new \Solitaire\Game\FortyThievesGame();
			break;
		case 's':
			$game = new \Solitaire\Game\SixteensGame();
			break;
		default:
			echo 'Valid choices are t(tower), f(forty thieves) or s(sixteens)' . PHP_EOL;
			break;
	}

	if ($game instanceof \Solitaire\Game\Game)
	{
		$game->start();

		echo 'Play Again. (Y/N)? ';
		$command = strtolower(trim(fgets(STDIN)));
		if ($command != 'y')
			break;
	}
}