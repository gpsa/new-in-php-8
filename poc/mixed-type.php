<?php

class Foo
{
    public function bar(mixed $item): mixed
    {
        return $item;
    }

    // Fatal error: Mixed types cannot be nullable, null is already part of the mixed type.
//    public function wrong(): ?mixed {}

}

foreach ([1, 'string', new stdClass(), [2, 3, 4], false, null] as $type) {
    $a = (new Foo())->bar($type);

    var_dump($a);
}