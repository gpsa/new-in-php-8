<?php

class Foo
{
    private WeakMap $cache;

    public function getSomethingWithCaching(object $obj): object
    {
        return $this->cache[$obj]
            ??= $this->computeSomethingExpensive($obj);
    }
}