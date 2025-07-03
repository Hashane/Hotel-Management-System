<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array run(callable $callback)
 */
class JitTransaction extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'jit_transaction';
    }
}
