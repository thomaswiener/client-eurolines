<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\JourneySearchInterface;

class JourneySearch implements JourneySearchInterface
{
    /**
     * one way journey
     */
    const TYPE_ONE_WAY = 'OneWay';
    /**
     * two way journey with open date of return
     */
    const TYPE_RETURN_OPEN = 'ReturnOpen';
    /**
     * two way journey
     */
    const TYPE_RETURN = 'Return';


    protected $journeyType;
    protected $busStopCodeFrom;
    protected $busStopCodeTo;
    protected $busStopCodeBackFrom;
    protected $busStopCodeBackTo;
    protected $departureDate;
    protected $departureBackDate;
    protected $searchInterval = 0;
    protected $minTransferTime = 0;
    protected $maxTransferTime = 0;

    public function __construct()
    {
        $this->departureDate     = (new \DateTime())->setDate(1900, 1, 1);
        //endpoint needs valid datetime object, even when not used
        $this->departureBackDate = (new \DateTime())->setDate(1900, 1, 1);
    }

    public function asArray()
    {
        return [
            'journeyType'           => $this->getJourneyType(),
            'busStopCodeFrom'       => $this->getBusStopCodeFrom(),
            'busStopCodeTo'         => $this->getBusStopCodeTo(),
            'busStopCodeBackFrom'   => $this->getBusStopCodeBackFrom(),
            'busStopCodeBackTo'     => $this->getBusStopCodeBackTo(),
            'departureDate'         => $this->getDepartureDate()->format('c'),
            'departureBackDate'     => $this->getDepartureBackDate()->format('c'),
            'searchInterval'        => $this->getSearchInterval(),
            'minTransferTime'       => $this->getMinTransferTime(),
            'maxTransferTime'       => $this->getMaxTransferTime()
        ];
    }

    /**
     * @return mixed
     */
    public function getBusStopCodeBackFrom()
    {
        return $this->busStopCodeBackFrom;
    }

    /**
     * @param mixed $busStopCodeBackFrom
     *
     * @return $this
     */
    public function setBusStopCodeBackFrom($busStopCodeBackFrom)
    {
        $this->busStopCodeBackFrom = $busStopCodeBackFrom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBusStopCodeBackTo()
    {
        return $this->busStopCodeBackTo;
    }

    /**
     * @param mixed $busStopCodeBackTo
     *
     * @return $this
     */
    public function setBusStopCodeBackTo($busStopCodeBackTo)
    {
        $this->busStopCodeBackTo = $busStopCodeBackTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBusStopCodeFrom()
    {
        return $this->busStopCodeFrom;
    }

    /**
     * @param mixed $busStopCodeFrom
     *
     * @return $this
     */
    public function setBusStopCodeFrom($busStopCodeFrom)
    {
        $this->busStopCodeFrom = $busStopCodeFrom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBusStopCodeTo()
    {
        return $this->busStopCodeTo;
    }

    /**
     * @param mixed $busStopCodeTo
     *
     * @return $this
     */
    public function setBusStopCodeTo($busStopCodeTo)
    {
        $this->busStopCodeTo = $busStopCodeTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartureBackDate()
    {
        return $this->departureBackDate;
    }

    /**
     * @param mixed $departureBackDate
     *
     * @return $this
     */
    public function setDepartureBackDate($departureBackDate)
    {
        $this->departureBackDate = $departureBackDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartureDate()
    {
        return $this->departureDate;
    }

    /**
     * @param mixed $departureDate
     *
     * @return $this
     */
    public function setDepartureDate($departureDate)
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJourneyType()
    {
        return $this->journeyType;
    }

    /**
     * @param mixed $journeyType
     *
     * @return $this
     */
    public function setJourneyType($journeyType)
    {
        $this->journeyType = $journeyType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxTransferTime()
    {
        return $this->maxTransferTime;
    }

    /**
     * @param mixed $maxTransferTime
     *
     * @return $this
     */
    public function setMaxTransferTime($maxTransferTime)
    {
        $this->maxTransferTime = $maxTransferTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinTransferTime()
    {
        return $this->minTransferTime;
    }

    /**
     * @param mixed $minTransferTime
     *
     * @return $this
     */
    public function setMinTransferTime($minTransferTime)
    {
        $this->minTransferTime = $minTransferTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearchInterval()
    {
        return $this->searchInterval;
    }

    /**
     * @param mixed $searchInterval
     *
     * @return $this
     */
    public function setSearchInterval($searchInterval)
    {
        $this->searchInterval = $searchInterval;

        return $this;
    }
}
