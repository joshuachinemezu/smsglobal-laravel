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

    /**
     * Get the auto top-up information associated to the authenticated account.
     */
    public function getAutoTopUpInfo()
    {
        return $this->request->get('auto-topup');
    }

    /**
     * Delete a contact
     * @param integer $id
     * @return json
     */
    public function deleteContact($id)
    {
        return $this->request->delete("contact/{$id}");
    }

    /**
     * Get the contact as identified by the given id.
     * @param integer $id
     * @return json
     */
    public function getContactByID($id)
    {
        return $this->request->get("contact/{$id}");
    }

    /**
     * Update the contact as identified by the given id. You can only update the
     * default fields associated with each contact.
     * @param integer $id
     * @return json
     */
    public function updateContactByID($id)
    {
        return $this->request->put("contact/{$id}");
    }

    /**
     * Get a list of all contact groups.
     * @param array $queryOptions
     * @return json
     */
    public function getAllContactGroups($queryOptions = [])
    {
        return $this->request->get('group', $queryOptions);
    }

    /**
     * Create a new contact group.
     * @param array $formData
     * @return json
     */
    public function createContactGroup($formData)
    {
        return $this->request->post('group', $formData);
    }

    public function getAllDedicatedNumber()
    {
        return $this->request->get('dedicated-number');
    }

    public function getAllOutgoingSms()
    {
        return $this->request->get('sms');
    }
}
