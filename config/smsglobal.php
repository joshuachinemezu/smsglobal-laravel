<?php

/*
                                 * This file is part of the Laravel SmsGlobal package.
             *
             * (c) Joshua Chinemezu <joshuachinemezu@gmail.com>
         *
         * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Hash algorithm to use with hash_hmac. Use hash_algos() to get a list of
     * supported algos. SMSGlobal uses sha256
     */

    'hashAlgo' => env('SMSGLOBAL_HASH_ALGO', 'sha256'),


    /**
     * API Key: Your SmsGlobal APIKey. Get it from https://mxt.smsglobal.com/integrations
     *
     */
    'apiKey' => env('SMSGLOBAL_API_KEY'),

    /**
     * Secret Key: Your SmsGlobal secretKey. Sign up on https://www.smsglobal.com/mxt-sign-up/ to get one from your integrations page
     *
     */
    'secretKey' => env('SMSGLOBAL_SECRET_KEY'),

    /**
     * Host name
     *
     */
    'host' => env('SMSGLOBAL_HOST', 'api.smsglobal.com'),

    /**
     * Protocol
     *
     */
    'protocol' => env('SMSGLOBAL_PROTOCOL', 'https'),

    /**
     * Port
     *
     */
    'port' => env('SMSGLOBAL_PORT', 443),

    /**
     * API Version
     *
     */
    'apiVersion' => env('SMSGLOBAL_API_VERSION', 'v2'),

    /**
     * Debug mode
     *
     */
    'debug' => env('SMSGLOBAL_DEBUG', false),
];
