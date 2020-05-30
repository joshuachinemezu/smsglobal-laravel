<?php

/*
 * This file is part of the SmsGlobal Laravel package.
 *
 * (c) Joshua Chinemezu <joshuachinemezu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoshuaChinemezu\SmsGlobal\Facades;

use Illuminate\Support\Facades\Facade;

class SmsGlobal extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'smsglobal-laravel';
    }
}
