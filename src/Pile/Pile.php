<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:17 PM
 */

namespace Solitaire\Pile;


use Solitaire\Card\Card;

/**
 * Is also a collection of Cards but the number of Cards in a Pile may vary during the play.
 */
class Pile implements \Countable
{
	/* @var array Cards. */
	protected $cards = [];

	/* @var integer Max cards in pile. */
	protected $maxCards;

	/* @var boolean If pile can be circular. */
	protected $circular;

	public function __construct($maxCards, $circular = false, array $cards = [])
	{
		if ($maxCards < 0)
			throw new \InvalidArgumentException('Invalid maxCards value.');

		if (!is_bool($circular))
			throw new \InvalidArgumentException('Invalid circular value.');

		if (count($cards) > $maxCards)
			throw new \InvalidArgumentException('Cant initialize pile with more cards than maxCards.');

		$this->cards = $cards;
		$this->maxCards = $maxCards;
		$this->circular = $circular;
	}

	/**
	 * Add card from top of pile.
	 * @param Pile $pile
	 * @return bool If added successfuly.
	 */
	public function addFromPile(Pile $pile)
	{
		$topCard = $pile->getTop();
		if ($topCard === null)
			return false;

		if ($this->canAddCard($topCard))
		{
			if ($pile->removeCard())
			{
				$this->cards[] = $topCard;
				return true;
			}
		}

		return false;
	}

	/**
	 * Add card to top.
	 * @param Card $card Card.
	 * @return bool If added successfuly.
	 */
	public function addCard(Card &$card)
	{
		if (!$this->canAddCard($card))
			return false;

		$this->cards[] = $card;
		return true;
	}

	/**
	 * Remove card from top.
	 * @throws \InvalidArgumentException Cant remove card from top.
	 */
	public function removeCard()
	{
		if (!$this->canRemoveCard())
			return false;

		array_pop($this->cards);
		return true;
	}

	/**
	 * If can remove card from top.
	 * @return bool
	 */
	public function canRemoveCard()
	{
		return count($this->cards) > 0;
	}

	/**
	 * If can add card to top.
	 * @param Card $card Card.
	 * @return bool
	 */
	public function canAddCard(Card $card)
	{
		return count($this->cards) < $this->maxCards;
	}

	/**
	 * Get top card.
	 * @return null|Card Top card.
	 */
	public function getTop()
	{
		return end($this->cards) ?: null;
	}

	/**
	 * Print top card of pile.
	 */
	protected function printTopCard()
	{
		$topCard = $this->getTop();

		if ($topCard === null)
			$value = 'empty';
		else
			$value = sprintf('%s (Remaining %s cards bellow)', $topCard, count($this) - 1);

		echo $this->getName() . ': ' . $value;
	}

	/**
	 * Print all cards in pile.
	 */
	public function printPile()
	{
		echo $this->getName() . ': ';

		if (count($this))
			for ($i = count($this) - 1; $i >= 0; --$i)
			{
				echo $this->cards[$i] . ' ';
			}
		else
			echo 'empty';
	}

	/**
	 * Get card count.
	 * @return int
	 */
	public function count()
	{
		return count($this->cards);
	}

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Pile';
	}
} 