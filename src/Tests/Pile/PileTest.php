<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:35 PM
 */

namespace Solitaire\Tests\Pile;


use Solitaire\Card\Card;
use Solitaire\Pile\Pile;

class PileTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test constructor exception on invalid arguments.
	 * @dataProvider constructorInvalidArgumentsDataProvider
	 * @expectedException \InvalidArgumentException
	 */
	public function testConstructorInvalidArguments($maxCards, $circular)
	{
		$pile = new Pile($maxCards, $circular);
	}

	public function constructorInvalidArgumentsDataProvider()
	{
		return [
			[-1, true],
			[99, 1],
		];
	}

	/**
	 * If can add card.
	 * @dataProvider canAddDataProvider
	 */
	public function testCanAdd(array $cards, $card, $expected)
	{
		$pile = new Pile(2);
		$this->addCards($pile, $cards);
		$this->assertEquals($expected, $pile->canAddCard($card), 'Check if can add card.');
	}

	public function canAddDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_HEARTS, 2)], new Card(Card::SUIT_HEARTS, 3), false],
			[[], new Card(Card::SUIT_HEARTS, 1), true],
			[[], new Card(Card::SUIT_HEARTS, 2), true],
		];
	}

	/**
	 * If can remove card.
	 * @dataProvider canRemoveDataProvider
	 */
	public function testCanRemove(array $cards, $expected)
	{
		$pile = new Pile(2);
		$this->addCards($pile, $cards);
		$this->assertEquals($expected, $pile->canRemoveCard(), 'Check if can remove card.');
	}

	public function canRemoveDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_HEARTS, 2)], true],
			[[], false],
		];
	}

	/**
	 * Test get top.
	 * @dataProvider removeDataProvider
	 */
	public function testRemove(array $cards, $removeTimes)
	{
		$pile = new Pile(3);
		$this->addCards($pile, $cards);

		for ($i = 0; $i < $removeTimes; ++$i)
		{
			$pile->removeCard();
		}

		$index = count($cards) - $removeTimes - 1;
		$expected = $index < 0 ? null : $cards[$index];
		$this->assertEquals($expected, $pile->getTop(), 'Check top.');
	}

	public function removeDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_HEARTS, 2)], 1],
			[[], 0],
		];
	}

	/**
	 * @dataProvider printPileDataProvider
	 */
	public function testPrintPile($cards, $expected)
	{
		$this->expectOutputString($expected);
		$pile = new Pile(3, false, $cards);
		$pile->printPile();
	}

	public function printPileDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_DIAMONDS, 2)], 'Pile: 2D 1H '],
			[[], 'Pile: ']
		];
	}

	/**
	 * @dataProvider countDataProvider
	 */
	public function testCount($cards)
	{
		$pile = new Pile(3, false, $cards);
		$this->assertCount(count($cards), $pile);
	}

	public function countDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 1), new Card(Card::SUIT_DIAMONDS, 2)]],
			[[]]
		];
	}

	/**
	 * Add card array to pile.
	 * @param Pile $pile
	 * @param array $cards
	 */
	private function addCards(Pile &$pile, array $cards)
	{
		foreach ($cards as $card)
		{
			$this->assertTrue($pile->canAddCard($card), 'Can add card.');
			$pile->addCard($card);
		}
	}
}