<?php
/**
 * Created by PhpStorm.
 * User: twiener
 * Date: 11/9/14
 * Time: 9:12 PM
 */

namespace Tests\EurolinesClient\Endpoint;

use EurolinesClient\Client;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected $options;

    protected $client;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $options = array(
            'wsdl'     => 'http://rezervari.eurolines.ro/emlines_api/api.asmx?WSDL',
            'username' => 'username',
            'password' => 'password'
        );

        $this->client = new Client($this->options, 'log');
    }

    protected function getMockedClient(array $methods = array())
    {
        return $this->getMockObject('\\EurolinesClient\\Client');
    }
} 