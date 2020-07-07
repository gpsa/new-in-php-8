<?php

class  Bar
{
    public static function test(): static
    {
        return new static();
    }
}

class Foo extends Bar
{
    public static function test(): static
    {
        return parent::test();
    }
}


var_dump(Foo::test());
