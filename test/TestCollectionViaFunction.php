<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Elijahcruz\Meta\MetaCollection;

$collection = new MetaCollection();

$collection->getTags('https://twitter.com');

foreach($collection as $tag => $value){
    echo $tag . '    ' . $value . PHP_EOL;
}