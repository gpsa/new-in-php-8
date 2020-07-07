<?php

class Foo
{
    public function __toString(): string
    {
        return 'foo';
    }
}

function bar(string|Stringable $stringable)
{
    echo $stringable . PHP_EOL;
}

bar(new Foo());
bar('abc');
