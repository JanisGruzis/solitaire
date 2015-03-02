<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:16 PM
 */

namespace Solitaire\Card;

/**
 * One of the 52 units used to play card games.
 */
class Card
{
	const SUIT_HEARTS = 'H';
	const SUIT_CLUBS = 'C';
	const SUIT_SPADES = 'S';
	const SUIT_DIAMONDS = 'D';

	public static $suits = [
		self::SUIT_CLUBS,
		self::SUIT_DIAMONDS,
		self::SUIT_HEARTS,
		self::SUIT_SPADES,
	];

	const FACING_UP = 1;
	const FACING_DOWN = 2;

	private static $facings = [
		self::FACING_UP,
		self::FACING_DOWN,
	];

	/* @var string Card suit. */
	protected $suit;

	/* @var integer Card rank. */
	protected $rank;

	protected $facing;

	/**
	 * @param string $suit Suite.
	 * @param integer $rank Rank.
	 * @param integer $facing The way card is facing.
	 * @throws \InvalidArgumentException Invalid rank or suite.
	 */
	public function __construct($suit, $rank, $facing = self::FACING_UP)
	{
		if (!in_array($suit, self::$suits))
		{
			throw new \InvalidArgumentException('Invalid suite.');
		}

		$rank = intval($rank);
		if ( $rank < 1 || $rank > 13)
		{
			throw new \InvalidArgumentException('Invalid rank.');
		}

		$facing = intval($facing);
		if (!in_array($facing, self::$facings))
		{
			throw new \InvalidArgumentException('Invalid facing.');
		}

		$this->suit = $suit;
		$this->rank = $rank;
		$this->facing = $facing;
	}

	public function __toString()
	{
		if ($this->facing == self::FACING_DOWN)
			return 'down';

		switch ($this->rank)
		{
			case 11:
				$res = 'J';
				break;
			case 12:
				$res = 'Q';
				break;
			case 13:
				$res = 'K';
				break;
			default:
				$res = $this->rank;
		}

		return $res . $this->suit;
	}

	/**
	 * Get suit.
	 * @return string Suit.
	 */
	public function getSuit()
	{
		return $this->suit;
	}

	/**
	 * Get rank.
	 * @return int Rank.
	 */
	public function getRank()
	{
		return $this->rank;
	}

	/**
	 * If card is next of another.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isNextOf(Card $card)
	{
		return $this->isNextRankOf($card)
			&& $this->suit == $card->getSuit();
	}

	/**
	 * If card rank is next of another rank.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isNextRankOf(Card $card)
	{
		$nextRank = $card->getRank() + 1;
		if ($nextRank > 13) $nextRank = 1;

		return $this->rank == $nextRank;
	}

	/**
	 * If card is previous of another.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isPreviousOf(Card $card)
	{
		return $this->isPreviousRankOf($card)
		&& $this->suit == $card->getSuit();
	}

	/**
	 * If card rank is previous of another rank.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isPreviousRankOf(Card $card)
	{
		$prevRank = $card->getRank() - 1;
		if ($prevRank < 1) $prevRank = 13;

		return $this->rank == $prevRank;
	}

	/**
	 * If two cards are equal.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isEqual(Card $card)
	{
		return $this->rank == $card->getRank() &&
			$this->suit == $card->getSuit();
	}

	/**
	 * If two cards are not equal.
	 * @param Card $card Card instance.
	 * @return bool
	 */
	public function isNotEqual(Card $card)
	{
		return !$this->isEqual($card);
	}
}