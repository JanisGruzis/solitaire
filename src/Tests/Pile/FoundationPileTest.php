<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 10:52 PM
 */

namespace Solitaire\Tests\Pile;

use Solitaire\Card\Card;
use Solitaire\Pile\FoundationPile;
use Solitaire\Pile\Pile;

class FoundationPileTest extends \PHPUnit_Framework_TestCase
{
	public function testCanRemove()
	{
		$pile = new FoundationPile();
		$this->assertFalse($pile->canRemoveCard());
	}

	/**
	 * @dataProvider canAddCardDataProvider
	 */
	public function testCanAddCard(array $cards, $circular, $baseRank, Card $card, $expected)
	{
		FoundationPile::setBaseRank($baseRank);
		$pile = new FoundationPile($circular);
		$this->addCards($pile, $cards);
		$this->assertEquals($expected, $pile->canAddCard($card), 'Can add card.');
	}

	public function canAddCardDataProvider()
	{
		return [
			[[], false, 1, new Card(Card::SUIT_HEARTS, 1), true],
			[[], false, 2, new Card(Card::SUIT_HEARTS, 1), true],
			[[], true, 2, new Card(Card::SUIT_HEARTS, 1), false],
			[[], true, 2, new Card(Card::SUIT_HEARTS, 2), true],
			[[new Card(Card::SUIT_HEARTS, 1)], false, 1, new Card(Card::SUIT_HEARTS, 2), true],
			[[new Card(Card::SUIT_DIAMONDS, 1)], false, 1, new Card(Card::SUIT_HEARTS, 2), false],
			[[new Card(Card::SUIT_HEARTS, 2)], true, 2, new Card(Card::SUIT_HEARTS, 5), false],
			[[new Card(Card::SUIT_HEARTS, 2)], true, 2, new Card(Card::SUIT_HEARTS, 3), true],
			[[], true, null, new Card(Card::SUIT_HEARTS, 1), true],
		];
	}

	/**
	 * Add card array to pile.
	 * @param FoundationPile $pile
	 * @param array $cards
	 */
	private function addCards(FoundationPile &$pile, array $cards)
	{
		foreach ($cards as $card)
		{
			$this->assertTrue($pile->canAddCard($card), 'Can add card.');
			$pile->addCard($card);
		}
	}
} 