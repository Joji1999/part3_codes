<?php

namespace VendingMachine\Tests;

require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');

use PHPUnit\Framework\TestCase;
use VendingMachine\CupDrink;

class CupDrinkTest extends TestCase
{
    public function testGetPrice()
    {
        $drink = new CupDrink('ice cup coffee');
        $this->assertSame(100, $drink->getPrice());
    }

    public function testGetName()
    {
        $drink = new CupDrink('ice cup coffee');
        $this->assertSame('ice cup coffee', $drink->getName());
    }

    public function testGetCupNumber()
    {
        $drink = new CupDrink('ice cup coffee');
        $this->assertSame(1, $drink->getCupNumber());
    }
}
