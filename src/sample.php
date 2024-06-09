<?php

fscanf(STDIN, "%s", $input);
$b = intval(substr($input, 1, 1));
$a = intval(substr($input, 0, 1));
$c = intval(substr($input, 2, 1));

$count = 0;

if ($a == 1) {
    $count++;
}
if ($b == 1) {
    $count++;
}
if ($c == 1) {
    $count++;
}

echo $count;
