<?php

use Elijahcruz\Meta\Meta;

require dirname(__DIR__) . '/vendor/autoload.php';

$tags = Meta::getTags('https://twitter.com');

echo 'Tags:' . PHP_EOL;

var_dump($tags->all());

echo 'Count:' . PHP_EOL;

var_dump($tags->count());