<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 11:39 PM
 */

namespace Solitaire\Game;

use Solitaire\Pile\DiscardPile;
use Solitaire\Pile\FortyThievesTableauPile;
use Solitaire\Pile\StockPile;

class FortyThievesGame extends Game
{
	/**
	 * Start game.
	 */
	public function start()
	{
		echo 'Welcome to forty thieves.'. PHP_EOL;
		echo '-+-+-+-+-+-+-+-+-+-+-+-+-' . PHP_EOL;
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
			$this->piles[] = new FortyThievesTableauPile($this->deck->getNextXCards(2));
		}

		$this->piles[] = new StockPile($this->deck->getNextXCards(32));
		$this->piles[] = new DiscardPile();
	}
}