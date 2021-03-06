<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/2/15
 * Time: 12:18 AM
 */

namespace Solitaire\Pile;


use Solitaire\Card\Card;

class TowersTableauPile extends Pile
{
	public function __construct(array $cards)
	{
		parent::__construct(17, false, $cards);
	}

	/**
	 * Add card from top of pile.
	 * @param Pile $pile
	 * @return bool If added successfuly.
	 */
	public function addFromPile(Pile $pile)
	{
		if ($pile instanceof FoundationPile)
			return false;

		return parent::addFromPile($pile);
	}

	/**
	 * If can add card to top.
	 * @param Card $card Card.
	 * @return bool
	 */
	public function canAddCard(Card $card)
	{
		$topCard = $this->getTop();

		if ($topCard instanceof Card)
			return $card->isPreviousOf($topCard);
		else
			return $card->getRank() == 13;
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Tableau';
	}
} 