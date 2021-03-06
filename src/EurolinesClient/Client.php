<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 18/09/14 16:29
 *
 * @category None
 * @package  Eurolines
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */

namespace EurolinesClient;

use DOMDocument;
use EurolinesClient\Data\LogEntry;
use Exception;

/**
 * Class ClientJourney
 *
 * @category None
 * @package  Eurolines
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
class Client extends \SoapClient implements ClientInterface
{
    protected $options;

    protected $logEntry;

    /**
     * Constructor
     *
     * @param array $config   The config data
     */
    public function __construct(array $config)
    {
        parent::__construct(
            $config['wsdl'],
            array(
                "trace"      => 1,
                "exception"  => 0,
                "cache_wsdl" => 0
            )
        );

        $this->options = $config;
        $this->logEntry = new LogEntry();
    }

    /**
     * Setup Request
     *
     * @param string $method API Method
     * @param array  $params Parameters
     *
     * @return \GuzzleHttp\Message\Request
     */
    public function setup($method, $params)
    {
        return $this->prepare($method, $params);
    }

    /**
     * Do SOAP Request
     *
     * @param string $method API Method Name
     * @param array  $params Parameter to send
     *
     * @return mixed
     * @throws Exception
     */
    public function request($method, $params = array(), $headers = array())
    {
        $this->setHeaders($headers);

        try {
            $requestDateTime = new \DateTime();
            $result = $this->__soapCall($method, $params, null, null);
            $responseDateTime = new \DateTime();

            $resultObject = $this->getResultObject($result);

            $this->setCommunicationLog(
                $this->getLogString($method, $resultObject->requestBody),
                $this->getLogString($method, $resultObject->responseBody),
                $requestDateTime,
                $responseDateTime
            );

            #$a = json_encode($resultObject);
            return $resultObject;

        } catch (\Exception $e) {
            $this->setCommunicationLog(
                $this->getLogString($method, $resultObject->requestBody),
                '[exception] ' . $e->getMessage(),
                $requestDateTime,
                new \DateTime()
            );

            throw new \Exception($e->getMessage());
        }
    }

    public function setHeaders($headers)
    {
        if (isset($headers['cookies'])) {
            foreach ($headers['cookies'] as $name => $value) {
                $this->__setCookie($name, $value);
            }
        }
    }

    protected function getResultObject($result)
    {
        $resultObject = new \stdClass();
        $resultObject->requestBody    = $this->__getLastRequest();
        $resultObject->requestHeader  = $this->__getLastRequestHeaders();
        $resultObject->responseBody   = $this->__getLastResponse();
        $resultObject->responseHeader = $this->__getLastResponseHeaders();
        $resultObject->cookies        = $this->_cookies;
        $resultObject->responseStd    = $result;

        return $resultObject;
    }

    /**
     *
     *
     * @param $data
     * @return mixed
     */
    protected function getFormattedXml($data)
    {
        /*try {
            $domxml = new DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($data);

            return $domxml->saveXML();
        } catch (\Exception $ex) {

        }*/

        return $data;
    }

    /**
     * Set Communication Log
     *
     * @param string    $request          Request
     * @param string    $response         Response
     * @param \DateTime $requestDateTime  Date Time of Request
     * @param \DateTime $responseDateTime Date Time of Response
     *
     * @return $this
     */
    public function setCommunicationLog(
        $request,
        $response,
        \DateTime $requestDateTime,
        \DateTime $responseDateTime
    ) {
        $this->logEntry = new LogEntry();
        $this->logEntry
            ->setRequestBody($request)
            ->setResponseBody($response)
            ->setRequestDateTime($requestDateTime)
            ->setResponseDateTime($responseDateTime);

        return $this;
    }

    /**
     * Get Communication Log
     *
     * @return mixed
     */
    public function getCommunicationLog()
    {
        return $this->logEntry;
    }

    /**
     * @param $method
     * @param $data
     * @return string
     */
    protected function getLogString($method, $data)
    {
        return sprintf(
            '[%s]%s %s',
            $method,
            PHP_EOL,
            $this->getFormattedXml($data)
        );
    }

    /**
     * Get last request
     *
     * @return mixed
     */
    public function getLastRequest()
    {
        if ($this->logEntry) {
            return $this->logEntry->getFormattedLogMessage();
        }

        return '';
    }
}
