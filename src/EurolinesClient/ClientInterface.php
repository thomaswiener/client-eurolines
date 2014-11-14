<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 08/10/14 17:54
 *
 * @category None
 * @package  Eurolines
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */

namespace EurolinesClient;

/**
 * Interface ClientInterface
 *
 * @category None
 * @package  Eurolines
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
interface ClientInterface
{
    /**
     * Do Request
     *
     * @param string $method Method of API Endpoint
     * @param array  $params Parameter Array
     *
     * @return mixed
     */
    public function request($method, $params = array());

    /**
     * Setup Request
     *
     * @param string $method API Method
     * @param array  $params Parameters
     *
     * @return \GuzzleHttp\Message\Request
     */
    public function setup($method, $params);

    public function setCommunicationLog(
        $request,
        $response,
        \DateTime $requestDateTime,
        \DateTime $responseDateTime
    );

    /**
     * Get Communication Log
     *
     * @return mixed
     */
    public function getCommunicationLog();

    /**
     * Get last request
     *
     * @return mixed
     */
    public function getLastRequest();
}
