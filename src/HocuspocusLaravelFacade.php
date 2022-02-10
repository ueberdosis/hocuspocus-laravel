<?php

namespace Hocuspocus;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hocuspocus\HocuspocusLaravel
 */
class HocuspocusLaravelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hocuspocus-laravel';
    }
}
