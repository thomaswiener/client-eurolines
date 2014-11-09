<?php

namespace EurolinesClient\Endpoint\Interfaces;

use EurolinesClient\Data\Interfaces\JourneySearchInterface as JourneySearchDataInterface;
use EurolinesClient\Data\Interfaces\JourneyInterface as JourneyDataInterface;


interface JourneyInterface
{
    /**
     * Search for journeys
     *
     * @param JourneySearchDataInterface $journey
     *
     * @return mixed
     */
    public function search(JourneySearchDataInterface $journey);

    /**
     * Get tariffs for leg / journey
     *
     * @param param JourneyDataInterface $journey
     *
     * @return Response
     */
    public function getTariff(JourneyDataInterface $journey);

    /**
     * Return collection of possible print templates for company and line
     *
     * @param $lineId
     *
     * @return mixed
     */
    public function getTemplatesByLineId($lineId);

    /**
     * Cancel tariffs
     *
     * @param param JourneyDataInterface $journey
     *
     * @return Response
     */
    public function cancelTariff(JourneyDataInterface $journey);
} 