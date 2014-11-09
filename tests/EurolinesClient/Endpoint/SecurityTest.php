<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 11/9/14
 * Time: 9:05 PM
 */

namespace Tests\EurolinesClient\Endpoint;

use EurolinesClient\Data\User;
use EurolinesClient\Endpoint\Security;

class SecurityTest extends \PHPUnit_Framework_TestCase
{
    protected $options;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->options = array(
            'wsdl'     => 'http://rezervari.eurolines.ro/emlines_api/api.asmx?WSDL',
            'username' => 'username',
            'password' => 'password'
        );
    }

    public function testLoginSuccess()
    {
        $this->client = $this->getMockedClientLogin(
            $this->returnValue(
                $this->getLoginResponseObject('')
            )
        );
        $securityService = new Security($this->client);

        $user = new User();
        $user
            ->setUsername($this->options['username'])
            ->setPassword($this->options['password'])
            ->setLanguageCode('en');

        $response = $securityService->login($user);
    }

    protected function getMockedClientLogin($will)
    {
        $service = $this->getMockedClient();
        $service
            ->expects($this->any())
            ->method('request')
            ->will($will);

        return $service;
    }

    protected function getLoginResponseObject($result)
    {
        $resultObject = new \stdClass();
        $resultObject->requestBody    = '';
        $resultObject->requestHeader  = '';
        $resultObject->responseBody   = '';
        $resultObject->responseHeader = '';
        $resultObject->cookies        = '';
        $resultObject->responseStd    = $result;

        return $resultObject;
    }

    protected function getMockedClient(array $methods = array())
    {
        return $this->getMockObject('\\EurolinesClient\\Client');
    }

    protected function getMockObject($class, array $methods = array())
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }
} 