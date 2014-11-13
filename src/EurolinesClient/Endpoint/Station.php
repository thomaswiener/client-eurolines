<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 18/09/14 15:20
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
namespace EurolinesClient\Endpoint;

use EurolinesClient\Endpoint\Interfaces\StationInterface;

/**
 * Class Journey
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
class Station extends AbstractEndpoint implements StationInterface
{
    const METHOD_GET_BUS_STOPS = 'GetBusStopsByUser';

    /**
     * Get a bus stops
     *
     * @return mixed
     */
    public function getAll()
    {
        $data     = [];

        return $this->doRequest(self::METHOD_GET_BUS_STOPS, $data);
    }
}
