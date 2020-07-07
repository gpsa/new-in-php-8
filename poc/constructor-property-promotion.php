<?php
assert_options(ASSERT_EXCEPTION, 1);
assert_options(ASSERT_WARNING, 0);

class MyClass
{
    public $c;
    public function __construct(
        /** @var int */
        public int $a,
        /** @var int */
        private int $b = 0,
        string $c = 'test',
        <<MyAttribute>>
        protected string $d = 'promoted has attributes',
    ) {
        // Access promoted properties from the constructor body
        assert($this->a >= 100, new InvalidArgumentException('$a should be greater than or equal to 100'));

        // Access promoted properties from the constructor body
        if ($b > 0) {
            throw new InvalidArgumentException('$b should be greater than 0');
        }

        $this->c = $c;

        $ref = new ReflectionProperty(__CLASS__, 'd');
        printf('Property $d has attribute %s%s', $ref->getAttributes()[0]->getName(), PHP_EOL);

    }
}

try {
    $x = new MyClass(6, 0);
}catch (InvalidArgumentException $ex){
    echo $ex->getMessage() . PHP_EOL;
}

try {
    $x = new MyClass(100, 1);
}catch (InvalidArgumentException $ex){
    echo $ex->getMessage() . PHP_EOL;
}

$x = new MyClass(100, 0, 'test non promoted attribute');

var_dump($x);