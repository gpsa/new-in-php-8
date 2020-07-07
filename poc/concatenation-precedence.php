<?php
$a = 1;
$b = 10;
echo "sum: " . $a + $b;
echo PHP_EOL;

# PHP 7
// Deprecated: The behavior of unparenthesized expressions containing both '.' and '+'/'-' will change in PHP 8: '+'/'-' will take a higher precedence in /code/src/concatenation-precedence.php on line 4
//Warning: A non-numeric value encountered in /code/src/concatenation-precedence.php on line 4

# PHP 8
// sum: 11