<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/2/15
 * Time: 1:15 AM
 */

namespace Solitaire\Pile;


class SpecialTowersTableauPile extends Pile
{
	public function __construct(array $cards)
	{
		parent::__construct(1, false, $cards);
	}

	/**
	 * Add card from top of pile.
	 * @param Pile $pile
	 * @return bool If added successfuly.
	 */
	public function addFromPile(Pile $pile)
	{
		if (!$pile instanceof TowersTableauPile)
			return false;

		return parent::addFromPile($pile);
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Towers';
	}
} 