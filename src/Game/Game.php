<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/1/15
 * Time: 5:16 PM
 */

namespace Solitaire\Game;
use Solitaire\Deck\Deck;
use Solitaire\Pile\FoundationPile;
use Solitaire\Pile\Pile;

/**
 * Implements a card game which can be played with one standard deck of cards.
 */
class Game
{
	/* @var Deck Card deck. */
	protected $deck;

	/* @var array Piles. */
	protected $piles = [];

	/* @var boolean If foundation piles are circular. */
	protected $foundationPilesCircular = false;

	/**
	 * Distributing cards on various piles.
	 * @return mixed
	 */
	public function dealCards()
	{
		FoundationPile::setBaseRank(null);
		$this->deck = new Deck();
		$this->deck->shuffle();
		$this->piles = [];

		for ($i = 0; $i < 4; ++$i)
		{
			$this->piles[] = new FoundationPile($this->foundationPilesCircular);
		}
	}

	/**
	 * Redraw game board.
	 */
	public function redrawBoard()
	{
		$i = 1;
		$format = '%-5s';

		foreach ($this->piles as $pile)
		{
			printf($format, '[' . ($i++) . ']');
			$pile->printPile();
			echo PHP_EOL;
		}
	}

	/**
	 * Check if game has been won.
	 */
	public function hasWon()
	{
		$cardCount = 0;

		for ($i = 0; $i < 4; ++$i)
		{
			$pile = $this->piles[$i];
			$cardCount += count($pile);
		}

		return $cardCount == count($this->deck);
	}

	/**
	 * Add card from one pile to other.
	 * @param $src Source pile.
	 * @param $dst Destinaton pile.
	 * @return bool If was successful.
	 */
	public function moveCard($src, $dst)
	{
		$src = intval($src) - 1;
		$dst = intval($dst) - 1;

		if (!isset($this->piles[$src]))
			return false;

		if (!isset($this->piles[$dst]))
			return false;

		/* @var Pile $srcPile */
		$srcPile = $this->piles[$src];
		/* @var Pile $dstPile */
		$dstPile = $this->piles[$dst];

		return $dstPile->addFromPile($srcPile);
	}

	/**
	 * Start game. Read input and do stuff.
	 */
	public function start()
	{
		$this->dealCards();
		$this->redrawBoard();

		while (!$this->hasWon())
		{
			echo "Enter move as src# dst# (or quit to end game): ";
			$line = trim(fgets(STDIN));

			if ($line == 'quit')
				break;

			if (preg_match('/^(\d+)\s+(\d+).*$/', $line, $match))
			{
				if (!$this->moveCard($match[1], $match[2]))
					echo 'Illegal Move' . PHP_EOL;
				else
					$this->redrawBoard();
			} else {
				echo 'Badly Formatted Request' . PHP_EOL;
			}
		}

		if ($this->hasWon())
		{
			echo 'Congratulations! You Have Won.' . PHP_EOL;
		}
	}
} 