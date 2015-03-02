<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/2/15
 * Time: 12:18 AM
 */

namespace Solitaire\Pile;


use Solitaire\Card\Card;

class SixteensTableauPile extends Pile
{
	const ALLOW_EMPTY = false;

	public function __construct(array $cards)
	{
		parent::__construct(3, true, $cards);
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
		if ((!self::ALLOW_EMPTY && !count($this)) || count($this) >= $this->maxCards)
			return false;

		$topCard = $this->getTop();

		return $card->isPreviousRankOf($topCard)
			&& $card->getSuit() != $topCard->getSuit();
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