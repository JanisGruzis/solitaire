<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 11:39 PM
 */

namespace Solitaire\Game;

use Solitaire\Pile\SpecialTowersTableauPile;
use Solitaire\Pile\TowersTableauPile;

class TowersGame extends Game
{
	/**
	 * Start game.
	 */
	public function start()
	{
		echo 'Welcome to towers.'. PHP_EOL;
		echo '-+-+-+-+-+-+-+-+-+-+-' . PHP_EOL;
		parent::start();
	}

	/**
	 * Distributing cards on various piles.
	 * @return mixed
	 */
	public function dealCards()
	{
		parent::dealCards();

		for ($i = 0; $i < 10; ++$i)
		{
			$this->piles[] = new TowersTableauPile($this->deck->getNextXCards(5));
		}

		for ($i = 0; $i < 4; ++$i)
		{
			$this->piles[] = new SpecialTowersTableauPile($i % 2 ? $this->deck->getNextXCards(1) : []);
		}
	}
}