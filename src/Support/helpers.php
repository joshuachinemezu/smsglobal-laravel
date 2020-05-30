<?php

if (!function_exists('smsGlobal')) {
    /**
     * Factory or driver instance.
     *
     * @return mixed
     */
    function smsGlobal()
    {
        return app()->make('smsglobal-laravel');
    }
}
