<?php

namespace Differ\Render\Json;

use function Functional\retry;

function json($ast)
{
    return json_encode($ast, JSON_PRETTY_PRINT);
}
