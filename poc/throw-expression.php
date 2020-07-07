<?php

try {
    $myVar1 = 0;
    $myExpression = $myVar1 > 0
        ? $myVar1
        : throw new InvalidArgumentException('offset');

    var_dump($myExpression);
} catch (InvalidArgumentException $ex) {
    print_r($ex);
}