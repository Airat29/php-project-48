<?php

require_once __DIR__. '/vendor/autoload.php';

use function Php\Project\Differ\genDiff;

genDiff('src/fixture/file1.json', 'src/fixture/file2.json');