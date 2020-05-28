<?php

namespace JoshuaChinemezu\SmsGlobal\RestApi;

use Illuminate\Support\Facades\Config;
use JoshuaChinemezu\SmsGlobal\RestApi\Request\RestApiRequest;
/*
 * This file is part of the SmsGlobal Laravel package.
 *
 * (c) Joshua Chinemezu <joshuachinemezu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RestApiClient
{
    protected $apiKey;
    protected $secretKey;
    protected $debug;
    protected $hashAlgo;
    protected $request;
    /**
     * Issue Secret Key from your Paystack Dashboard
     * @var string
     */


    public function __construct()
    {
        $this->setApiKey();
        $this->setSecretKey();
        $this->setDebugMode();
        $this->setHashAlgo();
        $this->setRequest();
    }

    /**
     * Get api key from SmsGlobal config file
     */
    public function setApiKey()
    {
        $this->apiKey = Config::get('smsglobal.apiKey');
    }

    /**
     * Get secret key from SmsGlobal config file
     */
    public function setSecretKey()
    {
        $this->secretKey = Config::get('smsglobal.secretKey');
    }

    /**
     * Get debug mode from SmsGlobal config file
     */
    public function setDebugMode()
    {
        $this->debug = Config::get('smsglobal.debug');
    }

    /**
     * Get debug mode from SmsGlobal config file
     */
    public function setHashAlgo()
    {
        $this->hashAlgo = Config::get('smsglobal.hashAlgo');
    }

    /**
     * Get debug mode from SmsGlobal config file
     */
    public function setRequest()
    {
        $this->request = new RestApiRequest($this->apiKey, $this->secretKey, $this->hashAlgo);
    }

    public function getAllContactGroups()
    {
        return $this->request->get('group');
    }
}
