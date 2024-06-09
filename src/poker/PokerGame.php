<?php

namespace Poker;

require_once('PokerCard.php');
require_once('PokerHandEvaluator.php');
require_once('PokerTwoCardRule.php');
require_once('PokerThreeCardRule.php');
require_once('PokerFiveCardRule.php');

class PokerGame
{
    public function __construct(private array $cards1, private array $cards2)
    {
    }

    public function start(): array
    {
        $hands = [];
        foreach ([$this->cards1, $this->cards2] as $cards) {
            $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
            $rule = $this->getRule($cards);
            $handEvaluator = new PokerHandEvaluator($rule);
            $hands[] = $handEvaluator->getHand($pokerCards);
        }

        $winner = PokerHandEvaluator::getWinner($hands[0], $hands[1]);
        return [$hands[0], $hands[1], $winner];
    }

    private function getRule(array $cards): PokerRule
    {
        $rule = new PokerTwoCardRule();
        if (count($cards) === 3) {
            $rule = new PokerThreeCardRule();
        }

        if (count($cards) === 5) {
            $rule = new PokerFiveCardRule();
        }

        return $rule;
    }
}
