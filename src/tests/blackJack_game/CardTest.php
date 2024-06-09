<?php

namespace BlackJack;

require_once(__DIR__ . '/../../lib/blackJack_game/Card.php');

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testGetSuit()
    {
        $card = new Card('D', 'A');
        $this->assertSame('ダイヤ', $card->getSuit());
    }

    public function testGetNumber()
    {
        $card = new Card('C', '10');
        $this->assertSame('10', $card->getNumber());
    }

    public function testCreateId()
    {
        $card = new Card('C', '10');
        $this->assertSame('C-10', $card->createId());
    }

    public function testGetId()
    {
        $card = new Card('C', '10');
        $this->assertSame('C-10', $card->getId());
    }
}
