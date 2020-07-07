<?php

class Uri
{
    public function __construct(
        public ?string $scheme,
        public ?string $user,
        public ?string $pass,
        public ?string $host,
        public ?int $port,
        public string $path,
        public ?string $query = null,
        public ?string $fragment = null, // <-- ARGH!
    ) {
    }
}

$uri = new Uri("http", null, null, 'localhost', 80, '/test', null, null,);

print_r($uri);