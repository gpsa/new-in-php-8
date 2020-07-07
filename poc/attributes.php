<?php
use PhpAttribute as Attribute;

class Http
{
    public const POST = 'POST';
    public const GET = 'GET';
    public const DELETE = 'DELETE';
    public const PUT = 'PUT';
}

<<Attribute>>
class BaseUri {
    public function __construct(public string $uri)
    {
    }
}

<<Attribute(Attribute::TARGET_CLASS)>>
class Route
{
    public function __construct(private string $method, private string $uri){}

    public function getMethod()
    {
        return $this->method;
    }

        public function getUri()
    {
        return $this->uri;
    }
}

<<Attribute(Attribute::TARGET_CLASS)>>
class MultipleAttributes {
    public function __construct(...$params)
    {
        print_r($params);
    }
}

<<Route(Http::POST, '/products/create') >>
<<Route(Http::GET, '/products/create') >>
class ProductsCreateController
{
    <<BaseUri('/products')>>
    private $baseUri;

    <<NotClassAttribute>>
    <<MultipleAttributes(1, 2, [3,4], 5)>>
    public function __invoke()
    {
        $classAttributes = (new ReflectionClass(__CLASS__));
        $methodAttributes = (new ReflectionMethod(__METHOD__));

        $fn = fn($attr) => ['name' => $attr->getName(),
            'class_exists' => class_exists($attr->getName()),
            'arguments' => $attr->getArguments()
        ];

        print_r([
            'class_attributes' => array_map($fn, $classAttributes->getAttributes()),
            'method_attributes' => array_map($fn, $methodAttributes->getAttributes()),
        ]);

        return $this;
    }

    <<AttributeWithScalarExpression(1+1)>>
    <<AttributeWithClassNameAndConstants(PDO::class, PHP_VERSION, PHP_VERSION_ID)>>
    <<AttributeWithClassConstant(Http::POST)>>
    <<AttributeWithBitShift(4 >> 1, 4 << 1)>>
    public function test()
    {
        $methodAttributes = (new ReflectionMethod(__METHOD__));

        return array_map(fn($attr) => [
            'name' => $attr->getName(),
            'arguments' => $attr->getArguments()
        ], $methodAttributes->getAttributes());
    }

    public function getBaseUri(): BaseUri
    {
        $methodAttributes = (new ReflectionProperty(__CLASS__, 'baseUri'));
        return $methodAttributes->getAttributes(BaseUri::class)[0]->newInstance();
    }
}

// Invokation
$controller = (new ProductsCreateController())();
var_dump($controller->test());
var_dump($controller->getBaseUri());