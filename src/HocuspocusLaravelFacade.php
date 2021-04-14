<?php

namespace Ueberdosis\HocuspocusLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ueberdosis\HocuspocusLaravel\HocuspocusLaravel
 */
class HocuspocusLaravelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hocuspocus-laravel';
    }
}
