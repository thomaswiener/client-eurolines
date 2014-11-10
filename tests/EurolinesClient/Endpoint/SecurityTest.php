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
                $this->getResponseObjectLoginSuccess()
            )
        );
        $securityService = new Security($this->client);

        $user = new User();
        $user
            ->setUsername($this->options['username'])
            ->setPassword($this->options['password'])
            ->setLanguageCode('en');

        $response = $securityService->login($user);

        $this->assertTrue($response->isSuccessful());
    }

    public function testLoginFailure()
    {
        $this->client = $this->getMockedClientLogin(
            $this->returnValue(
                $this->getResponseObjectLoginFailure()
            )
        );
        $securityService = new Security($this->client);

        $user = new User();
        $user
            ->setUsername($this->options['username'])
            ->setPassword($this->options['password'])
            ->setLanguageCode('en');

        $response = $securityService->login($user);

        $this->assertFalse($response->isSuccessful());
    }

//    public function testIsLoggedInSuccess()
//    {
//        $this->client = $this->getMockedClientLogin(
//            $this->returnValue(
//                $this->getResponseObjectIsLoggedInSuccess()
//            )
//        );
//        $securityService = new Security($this->client);
//
//        $user = new User();
//        $user
//            ->setUsername($this->options['username'])
//            ->setPassword($this->options['password'])
//            ->setLanguageCode('en');
//
//        $response = $securityService->login($user);
//
//        $this->assertFalse($response->isSuccessful());
//    }
//
//    public function testIsLoggedInFailure()
//    {
//        $this->client = $this->getMockedClientLogin(
//            $this->returnValue(
//                $this->getResponseObjectIsLoggedInFailure()
//            )
//        );
//        $securityService = new Security($this->client);
//
//        $user = new User();
//        $user
//            ->setUsername($this->options['username'])
//            ->setPassword($this->options['password'])
//            ->setLanguageCode('en');
//
//        $response = $securityService->login($user);
//
//        $this->assertFalse($response->isSuccessful());
//    }



    #########
    # Helper
    #########

    protected function getMockedClientLogin($will)
    {
        $service = $this->getMockedClient();
        $service
            ->expects($this->any())
            ->method('request')
            ->will($will);

        return $service;
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

    protected function getResponseObjectLoginSuccess()
    {
        return $this->getResponseObject('{"requestBody":"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:ns1=\"Emtest.Emlines\"><SOAP-ENV:Body><ns1:Login><ns1:userName>testx<\/ns1:userName><ns1:password>test25478<\/ns1:password><ns1:languageCode>en<\/ns1:languageCode><\/ns1:Login><\/SOAP-ENV:Body><\/SOAP-ENV:Envelope>\n","requestHeader":"POST \/emlines_api\/api.asmx HTTP\/1.1\r\nHost: rezervari.eurolines.ro\r\nConnection: Keep-Alive\r\nUser-Agent: PHP-SOAP\/5.5.14\r\nContent-Type: text\/xml; charset=utf-8\r\nSOAPAction: \"Emtest.Emlines\/Login\"\r\nContent-Length: 330\r\n\r\n","responseBody":"<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:soap=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:xsi=\"http:\/\/www.w3.org\/2001\/XMLSchema-instance\" xmlns:xsd=\"http:\/\/www.w3.org\/2001\/XMLSchema\"><soap:Body><LoginResponse xmlns=\"Emtest.Emlines\"><LoginResult>e0000_NoError<\/LoginResult><userInfo><UserId>1717<\/UserId><Logon>testx<\/Logon><Password>test25478<\/Password><FirmId>1038<\/FirmId><Note>test25478<\/Note><UserName>Online<\/UserName><UserLastName>Training<\/UserLastName><FirmName>Touring RO<\/FirmName><UserType>TravelAgency<\/UserType><Provision>0<\/Provision><\/userInfo><\/LoginResponse><\/soap:Body><\/soap:Envelope>","responseHeader":"HTTP\/1.1 200 OK\r\nDate: Mon, 10 Nov 2014 07:09:33 GMT\r\nServer: Microsoft-IIS\/6.0\r\nP3P: CP=\"CAO IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"\'\r\nX-Powered-By: ASP.NET\r\nX-AspNet-Version: 2.0.50727\r\nSet-Cookie: ASP.NET_SessionId=pwrpkkie0xzhcqbo35xli3ji; path=\/; HttpOnly\r\nCache-Control: private, max-age=0\r\nContent-Type: text\/xml; charset=utf-8\r\nContent-Length: 627\r\n","cookies":{"ASP.NET_SessionId":["pwrpkkie0xzhcqbo35xli3ji","\/","rezervari.eurolines.ro"]},"responseStd":{"LoginResult":"e0000_NoError","userInfo":{"UserId":1717,"Logon":"testx","Password":"test25478","FirmId":1038,"Note":"test25478","UserName":"Online","UserLastName":"Training","FirmName":"Touring RO","UserType":"TravelAgency","Provision":0}}}');
    }

    protected function getResponseObjectLoginFailure()
    {
        return $this->getResponseObject('{"requestBody":"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:ns1=\"Emtest.Emlines\"><SOAP-ENV:Body><ns1:Login><ns1:userName>testx<\/ns1:userName><ns1:password>test25478<\/ns1:password><ns1:languageCode>en<\/ns1:languageCode><\/ns1:Login><\/SOAP-ENV:Body><\/SOAP-ENV:Envelope>\n","requestHeader":"POST \/emlines_api\/api.asmx HTTP\/1.1\r\nHost: rezervari.eurolines.ro\r\nConnection: Keep-Alive\r\nUser-Agent: PHP-SOAP\/5.5.14\r\nContent-Type: text\/xml; charset=utf-8\r\nSOAPAction: \"Emtest.Emlines\/Login\"\r\nContent-Length: 330\r\n\r\n","responseBody":"<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:soap=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:xsi=\"http:\/\/www.w3.org\/2001\/XMLSchema-instance\" xmlns:xsd=\"http:\/\/www.w3.org\/2001\/XMLSchema\"><soap:Body><LoginResponse xmlns=\"Emtest.Emlines\"><LoginResult>e0000_Error<\/LoginResult><userInfo><UserId>1717<\/UserId><Logon>testx<\/Logon><Password>test25478<\/Password><FirmId>1038<\/FirmId><Note>test25478<\/Note><UserName>Online<\/UserName><UserLastName>Training<\/UserLastName><FirmName>Touring RO<\/FirmName><UserType>TravelAgency<\/UserType><Provision>0<\/Provision><\/userInfo><\/LoginResponse><\/soap:Body><\/soap:Envelope>","responseHeader":"HTTP\/1.1 200 OK\r\nDate: Mon, 10 Nov 2014 07:09:33 GMT\r\nServer: Microsoft-IIS\/6.0\r\nP3P: CP=\"CAO IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"\'\r\nX-Powered-By: ASP.NET\r\nX-AspNet-Version: 2.0.50727\r\nSet-Cookie: ASP.NET_SessionId=pwrpkkie0xzhcqbo35xli3ji; path=\/; HttpOnly\r\nCache-Control: private, max-age=0\r\nContent-Type: text\/xml; charset=utf-8\r\nContent-Length: 627\r\n","cookies":{"ASP.NET_SessionId":["pwrpkkie0xzhcqbo35xli3ji","\/","rezervari.eurolines.ro"]},"responseStd":{"LoginResult":"e0000_Error","userInfo":{"UserId":1717,"Logon":"testx","Password":"test25478","FirmId":1038,"Note":"test25478","UserName":"Online","UserLastName":"Training","FirmName":"Touring RO","UserType":"TravelAgency","Provision":0}}}');
    }

    protected function getResponseObjectIsLoggedInSuccess()
    {
        return $this->getResponseObject('{"requestBody":"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:ns1=\"Emtest.Emlines\"><SOAP-ENV:Body><ns1:IsLoggedIn\/><\/SOAP-ENV:Body><\/SOAP-ENV:Envelope>\n","requestHeader":"POST \/emlines_api\/api.asmx HTTP\/1.1\r\nHost: rezervari.eurolines.ro\r\nConnection: Keep-Alive\r\nUser-Agent: PHP-SOAP\/5.5.14\r\nContent-Type: text\/xml; charset=utf-8\r\nSOAPAction: \"Emtest.Emlines\/IsLoggedIn\"\r\nContent-Length: 213\r\nCookie: ASP.NET_SessionId=pwrpkkie0xzhcqbo35xli3ji;\r\n\r\n","responseBody":"<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:soap=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:xsi=\"http:\/\/www.w3.org\/2001\/XMLSchema-instance\" xmlns:xsd=\"http:\/\/www.w3.org\/2001\/XMLSchema\"><soap:Body><IsLoggedInResponse xmlns=\"Emtest.Emlines\"><IsLoggedInResult>true<\/IsLoggedInResult><\/IsLoggedInResponse><\/soap:Body><\/soap:Envelope>","responseHeader":"HTTP\/1.1 200 OK\r\nDate: Mon, 10 Nov 2014 07:10:54 GMT\r\nServer: Microsoft-IIS\/6.0\r\nP3P: CP=\"CAO IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"\'\r\nX-Powered-By: ASP.NET\r\nX-AspNet-Version: 2.0.50727\r\nCache-Control: private, max-age=0\r\nContent-Type: text\/xml; charset=utf-8\r\nContent-Length: 351\r\n","cookies":{"ASP.NET_SessionId":["pwrpkkie0xzhcqbo35xli3ji"]},"responseStd":{"IsLoggedInResult":true}}');
    }

    protected function getResponseObjectIsLoggedInFailure()
    {
        return $this->getResponseObject('{"requestBody":"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<SOAP-ENV:Envelope xmlns:SOAP-ENV=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:ns1=\"Emtest.Emlines\"><SOAP-ENV:Body><ns1:IsLoggedIn\/><\/SOAP-ENV:Body><\/SOAP-ENV:Envelope>\n","requestHeader":"POST \/emlines_api\/api.asmx HTTP\/1.1\r\nHost: rezervari.eurolines.ro\r\nConnection: Keep-Alive\r\nUser-Agent: PHP-SOAP\/5.5.14\r\nContent-Type: text\/xml; charset=utf-8\r\nSOAPAction: \"Emtest.Emlines\/IsLoggedIn\"\r\nContent-Length: 213\r\nCookie: ASP.NET_SessionId=pwrpkkie0xzhcqbo35xli3ji;\r\n\r\n","responseBody":"<?xml version=\"1.0\" encoding=\"utf-8\"?><soap:Envelope xmlns:soap=\"http:\/\/schemas.xmlsoap.org\/soap\/envelope\/\" xmlns:xsi=\"http:\/\/www.w3.org\/2001\/XMLSchema-instance\" xmlns:xsd=\"http:\/\/www.w3.org\/2001\/XMLSchema\"><soap:Body><IsLoggedInResponse xmlns=\"Emtest.Emlines\"><IsLoggedInResult>true<\/IsLoggedInResult><\/IsLoggedInResponse><\/soap:Body><\/soap:Envelope>","responseHeader":"HTTP\/1.1 200 OK\r\nDate: Mon, 10 Nov 2014 07:10:54 GMT\r\nServer: Microsoft-IIS\/6.0\r\nP3P: CP=\"CAO IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT\"\'\r\nX-Powered-By: ASP.NET\r\nX-AspNet-Version: 2.0.50727\r\nCache-Control: private, max-age=0\r\nContent-Type: text\/xml; charset=utf-8\r\nContent-Length: 351\r\n","cookies":{"ASP.NET_SessionId":["pwrpkkie0xzhcqbo35xli3ji"]},"responseStd":{"IsLoggedInResult":false}}');
    }

    protected function getResponseObject($data)
    {
        $resultObject = json_decode($data);
        $resultObject->cookies = json_decode(json_encode($resultObject->cookies), true);

        return $resultObject;
    }

}