<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 11:30 PM
 */

namespace Solitaire\Pile;


class DiscardPile extends Pile
{
	public function __construct()
	{
		parent::__construct(52);
	}

	/**
	 * Print pile.
	 * @return string
	 */
	public function printPile()
	{
		return $this->printTopCard();
	}

	/**
	 * Add card from top of pile.
	 * @param Pile $pile
	 * @return bool If added successfuly.
	 */
	public function addFromPile(Pile $pile)
	{
		if (!$pile instanceof StockPile)
			return false;

		return parent::addFromPile($pile);
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Discard';
	}
} 