<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:34 PM
 */

namespace Solitaire\Tests\Card;
use Solitaire\Card\Card;

/**
 * Test CardTest
 */
class CardTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test constructor exception on invalid arguments.
	 * @dataProvider constructorInvalidArgumentsDataProvider
	 * @expectedException \InvalidArgumentException
	 */
	public function testConstructorInvalidArguments($suit, $rank, $facing)
	{
		$card = new Card($suit, $rank, $facing);
	}

	public function constructorInvalidArgumentsDataProvider()
	{
		return [
			[Card::SUIT_CLUBS, -1, Card::FACING_DOWN],
			[Card::SUIT_CLUBS, 14, Card::FACING_DOWN],
			['Z', 3, Card::FACING_DOWN],
			['Z', 3, Card::FACING_DOWN],
			['Z', -1, -1],
			[Card::SUIT_HEARTS, 3, -1],
		];
	}

	/**
	 * Test getter functions.
	 */
	public function testGetters()
	{
		$card = new Card(Card::SUIT_DIAMONDS, 3);
		$this->assertEquals(3, $card->getRank(), 'Rank set correctly.');
		$this->assertEquals(Card::SUIT_DIAMONDS, $card->getSuit(), 'Suit set correctly.');
	}

	/**
	 * Test is next.
	 * @dataProvider isNextDataProvider
	 */
	public function testIsNext($suit1, $rank1, $suit2, $rank2, $isNext, $isPrevious)
	{
		$card1 = new Card($suit1, $rank1);
		$card2 = new Card($suit2, $rank2);

		$this->assertEquals($isNext, $card1->isPreviousOf($card2), '$card2 is next of $card1');
		$this->assertEquals($isPrevious, $card1->isNextOf($card2), '$card2 is previous of $card1');
	}

	public function isNextDataProvider()
	{
		return [
			[Card::SUIT_HEARTS, 1, Card::SUIT_HEARTS, 2, true, false],
			[Card::SUIT_HEARTS, 1, Card::SUIT_DIAMONDS, 2, false, false],
			[Card::SUIT_HEARTS, 13, Card::SUIT_HEARTS, 12, false, true],
			[Card::SUIT_HEARTS, 13, Card::SUIT_HEARTS, 13, false, false],
			[Card::SUIT_HEARTS, 13, Card::SUIT_HEARTS, 1, true, false],
			[Card::SUIT_HEARTS, 13, Card::SUIT_DIAMONDS, 1, false, false],
			[Card::SUIT_HEARTS, 1, Card::SUIT_HEARTS, 13, false, true],
		];
	}

	/**
	 * @dataProvider toStringDataProvider
	 */
	public function testToString($suit, $rank, $expected)
	{
		$card = new Card($suit, $rank);
		$this->assertEquals($expected, (string)$card);
	}

	public function toStringDataProvider()
	{
		return [
			[Card::SUIT_HEARTS, 1, "1H"],
			[Card::SUIT_HEARTS, 10, "10H"],
			[Card::SUIT_HEARTS, 11, "JH"],
			[Card::SUIT_HEARTS, 12, "QH"],
			[Card::SUIT_HEARTS, 13, "KH"],
			[Card::SUIT_DIAMONDS, 10, "10D"],
			[Card::SUIT_CLUBS, 10, "10C"],
			[Card::SUIT_SPADES, 10, "10S"],
		];
	}

	/**
	 * @dataProvider isNotEqualDataProvider
	 */
	public function testIsNotEqual(Card $card1, Card $card2, $expected)
	{
		$this->assertEquals($expected, $card1->isNotEqual($card2), 'Two cards are not equal.');
	}

	public function isNotEqualDataProvider()
	{
		return [
			[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_HEARTS, 1), false],
			[new Card(Card::SUIT_DIAMONDS, 13), new Card(Card::SUIT_DIAMONDS, 13), false],
			[new Card(Card::SUIT_DIAMONDS, 1), new Card(Card::SUIT_HEARTS, 1), true],
			[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_HEARTS, 2), true],
		];
	}
} 