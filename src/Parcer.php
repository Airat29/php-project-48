<?php

namespace Php\Project\src\Parcer;

use Symfony\Component\Yaml\Yaml;
function parceFile($file)
{
    $data = json_decode(file_get_contents($file), true);
    return $data;
}
