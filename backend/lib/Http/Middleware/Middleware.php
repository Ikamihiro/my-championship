<?php

namespace Lib\Http\Middleware;

use Lib\Http\Request;

abstract class Middleware
{
    abstract public function execute(Request $request);
}
