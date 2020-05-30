<?php

/*
 * This file is part of the SmsGlobal Laravel package.
 *
 * (c) Joshua Chinemezu <joshuachinemezu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoshuaChinemezu\SmsGlobal\Test;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class SmsGlobalRestApiClientTest extends TestCase
{
    protected $smsglobal;

    public function setUp(): void
    {
        $this->smsglobal = m::mock('JoshuaChinemezu\SmsGlobal\RestApi\RestApiClient');
        $this->mock = m::mock('GuzzleHttp\Client');
    }

    public function tearDown(): void
    {
        m::close();
    }
}
