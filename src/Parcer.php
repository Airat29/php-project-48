<?php

namespace Php\Project\src\Parcer;

function parceFile($file)
{
    $data = json_decode(file_get_contents($file), true);
    return $data;
}
