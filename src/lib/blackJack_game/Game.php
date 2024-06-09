<?php

namespace BlackJack;

require_once('Player1.php');
require_once('Dealer.php');
require_once('Deck.php');
require_once('Card.php');
require_once('HandEvaluator.php');
require_once('PhaseOfDraw.php');

class Game
{
    private const ADD_CARD = 1;
    public const MAX_SCORE = 21;
    private const DEALER_MIN_SCORE = 17;

    public function start(): void
    {
        $phaseOfDraw = new phaseOfDraw;
        $phaseOfDraw->display();

        do {
            $scorePlayer1 = new HandEvaluator($phaseOfDraw->player1Hands);
            $amountScorePlayer1 = $scorePlayer1->getScore();

            echo 'あなたの現在の得点は' . $amountScorePlayer1 . 'です。' . PHP_EOL;

            if (self::MAX_SCORE < $amountScorePlayer1) {
                echo 'スコアが21を超えたのであなたの負けです。' . PHP_EOL;
                echo 'ブラックジャックを終了します。' . PHP_EOL;
                exit;
            }
                echo 'カードを引きますか？（Y/N）' . PHP_EOL;

                $answer = trim(fgets(STDIN));

                if ($answer === 'Y') {
                    $newHand = $phaseOfDraw->player1->addCard($phaseOfDraw->deck, self::ADD_CARD);
                    echo 'あなたの引いたカードは' . $newHand->getSuit() . 'の' . $newHand->getNumber() . 'です。' . PHP_EOL;
                }
        } while ($answer === 'Y');

        echo 'ディーラーの引いた2枚目のカードは' . $phaseOfDraw->dealerHands[1]->getSuit() . 'の' . $phaseOfDraw->dealerHands[1]->getNumber() . 'でした。' . PHP_EOL;

        $scoreDealer = new HandEvaluator($phaseOfDraw->dealerHands);
        $amountScoreDealer = $scoreDealer->getScore();
        echo 'ディーラーの現在の得点は' . $amountScoreDealer . 'です。' . PHP_EOL;

        while ($amountScoreDealer < self::DEALER_MIN_SCORE) {
            $newHand = $phaseOfDraw->dealer->addCard($phaseOfDraw->deck, self::ADD_CARD);
            $dealerHands[] = $newHand;
            echo 'ディーラーの引いたカードは' . $newHand->getSuit() . 'の' . $newHand->getNumber() . 'です。' . PHP_EOL;

            $scoreDealer = new HandEvaluator($dealerHands);
            $amountScoreDealer = $scoreDealer->getScore();
        }

        echo 'あなたの得点は' . $amountScorePlayer1 . 'です。' . PHP_EOL;
        echo 'ディーラーの得点は' . $amountScoreDealer . 'です。' . PHP_EOL;

        $judgeWinner = new HandEvaluator([$amountScorePlayer1, $amountScoreDealer]);
        $winner = $judgeWinner->getWinner();

        echo $winner . PHP_EOL;

        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }
}
