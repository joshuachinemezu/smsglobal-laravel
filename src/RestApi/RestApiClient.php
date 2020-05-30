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

    /**
     * Create a contact.
     * @param integer $groupId
     * @param array $formData
     * @return json
     */
    public function createContact($groupId, $formData)
    {
        return $this->request->post("group/{$groupId}/contact", $formData);
    }

    /**
     * Get a list of all contacts in a group.
     * @param integer $groupId
     * @param array $filters
     * @return json
     */
    public function getContactsByGroupID($groupId, $filters)
    {
        return $this->request->get("group/{$groupId}/contacts", $filters);
    }

    /**
     * Delete a contact group
     * @param integer $id
     * @return json
     */
    public function deleteContactGroup($id)
    {
        return $this->request->delete("group/{$id}");
    }

    /**
     * Get the contact group as identified by the given id.
     * @param integer $id
     * @return json
     */
    public function getContactGroupByID($id)
    {
        return $this->request->get("group/{$id}");
    }

    /**
     * Update fields of a group as identified by the given id
     * @param integer $id
     * @param array $params
     * @return json
     */
    public function updateGroupFieldByID($id, $params)
    {
        return $this->request->patch("group/{$id}", $params);
    }

    /**
     * View list of dedicated numbers
     * @return json
     */
    public function getAllDedicatedNumbers()
    {
        return $this->request->get('dedicated-number');
    }

    /**
     * View list of opted out numbers
     * @param array $filters
     * @return json
     */
    public function getAllOptedOutNumbers($filters)
    {
        return $this->request->get('opt-outs', $filters);
    }

    /**
     * Opt out mobile numbers
     * @param array $mobileNumbers
     * @return json
     */
    public function optOutMobileNumbers($mobileNumbers)
    {
        return $this->request->post('opt-outs', $mobileNumbers);
    }

    /**
     * Validate mobile numbers for opt out
     * @param array $mobileNumbers
     * @return json
     */
    public function validateOptOutMobileNumbers($mobileNumbers)
    {
        return $this->request->post('opt-outs/validate', $mobileNumbers);
    }

    /**
     * Opt in a mobile number
     * @param integer $mobileNumber
     * @return json
     */
    public function optInMobileNumber($mobileNumber)
    {
        return $this->request->delete("opt-outs/{$mobileNumber}");
    }

    /**
     * View list of shared pools
     * @return json
     */
    public function getAllSharedPools()
    {
        return $this->request->get('sharedpool');
    }

    /**
     * View details of a shared pool
     * @param integer $id
     * @return json
     */
    public function getSharedPoolByID($id)
    {
        return $this->request->get("sharedpool/{$id}");
    }

    /**
     * View list of outgoing messages
     * @param arrray $filters
     * @return json
     */
    public function getAllOutGoingMessage($filters)
    {
        return $this->request->get('sms', $filters);
    }

    /**
     * Send SMS
     * @param array $optionData
     * @return json
     */
    public function sendMessage($optionData)
    {
        return $this->request->post('sms', $optionData);
    }

    /**
     * Delete outgoing message
     * @param integer $id
     * @return json
     */
    public function deleteOutGoingMessage($id)
    {
        return $this->request->delete("sms/{$id}");
    }

    /**
     * View details of an outgoing message
     * @param integer $id
     * @return json
     */
    public function getOutGoingMessageByID($id)
    {
        return $this->request->get("sms/{$id}");
    }

    /**
     * View list of incoming messages
     * @param arrray $filters
     * @return json
     */
    public function getAllIncomingMessage($filters)
    {
        return $this->request->get('sms-incoming', $filters);
    }

    /**
     * Delete incoming message
     * @param integer $id
     * @return json
     */
    public function deleteIncomingMessage($id)
    {
        return $this->request->delete("sms-incoming/{$id}");
    }

    /**
     * View details of an incoming message
     * @param integer $id
     * @return json
     */
    public function getIncomingMessageByID($id)
    {
        return $this->request->get("sms-incoming/{$id}");
    }

    /**
     * Get the authenticated account's billing details.
     * @return json
     */
    public function getBillingDetails()
    {
        return $this->request->get("user/billing-details");
    }

    /**
     * Update the authenticated account's billing details.
     * @param array $params
     * @return json
     */
    public function updateBillingDetails($params)
    {
        return $this->request->put("user/billing-details", $params);
    }

    /**
     * Get the authenticated account's contact details.
     * @return json
     */
    public function getContactDetails()
    {
        return $this->request->get("user/contact-details");
    }

    /**
     * Update the authenticated account's contact details.
     * @param array $params
     * @return json
     */
    public function updateContactDetails($params)
    {
        return $this->request->put("user/billing-details", $params);
    }

    /**
     * View the account balance
     * @return json
     */
    public function getBalance()
    {
        return $this->request->get("user/credit-details");
    }

    /**
     * Get the low balance alerts information associated to the authenticated
     * account.
     * @return json
     */
    public function getLowBalanceAlert()
    {
        return $this->request->get("user/low-balance-alerts");
    }

    /**
     * Update the authenticated account's low balance alerts information.
     * @param array $params
     * @return json
     */
    public function updateLowAlertBalance($params)
    {
        return $this->request->put("user/low-balance-alerts", $params);
    }

    /**
     * Create sub account
     * @param array $params
     * @return json
     */
    public function createSubAccount($params)
    {
        return $this->request->post("user/sub-account", $params);
    }

    /**
     * Get the authenticated account's verified numbers.
     * @return json
     */
    public function getVerifiedNumbers()
    {
        return $this->request->get("user/verified-numbers");
    }
}
