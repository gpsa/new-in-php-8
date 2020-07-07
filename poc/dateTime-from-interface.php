<?php

$date = DateTime::createFromInterface(new DateTimeImmutable());

$dateImmutable = DateTimeImmutable::createFromInterface(new Datetime());

print_r([
    'date' => $date,
    'dateImmutable' => $dateImmutable,
]);