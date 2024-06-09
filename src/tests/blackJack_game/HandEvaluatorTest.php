<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/HandEvaluator.php');
require_once(__DIR__ . '/../../lib/blackJack_game/Card.php');


use PHPUnit\Framework\TestCase;

class HandEvaluatorTest extends TestCase
{
    public function testGetScore()
    {
        $hand1 = new Card('K', 'K');
        $hand2 = new Card('S', 'A');
        $handEvaluator = new HandEvaluator([$hand1, $hand2]);
        $this->assertSame(21, $handEvaluator->getScore());
    }

    public function testScoreOfCardA()
    {
        $hand1 = new Card('K', '6');
        $hand2 = new Card('S', '4');
        $handEvaluator = new HandEvaluator([$hand1, $hand2]);
        $handScore = $handEvaluator->getScore();
        $this->assertSame(11, $handEvaluator->scoreOfCardA($handScore));

        $hand1 = new Card('K', 'K');
        $hand2 = new Card('S', '4');
        $handEvaluator = new HandEvaluator([$hand1, $hand2]);
        $handScore = $handEvaluator->getScore();
        $this->assertSame(1, $handEvaluator->scoreOfCardA($handScore));
    }

    public function testGetWinner()
    {
        $array = [21, 18];
        $judge = new HandEvaluator($array);
        $this->assertSame('あなたの勝ちです！', $judge->getWinner());

        $array = [13, 18];
        $judge = new HandEvaluator($array);
        $this->assertSame('あなたの負けです。', $judge->getWinner());

        $array = [18, 18];
        $judge = new HandEvaluator($array);
        $this->assertSame('引き分けです。', $judge->getWinner());

        $array = [21, 24];
        $judge = new HandEvaluator($array);
        $this->assertSame('あなたの勝ちです！', $judge->getWinner());
    }
}
