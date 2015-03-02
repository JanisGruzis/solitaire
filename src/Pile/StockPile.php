<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 11:23 PM
 */

namespace Solitaire\Pile;


class StockPile extends Pile
{
	public function __construct(array $cards = [])
	{
		parent::__construct(52, false, $cards);
	}

	/**
	 * Print pile.
	 * @return string
	 */
	public function printPile()
	{
		echo $this->getName() . ': ' .
			count($this) . ' card(s): Faced down';
	}

	/**
	 * Cant add any card.
	 * @param Card $card Card.
	 * @return bool
	 */
	public function canAddCard(Card $card)
	{
		return false;
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Stock';
	}
} 