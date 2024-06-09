<?php

namespace Poker\Tests;

require_once(__DIR__ . '/../../lib/poker/PokerHandEvaluator.php');

use PHPUnit\Framework\TestCase;
use Poker\PokerHandEvaluator;
use Poker\PokerThreeCardRule;
use Poker\PokerTwoCardRule;
use Poker\PokerCard;

class PokerHandEvaluatorTest extends TestCase
{
    public function testGetHand()
    {
        $handEvaluator = new PokerHandEvaluator(new PokerTwoCardRule());
        $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('SK')]));

        $handEvaluator = new PokerHandEvaluator(new PokerThreeCardRule());
        $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('S2'), new PokerCard('C3')]));
    }

    public function testGetWinner()
    {
        $handEvaluator = new PokerHandEvaluator(new PokerTwoCardRule);
        $this->assertSame(1, $handEvaluator->getWinner('straight', 'high card'));
        $this->assertSame(3, $handEvaluator->getWinner('high card', 'high card'));

        $handEvaluator = new PokerHandEvaluator(new PokerThreeCardRule);
        $this->assertSame(2, $handEvaluator->getWinner('straight', 'three of a kind'));
        $this->assertSame(3, $handEvaluator->getWinner('three of a kind', 'three of a kind'));
    }
}
