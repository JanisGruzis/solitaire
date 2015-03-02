<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 11:39 PM
 */

namespace Solitaire\Game;

use Solitaire\Pile\SixteensTableauPile;
use Solitaire\Pile\SpecialSixteensTableauPile;

class SixteensGame extends Game
{
	/* @var boolean If foundation piles are circular. */
	protected $foundationPilesCircular = true;

	/**
	 * Deal game cards in piles.
	 */
	public function dealCards()
	{
		parent::dealCards();

		for ($i = 0; $i < 16; ++$i)
		{
			$this->piles[] = new SixteensTableauPile($this->deck->getNextXCards(3));
		}

		for ($i = 0; $i < 2; ++$i)
		{
			$this->piles[] = new SpecialSixteensTableauPile($this->deck->getNextXCards(2));
		}
	}

	/**
	 * Start game.
	 */
	public function start()
	{
		echo 'Welcome to sixteens.'. PHP_EOL;
		echo '-+-+-+-+-+-+-+-+-+-+-' . PHP_EOL;
		parent::start();
	}
}