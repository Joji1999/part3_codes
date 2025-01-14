<?php

namespace VendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use VendingMachine\VendingMachine;
use VendingMachine\Drink;
use VendingMachine\Snack;
use VendingMachine\CupDrink;

require_once(__DIR__ . '/../../lib/vending_machine/VendingMachine.php');

class VendingMachineTest extends TestCase
{
    public function testDepositCoin()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(0, $vendingMachine->depositCoin(0));
        $this->assertSame(0, $vendingMachine->depositCoin(150));
        $this->assertSame(100, $vendingMachine->depositCoin(100));
    }

    public function testPressButton()
    {
        $cider = new Drink('cider');
        $cola = new Drink('cola');
        $hotCupCoffee = new CupDrink('hot cup coffee');
        $snack = new Snack();
        $vendingMachine = new VendingMachine();

        // お金が投入されていない場合は購入できない
        $this->assertSame('', $vendingMachine->pressButton($cider));

        // 100円を入れた場合はサイダーを購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('cider', $vendingMachine->pressButton($cider));

        // 投入金額が100円の場合はコーラを購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($cola));
        // 投入金額が200円の場合はコーラを購入できる
        $vendingMachine->depositCoin(100);
        $this->assertSame('cola', $vendingMachine->pressButton($cola));

        // カップが投入されていない場合は購入できない
        $vendingMachine->depositCoin(100);
        $this->assertSame('', $vendingMachine->pressButton($hotCupCoffee));

        // カップを入れた場合は購入できる
        $vendingMachine->addCup(1);
        $this->assertSame('hot cup coffee', $vendingMachine->pressButton($hotCupCoffee));

        // ポテトチップスの購入
        $vendingMachine->depositCoin(100);
        $this->assertSame('potato tips', $vendingMachine->pressButton($snack));
    }

    public function testAddCup()
    {
        $vendingMachine = new VendingMachine();
        $this->assertSame(99, $vendingMachine->addCup(99));
        $this->assertSame(100, $vendingMachine->addCup(1));
        $this->assertSame(100, $vendingMachine->addCup(1));
    }
}
