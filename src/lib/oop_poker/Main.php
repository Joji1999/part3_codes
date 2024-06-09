<?php

namespace OopPoker;

require_once('Game.php');

$game = new Game('田中', '松田', 2, 'A');
$game->start();
