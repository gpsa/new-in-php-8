<?php

function test($i)
{
    try {
        if ($i % 2) {
            throw new InvalidArgumentException("Something went wrong");
        } else {
            throw new BadMethodCallException("Something went wrong");
        }
    } catch (InvalidArgumentException) {
        echo "Something went wrong. NO VARIABLE assignment" . PHP_EOL;
    } catch (BadMethodCallException $ex) {
        echo "Something went wrong. WITH VARIABLE assignment" . PHP_EOL;
    }
}

foreach (range(0, 1) as $i) {
    test($i);
}
