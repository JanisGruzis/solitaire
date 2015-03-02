<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:34 PM
 */

namespace Solitaire\Tests\Deck;

use Solitaire\Deck\Deck;

class DeckTest extends \PHPUnit_Framework_TestCase
{
	public function testCount()
	{
		$deck = new Deck();
		$this->assertCount(52, $deck);
	}
} 