<?php

class MyClass {

}

$x = new MyClass();

print_r([
    get_debug_type($x),
    (is_object($x) ? get_class($x) : gettype($x)),
    get_debug_type(1),
    gettype(1),
    get_debug_type(1.1),
    gettype(1.1),
]);