<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 9:55 PM
 */

namespace Solitaire\Pile;


use Solitaire\Card\Card;

class FoundationPile extends Pile
{
	/* @var integer All of fundation piles must start with baseRank */
	private static $baseRank = null;

	public function __construct($circular = false)
	{
		parent::__construct(13, $circular, []);
	}

	/**
	 * Set base rank.
	 */
	public static function setBaseRank($rank)
	{
		self::$baseRank = $rank;
	}

	/**
	 * Cards are not fanned.
	 */
	public function printPile()
	{
		$this->printTopCard();
	}

	/**
	 * Add card from top of pile.
	 * @param Pile $pile
	 * @return bool If added successfuly.
	 */
	public function addFromPile(Pile $pile)
	{
		if ($pile instanceof StockPile)
			return false;

		return parent::addFromPile($pile);
	}

	/**
	 * Add card to top.
	 * @param Card $card Card.
	 * @return bool If added successfuly.
	 */
	public function addCard(Card $card)
	{
		$res = parent::addCard($card);

		if ($res && $this->circular)
		{
			self::setBaseRank($card->getRank());
		}

		return $res;
	}

	/**
	 * Check if can add card.
	 * @param Card $card Card.
	 * @return bool
	 * @throws \Exception Base card not set.
	 */
	public function canAddCard(Card $card)
	{
		$topCard = $this->getTop();

		$baseRank = 1;
		if ($this->circular)
			$baseRank = self::$baseRank;

		if ($topCard === null)
		{
			if ($baseRank === null)
				return true;
			else
				return $card->getRank() === $baseRank;
		} else {
			return $card->isNextOf($topCard);
		}
	}

	/**
	 * Cant remove card.
	 * @return bool
	 */
	public function canRemoveCard()
	{
		return false;
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Fundation';
	}
} 