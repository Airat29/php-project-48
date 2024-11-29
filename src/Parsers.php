<?php

namespace Php\Project\src\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile($file)
{
    if (substr($file, -4) === 'json') {
        $data = json_decode(file_get_contents($file), true);
        return $data;
    } elseif (substr($file, -4) === '.yml' || substr($file, -4) === 'yaml') {
        $data = Yaml::parseFile($file, Yaml::PARSE_OBJECT_FOR_MAP);
        return $data;
    }
}
