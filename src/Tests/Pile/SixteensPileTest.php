<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 10:52 PM
 */

namespace Solitaire\Tests\Pile;

use Solitaire\Card\Card;
use Solitaire\Pile\SixteensTableauPile;
use Solitaire\Pile\SpecialSixteensTableauPile;

class SixteensTableauPileTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider canAddCardDataProvider
	 */
	public function testCanAddCard(array $cards, Card $card, $expected)
	{
		$pile = new SixteensTableauPile($cards);
		$this->assertEquals($expected, $pile->canAddCard($card), 'Can add card.');
	}

	public function canAddCardDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 11), new Card(Card::SUIT_SPADES, 5)], new Card(Card::SUIT_DIAMONDS, 4), true],
		];
	}

	/**
	 * @dataProvider addFromSpecialPileDataProvider
	 */
	public function testAddFromSpecialPile(array $cards1, array $cards2, $expected)
	{
		$pile = new SixteensTableauPile($cards1);
		$specialPile = new SpecialSixteensTableauPile($cards2);
		$topCard = $specialPile->getTop();
		$this->assertEquals($expected, $pile->addFromPile($specialPile), 'Add from special pile.');
		$this->assertEquals($topCard, $pile->getTop(), 'Card added.');
	}

	public function addFromSpecialPileDataProvider()
	{
		return [
			[[new Card(Card::SUIT_HEARTS, 11), new Card(Card::SUIT_SPADES, 5)], [new Card(Card::SUIT_DIAMONDS, 4)], true],
		];
	}
} 