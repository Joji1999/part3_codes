<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/BreadSales.php');

class BreadSalesTest extends TestCase
{
    public function test()
    {
        $output = <<<EOD
        2464
        1
        5 10
        
        EOD;

        $this->expectOutputString($output);

        $getInput = getInput(['file', '1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
        $breadAmount = calculateSalesAmount($getInput);
        $breadMaxSales = maxSalesBread($getInput);
        $breadMinSales = minSalesBread($getInput);
        display([$breadAmount], $breadMaxSales, $breadMinSales);
    }
}
