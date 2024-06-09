<?php

namespace BlackJack;

require_once('Player.php');

class Player1 extends Player
{
    public function getName(): string
    {
        return 'あなた';
    }
}
