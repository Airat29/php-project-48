<?php

namespace Php\Project\Differ;

use function Php\Project\Differ\Parser\parse;
use function Php\Project\Differ\Render\render;

function genDiff(string $filePath1,string $filePath2, $format = "stylish")
{
    $firstArray = parse($filePath1);
    $secondArray = parse($filePath2);
    $diff = makeDiff($firstArray, $secondArray);
    return render($diff, $format);
}

function makeDiff(array $beforeDiff,array $afterDiff)
{
    $combinedKeys = array_unique(array_merge(array_keys($beforeDiff), array_keys($afterDiff)));
    $sortedCombinedKeys = sort($combinedKeys);
    return array_map(function ($key) use ($beforeDiff, $afterDiff) {
        
    });
}


function genDiff(string $filePath1,string $filePath2, )
{
    $fileData1 = json_decode(file_get_contents($filePath1), true);
    $fileData2 = json_decode(file_get_contents($filePath2), true);

    $keys = array_unique(array_merge(array_keys($fileData1), array_keys($fileData2)));

    $sortedKeys = sort($keys, fn ($left, $right) => strcmp($left, $right));

    $diff = array_map(function ($key) use ($fileData1, $fileData2) {
        if (array_key_exists($key, $fileData1) && array_key_exists($key, $fileData2)) {
            if ($fileData1[$key] === $fileData2[$key]) {
                return "  $key: " . var_export($fileData1[$key], true);
            } else {
                return "- $key: " . $fileData1[$key] . "\n+ $key: " . $fileData2[$key];
            }
        } elseif (array_key_exists($key, $fileData1)) {
            return "- $key: " . var_export($fileData1[$key], true);
        } elseif (array_key_exists($key, $fileData2)) {
            return "+ $key: " . var_export($fileData2[$key], true);
        }
    }, $sortedKeys);
    echo "{\n" . implode("\n", $diff) . "\n}\n";
    return $diff;
}
