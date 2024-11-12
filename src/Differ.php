<?php

namespace Php\Project\src\Differ;

use function Functional\sort;
use function Php\Project\src\Parcer\parceFile;

function genDiff(string $file1, string $file2)
{
    $fileData1 = parceFile($file1);
    $fileData2 = parceFile($file2);

    $keys = array_unique(array_merge(array_keys($fileData1), array_keys($fileData2))); 

    $sortedKeys = sort($keys, fn ($left, $right) => strcmp($left, $right)); 

    $diff = array_map(function ($key) use ($fileData1, $fileData2) {
        if (array_key_exists($key, $fileData1) && array_key_exists($key, $fileData2)) {
            if ($fileData1[$key] === $fileData2[$key]) {
                return "   $key: " . var_export($fileData1[$key], true);
            } else {
                return " - $key: " . $fileData1[$key] . "\n + $key: " . $fileData2[$key];
            }
        } elseif (array_key_exists($key, $fileData1)) {
            return " - $key: " . var_export($fileData1[$key], true);
        } elseif (array_key_exists($key, $fileData2)) {
            return " + $key: " . var_export($fileData2[$key], true);
        }
    }, $sortedKeys);
    return "{\n" . implode("\n", $diff) . "\n}\n";
};
