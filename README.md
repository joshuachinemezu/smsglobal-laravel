
# SmsGlobal Laravel Package

Laravel 5, 6 and 7 Package for SmsGlobal 

> A Laravel Package for integrating SmsGlobal seamlessly

## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, [Laravel](https://laravel.com/) 5.6+, and [Composer](https://getcomposer.org) are required.

To get the latest version of SmsGlobal Laravel, simply require it

```bash
composer require joshuachinemezu/smsglobal-laravel
```

Or add the following line to the require block of your `composer.json` file.

```
"joshuachinemezu/smsglobal-laravel": "1.0.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.



Once the package is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

```php
'providers' => [
    ...
    JoshuaChinemezu\SmsGlobal\SmsGlobalServiceProvider::class,
    ...
]
```

> If you use **Laravel >= 5.5** you can skip this step and go to [**`configuration`**](https://github.com/joshuachinemezu/smsglobal-laravel#configuration)

* `JoshuaChinemezu\SmsGlobal\SmsGlobalServiceProvider::class`

Also, register the Facade like so:

```php
'aliases' => [
    ...
    'SmsGlobal' => JoshuaChinemezu\SmsGlobal\Facades\SmsGlobal::class,
    ...
]
```

## Configuration

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="JoshuaChinemezu\SmsGlobal\SmsGlobalServiceProvider"
```

A configuration-file named `smsglobal.php` with the defaults will be placed in your `config` directory:

```php
<?php

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
```

## Usage

