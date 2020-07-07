<?php

class Foo
{
    public function do(): int
    {
        return 1;
    }
}

class Bar
{
    public function do(): float
    {
        return pi();
    }
}

function unions(Foo|Bar $input): int | float
{
    return $input->do();
}

function nullableUnions(Foo|null $foo): void
{
    var_dump([__FUNCTION__, $foo ?? '$foo is null']);
}

function nullableUnionsAlternative(?Bar $bar): void
{
    var_dump([__FUNCTION__, $bar ?? '$bar is null']);
}

# Foo|Bar
foreach ([new Foo(), new Bar()] as $class) {
    var_dump(unions($class));
}

# Foo|null
foreach ([new Foo(), null] as $class) {
    nullableUnions($class);
}

# ?Bar
foreach ([new Bar(), null] as $class) {
    nullableUnionsAlternative($class);
}