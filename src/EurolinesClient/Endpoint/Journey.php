<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 18/09/14 15:20
 *
 * @category None
 * @package  Rocket\Bus\Europe\SharedBundle\Component\BookingEngine\Eurolines\Service\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
namespace EurolinesClient\Endpoint;

use Guzzle\Http\ClientInterface;
use EurolinesClient\Data\Response;
use EurolinesClient\Data\Interfaces\JourneySearchInterface as JourneySearchDataInterface;
use EurolinesClient\Data\Interfaces\JourneyInterface as JourneyDataInterface;
use EurolinesClient\Endpoint\Interfaces\JourneyInterface;

/**
 * Class Journey
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
class Journey extends AbstractEndpoint implements JourneyInterface
{
    const METHOD_SEARCH_JOURNEY = 'SearchJourney';
    const METHOD_GET_TARIFFS    = 'GetTariffs';
    const METHOD_GET_TEMPLATES  = 'GetPrintTemplates';

    /**
     * Search for journeys
     *
     * @param JourneySearchDataInterface $journeySearch
     *
     * @return Response
     */
    public function search(JourneySearchDataInterface $journeySearch)
    {
        $data = [self::METHOD_SEARCH_JOURNEY => $journeySearch->asArray()];

        return $this->doRequest(self::METHOD_SEARCH_JOURNEY, $data);
    }

    /**
     * Get tariffs for leg / journey
     *
     * @param JourneyDataInterface $journey
     *
     * @return Response
     */
    public function getTariff(JourneyDataInterface $journey)
    {
        $data = [self::METHOD_GET_TARIFFS => $journey->asArray()];

        return $this->doRequest(self::METHOD_GET_TARIFFS, $data);
    }

    /**
     * Return collection of possible print templates for company and line
     *
     * @param $lineId
     *
     * @return mixed
     */
    public function getTemplatesByLineId($lineId)
    {
        $data = [self::METHOD_GET_TEMPLATES => ['lineID' => $lineId]];

        return $this->doRequest(self::METHOD_GET_TEMPLATES, $data);
    }

    /**
     * Cancel tariffs
     *
     * @param param JourneyDataInterface $journey
     *
     * @return \EurolinesClient\Endpoint\Interfaces\Response
     */
    public function cancelTariff(JourneyDataInterface $journey)
    {
        // TODO: Implement cancelTariff() method.
    }
}