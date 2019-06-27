<?php

namespace Jeylabs\DropBox\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class DropBox
 * @package Jeylabs\DropBox\Facades
 */
class DropBox extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'DropBox';
    }
}