Open your .env file and add your api key and secret key which can be generated from [SmsGlobal Integration Page](https://mxt.smsglobal.com/integrations):

```php
SMSGLOBAL_API_KEY=xxxxxxxxxxxxx
SMSGLOBAL_SECRET_KEY=xxxxxxxxxxxxx
```
*If you are using a hosting service like heroku, remember to add the above details to your configuration variables.*


```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JoshuaChinemezu\SmsGlobal\RestApi\RestApiClient;

class SmsController extends Controller
{

    /**
     * Get 
     * @return json
     */
    public function getSmsGlobalDedicatedNumbers()
    {
        $smsglobal = new RestApiClient;
        return $smsglobal->getAllDedicatedNumbers();
    }
    
     /**
     * This method can be implemented in a Queue - this is just an example
     * @return json
     */
    public function sendSms()
    {
        $smsglobal = new RestApiClient;
        return $smsglobal->sendMessage([
            "destination" => "xxxx", // Destination mobile number. 3-15 digits
            "message" => "Hello", // The SMS message. If longer than 160 characters (GSM) or 70 characters (Unicode), splits into multiple SMS
        ]); // Check https://www.smsglobal.com/rest-api/ for more options
    }
}
```

Explanation of the methods this package provides.
```php
<?php

/**
 *  Get the auto top-up information associated to the authenticated account.
 */
$smsglobal->getAutoTopUpInfo();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAutoTopUpInfo();


/**
 *  Delete a contact
 * @param integer $id
 * @return json 
 */
$smsglobal->deleteContact($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->deleteContact($id);


/**
 *  Get the contact as identified by the given id.
 * @param integer $id
 * @return json 
 */
$smsglobal->getContactByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getContactByID($id);


/**
 *  Update the contact as identified by the given id. You can only update the
 * default fields associated with each contact.
 * @param integer $id
 * @return json 
 */
$smsglobal->updateContactByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->updateContactByID($id);


/**
 *  Get a list of all contact groups.
 * @param array $queryOptions
 * See https://www.smsglobal.com/rest-api/ - /v2/group - GET
 * @return json 
 */
$smsglobal->getAllContactGroups($queryOptions);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllContactGroups($queryOptions);


/**
 *  Create a new contact group.
 * @param array $formData
 * See https://www.smsglobal.com/rest-api/ - /v2/group - POST
 * @return json 
 * $formData = [
 *      "name" => "Joshua Group",
 *      "keyword" => "smsgroup",
 *      "defaultOrigin" => "",
 *      "isGlobal" => false,
 *  ]
 */
$smsglobal->createContactGroup($formData);

/**
 * Alternatively, use the helper.
 */
smsglobal()->createContactGroup($formData);


/**
 *  Create a new contact group.
 * @param integer $groupId
 * @param array $formData
 * @return json 
 * $formData = [
 *      "msisdn" => "Joshua Contact",
 *      "givenName" => "Joshua",
 * See on https://www.smsglobal.com/rest-api/  - group/{groupId}/contact - POST
 *  ]
 */
$smsglobal->createContact($groupId, $formData);

/**
 * Alternatively, use the helper.
 */
smsglobal()->createContact($groupId, $formData);


/**
 *  Get a list of all contacts in a group.
 * @param integer $groupId
 * @param array $filters
 * @return json 
 * $filters = [
 *      "offset" => 1,
 *      "limit" => 20,
 *      "sort" => "id"
 *  ]
 */
$smsglobal->getContactsByGroupID($groupId, $filters);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getContactsByGroupID($groupId, $filters);


/**
 *  Delete a contact group
 * @param integer $id
 * @return json 
 */
$smsglobal->deleteContactGroup($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->deleteContactGroup($id);


/**
 *  Get the contact group as identified by the given id.
 * @param integer $id
 * @return json 
 */
$smsglobal->getContactGroupByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getContactGroupByID($id);


/**
 *  Update fields of a group as identified by the given id
 * @param integer $id
 * @param array $param
 *  $param = [
 *     "name" => "Joshua Group",
 *      "keyword" => "",
 *       ... More options on https://www.smsglobal.com/rest-api/
 *   ]
 * @return json 
 */
$smsglobal->updateGroupFieldByID($id, $param);

/**
 * Alternatively, use the helper.
 */
smsglobal()->updateGroupFieldByID($id, $param);


/**
 *  View list of dedicated numbers
 * @return json 
 */
$smsglobal->getAllDedicatedNumbers();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllDedicatedNumbers();


/**
 *  View list of opted out numbers
 * @param array $filters
 *  $filters = [
 *     "phoneNumber" => xxx,
 *      "offset" => 1,
 *      "limit" => 20,
 *   ]
 * @return json 
 */
$smsglobal->getAllOptedOutNumbers($filters);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllOptedOutNumbers($filters);


/**
 *  Opt out mobile numbers
 * @param array $mobileNumbers
 *  $mobileNumbers = [xxx. xxx, xxx]
 * @return json 
 */
$smsglobal->optOutMobileNumbers($mobileNumbers);

/**
 * Alternatively, use the helper.
 */
smsglobal()->optOutMobileNumbers($mobileNumbers);


/**
 *  Validate mobile numbers for opt out
 * @param array $mobileNumbers
 *  $mobileNumbers = [xxx. xxx, xxx]
 * @return json 
 */
$smsglobal->validateOptOutMobileNumbers($mobileNumbers);

/**
 * Alternatively, use the helper.
 */
smsglobal()->validateOptOutMobileNumbers($mobileNumbers);



/**
 *  Opt in a mobile number
 * @param integer $mobileNumber
 *  $mobileNumbers = xxx
 * @return json 
 */
$smsglobal->optInMobileNumber($mobileNumber);

/**
 * Alternatively, use the helper.
 */
smsglobal()->optInMobileNumber($mobileNumber);


/**
 *  Opt in a mobile number
 * @param integer $mobileNumber
 *  $mobileNumbers = xxx
 * @return json 
 */
$smsglobal->optInMobileNumber($mobileNumber);

/**
 * Alternatively, use the helper.
 */
smsglobal()->optInMobileNumber($mobileNumber);


/**
 *  View list of shared pools
 * @return json 
 */
$smsglobal->getAllSharedPools();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllSharedPools();


/**
 *  View details of a shared pool
 * @param integer $id
 * @return json 
 */
$smsglobal->getSharedPoolByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getSharedPoolByID($id);



/**
 *  View list of outgoing messages
 * @param array $filters
 *  $filters = [
 *      "offset" => 1,
 *      "limit" => 20,
 *      "status" => "delivered",
 *      ... More option https://www.smsglobal.com/rest-api/ - /v2/sms - GET
 *   ]
 * @return json 
 */
$smsglobal->getAllOutGoingMessage($filters);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllOutGoingMessage($filters);


/**
 *  View list of outgoing messages
 * @param array $postData
 *  $postData = [
 *      "message" => "Hello",
 *      ... More option https://www.smsglobal.com/rest-api/ - /v2/sms - POST
 *   ]
 * @return json 
 */
$smsglobal->sendMessage($postData);

/**
 * Alternatively, use the helper.
 */
smsglobal()->sendMessage($postData);


/**
 *  Delete outgoing message
 * @param integer $id
 * @return json 
 */
$smsglobal->deleteOutGoingMessage($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->deleteOutGoingMessage($id);


/**
 * View details of an outgoing message
 * @param integer $id
 * @return json 
 */
$smsglobal->getOutGoingMessageByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getOutGoingMessageByID($id);


/**
 * View list of incoming messages
 * @param arrray $filters' 
 *  $filters = [
 *      "offset" => 1,
 *      "limit" => 20,
 *      ... More option https://www.smsglobal.com/rest-api/ - /v2/sms-incoming - GET
 *   ]
 * @return json 
 */
$smsglobal->getAllIncomingMessage($filters);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllIncomingMessage($filters);


/**
 * View list of incoming messages
 * @param arrray $filters' 
 *  $filters = [
 *      "offset" => 1,
 *      "limit" => 20,
 *      ... More option https://www.smsglobal.com/rest-api/ - /v2/sms-incoming - GET
 *   ]
 * @return json 
 */
$smsglobal->getAllIncomingMessage($filters);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getAllIncomingMessage($filters);


/**
 * Delete incoming message
 * @param integer $id
 * @return json 
 */
$smsglobal->deleteIncomingMessage($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->deleteIncomingMessage($id);


/**
 * View details of an incoming message
 * @param integer $id
 * @return json 
 */
$smsglobal->getIncomingMessageByID($id);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getIncomingMessageByID($id);


/**
 * Get the authenticated account's billing details.
 * @return json 
 */
$smsglobal->getBillingDetails();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getBillingDetails();


/**
 * Update the authenticated account's billing details.
 * @param array $params
 * See https://www.smsglobal.com/rest-api/ - /v2/user/billing-details - PUT
 * @return json 
 */
$smsglobal->updateBillingDetails($params);

/**
 * Alternatively, use the helper.
 */
smsglobal()->updateBillingDetails($params);


/**
 * Get the authenticated account's contact details.
 * @return json 
 */
$smsglobal->getContactDetails();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getContactDetails();


/**
 * Get the authenticated account's billing details.
 * @param array $params
 * See https://www.smsglobal.com/rest-api/ - /v2/user/billing-details - PUT
 * @return json 
 */
$smsglobal->updateContactDetails($params);

/**
 * Alternatively, use the helper.
 */
smsglobal()->updateContactDetails($params);


/**
 * View the account balance
 * @return json 
 */
$smsglobal->getBalance();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getBalance();


/**
 * Get the low balance alerts information associated to the authenticated
 * account. 
 * * @return json 
 */
$smsglobal->getLowBalanceAlert();

/**
 * Alternatively, use the helper.
 */
smsglobal()->getLowBalanceAlert();


/**
 * Update the authenticated account's low balance alerts information.
 * @param array $params
 * See https://www.smsglobal.com/rest-api/ - /v2/user/low-balance-alerts - PUT
 * * @return json 
 */
$smsglobal->updateLowAlertBalance($params);

/**
 * Alternatively, use the helper.
 */
smsglobal()->updateLowAlertBalance($params);


/**
 * Create sub account
 * @param array $params
 * See https://www.smsglobal.com/rest-api/ - /v2/user/low-balance-alerts - POST
 * * @return json 
 */
$smsglobal->createSubAccount($params);

/**
 * Alternatively, use the helper.
 */
smsglobal()->createSubAccount($params);


/**
 * Get the authenticated account's verified numbers.
 * @param array $params
 * See https://www.smsglobal.com/rest-api/ - /v2/user/verified-numbers - GET
 * * @return json 
 */
$smsglobal->getVerifiedNumbers($params);

/**
 * Alternatively, use the helper.
 */
smsglobal()->getVerifiedNumbers($params);

```


## Todo

* Add SMPP
* Add SOAP
* Add MMS API
* Add Whatsapp API
* Add Queue and Track Outgoing SMS
* Add Comprehensive Tests

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## How can I appreciate this package?

Why not star the github repo? I'd love the attention! Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/joshuachinemezu)!

## License

© The MIT License (MIT) Please see [License File](LICENSE.md) for more information.

Made with ❤️ by Joshua Chinemezu
