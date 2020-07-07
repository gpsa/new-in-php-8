<?php

try {
    echo $undefinedVar;
} catch (Error) {
    echo '$undefinedVar is undefined' . PHP_EOL;
}

var_dump([][1]);