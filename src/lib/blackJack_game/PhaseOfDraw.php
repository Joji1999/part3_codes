<?php

namespace BlackJack;

require_once('Game.php');
require_once('Card.php');
require_once('Deck.php');
require_once('Dealer.php');
require_once('Player1.php');
require_once('Player2.php');
require_once('Player3.php');

class phaseOfDraw
{
    private const FIRST_HANDS = 2;

    public $deck;
    public $dealer;
    public $player1;
    public $player2;
    public $player3;
    public $player1Hands;
    public $player2Hands;
    public $player3Hands;
    public $dealerHands;

    public function display()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        $this->deck = new Deck();
        $this->player1 = new Player1();
        $this->player2 = new Player2();
        $this->player3 = new Player3();
        $this->dealer = new Dealer();

        $this->player1Hands = $this->player1->drawCard($this->deck, self::FIRST_HANDS);
        //$this->player2Hands = $this->player2->drawCard($this->deck, self::FIRST_HANDS);
        //$this->player3Hands = $this->player3->drawCard($this->deck, self::FIRST_HANDS);
        $this->dealerHands = $this->dealer->drawCard($this->deck, self::FIRST_HANDS);

        $players = [$this->player1, $this->player2, $this->player3];
        //$hands = [$this->player1Hands, $this->player2Hands, $this->player3Hands];

            foreach($players as $player) {
                $name = $player->getName();
                $hand = $player->drawCard($this->deck, self::FIRST_HANDS);
                echo $name . 'の引いたカードは' . $hand[0]->getSuit() . 'の' . $hand[0]->getNumber() . 'です。' . PHP_EOL;
                echo $name . 'の引いたカードは' . $hand[1]->getSuit() . 'の' . $hand[1]->getNumber() . 'です。' . PHP_EOL;
            }

        echo 'ディーラーの引いたカードは' . $this->dealerHands[0]->getSuit() . 'の' . $this->dealerHands[0]->getNumber() . 'です。' . PHP_EOL;
        echo 'ディーラーの引いた2枚目のカードは分かりません。' . PHP_EOL;
    }
}
