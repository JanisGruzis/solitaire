<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:16 PM
 */

namespace Solitaire\Deck;

use Solitaire\Card\Card;

/**
 * A collection of all 52 cards.
 */
class Deck implements \Countable
{
	private $cards = [];
	private $counter = 0;

	/**
	 * Fills desck with cards.
	 */
	public function __construct()
	{
		foreach (Card::$suits as $suit)
		{
			for ($i = 1; $i <= 13; ++$i)
			{
				$this->cards[] = new Card($suit, $i);
			}
		}
	}

	/**
	 * Shuffle randomly cards.
	 */
	public function shuffle()
	{
		shuffle($this->cards);
		$this->counter = 0;
	}

	/**
	 * Get next card in deck.
	 * @return null
	 */
	public function getNextCard()
	{
		if (!isset($this->cards[$this->counter]))
			return null;
		else
			return $this->cards[$this->counter++];
	}

	/**
	 * Card count in deck.
	 * @return int
	 */
	public function count()
	{
		return count($this->cards);
	}

	/**
	 * Get next X cards.
	 * @param $x How much cards.
	 * @return array
	 */
	public function getNextXCards($x)
	{
		$ans = [];
		$x = intval($x);

		for ($i = 0; $i < $x; ++$i)
		{
			$card = $this->getNextCard();
			if ($card === null)
				break;

			$ans[] = $card;
		}

		return $ans;
	}
} 