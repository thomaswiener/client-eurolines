<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\JourneyInterface;

class Journey implements JourneyInterface
{
    protected $legId;
    protected $stopGetOn;
    protected $stopGetOff;
    protected $departure;
    protected $arrival;
    protected $price;
    protected $busNumber;
    protected $lineId;
    protected $tripId;
    protected $lineDirection;
    protected $stopGetOnOrder;
    protected $stopGetOffOrder;
    protected $lineName;
    protected $freePlaces;
    protected $carrierId;
    protected $carrierName;
    protected $legDirection;
    protected $lineSid;
    protected $priceSetId;
    protected $seatId;
    protected $seat;
    protected $departureCalendar;
    protected $antenna;
    protected $carrierShortcut;
    protected $stopped;
    protected $lineNumber;
    protected $bookingID;
    protected $lineHasSeats;
    protected $ticketType;

    public function __construct()
    {
        $this->setTicketType(Ticket::TICKET_TYPE_SELL);
    }

    public function getLegAsArray()
    {
        return [
            'LegId'             => $this->getLegId(),
            'StopGetOn'         => $this->getStopGetOn(),
            'StopGetOff'        => $this->getStopGetOff(),
            'Departure'         => $this->getDeparture(),
            'Arrival'           => $this->getArrival(),
            'Price'             => $this->getPrice(),
            'BusNumber'         => $this->getBusNumber(),
            'LineId'            => $this->getLineId(),
            'TripId'            => $this->getTripId(),
            'LineDirection'     => $this->getLineDirection(),
            'StopGetOnOrder'    => $this->getStopGetOnOrder(),
            'StopGetOffOrder'   => $this->getStopGetOffOrder(),
            'LineName'          => $this->getLineName(),
            'FreePlaces'        => $this->getFreePlaces(),
            'CarrierId'         => $this->getCarrierId(),
            'CarrierName'       => $this->getCarrierName(),
            'LegDirection'      => $this->getLegDirection(),
            'LineSid'           => $this->getLineId(),
            'PriceSetId'        => $this->getPriceSetId(),
            'SeatId'            => $this->getSeatId(),
            'Seat'              => $this->getSeat(),
            'DepartureCalendar' => $this->getDepartureCalendar(),
            'Antenna'           => $this->getAntenna(),
            'CarrierShortcut'   => $this->getCarrierShortcut(),
            'Stopped'           => $this->getStopped(),
            'LineNumber'        => $this->getLineNumber(),
            'BookingID'         => $this->getBookingID(),
            'LineHasSeats'      => $this->getLineHasSeats(),
        ];
    }

    public function asArray()
    {
        $legThere = $this->getLegAsArray();

        return [
            'legThere'   => $legThere,
            'ticketType' => $this->getTicketType()
        ];
    }

    public function getLegForTicketSaleAsArray()
    {
        return [
            'LegId'             => $this->getLegId(),
            'StopGetOn'         => $this->getStopAsArray($this->getStopGetOn()),
            'StopGetOff'        => $this->getStopAsArray($this->getStopGetOff()),
            'Departure'         => $this->getDeparture(),
            'Arrival'           => $this->getArrival(),
            'BusNumber'         => $this->getBusNumber(),
            'LineId'            => $this->getLineId(),
            'TripId'            => $this->getTripId(),
            'LineDirection'     => $this->getLineDirection(),
            'StopGetOnOrder'    => $this->getStopGetOnOrder(),
            'StopGetOffOrder'   => $this->getStopGetOffOrder(),
            //'LineName'          => $this->getLineName(),
            'FreePlaces'        => $this->getFreePlaces(),
            'CarrierId'         => $this->getCarrierId(),
            'CarrierName'       => $this->getCarrierName(),
            'LegDirection'      => $this->getLegDirection(),
            'LineSid'           => $this->getLineId(),
            'PriceSetId'        => $this->getPriceSetId(),
            'SeatId'            => $this->getSeatId(),
            'Seat'              => $this->getSeat(),
            'DepartureCalendar' => $this->getDepartureCalendar(),
            'Antenna'           => $this->getAntenna(),
            'CarrierShortcut'   => $this->getCarrierShortcut(),
            //'Stopped'           => $this->getStopped(),
            'LineNumber'        => $this->getLineNumber(),
            'BookingID'         => $this->getBookingID(),
            'LineHasSeats'      => $this->getLineHasSeats(),
        ];
    }

    protected function getStopAsArray($stop)
    {
        $a = 1;
        return [
            'StopId'    => $stop['StopId'],
            'Code'      => $stop['Code'],
            'Latitude'  => $stop['Latitude'],
            'Longitute' => $stop['Longitute'],
            'CountryId' => $stop['CountryId']
        ];
    }

    /**
     * @return mixed
     */
    public function getAntenna()
    {
        return $this->antenna;
    }

    /**
     * @param mixed $antenna
     */
    public function setAntenna($antenna)
    {
        $this->antenna = $antenna;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param mixed $arrival
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    }

    /**
     * @return mixed
     */
    public function getBookingID()
    {
        return $this->bookingID;
    }

    /**
     * @param mixed $bookingID
     */
    public function setBookingID($bookingID)
    {
        $this->bookingID = $bookingID;
    }

    /**
     * @return mixed
     */
    public function getBusNumber()
    {
        return $this->busNumber;
    }

    /**
     * @param mixed $busNumber
     */
    public function setBusNumber($busNumber)
    {
        $this->busNumber = $busNumber;
    }

    /**
     * @return mixed
     */
    public function getCarrierId()
    {
        return $this->carrierId;
    }

    /**
     * @param mixed $carrierId
     */
    public function setCarrierId($carrierId)
    {
        $this->carrierId = $carrierId;
    }

    /**
     * @return mixed
     */
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * @param mixed $carrierName
     */
    public function setCarrierName($carrierName)
    {
        $this->carrierName = $carrierName;
    }

    /**
     * @return mixed
     */
    public function getCarrierShortcut()
    {
        return $this->carrierShortcut;
    }

    /**
     * @param mixed $carrierShortcut
     */
    public function setCarrierShortcut($carrierShortcut)
    {
        $this->carrierShortcut = $carrierShortcut;
    }

    /**
     * @return mixed
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param mixed $departure
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    }

    /**
     * @return mixed
     */
    public function getDepartureCalendar()
    {
        return $this->departureCalendar;
    }

    /**
     * @param mixed $departureCalendar
     */
    public function setDepartureCalendar($departureCalendar)
    {
        $this->departureCalendar = $departureCalendar;
    }

    /**
     * @return mixed
     */
    public function getFreePlaces()
    {
        return $this->freePlaces;
    }

    /**
     * @param mixed $freePlaces
     */
    public function setFreePlaces($freePlaces)
    {
        $this->freePlaces = $freePlaces;
    }

    /**
     * @return mixed
     */
    public function getLegDirection()
    {
        return $this->legDirection;
    }

    /**
     * @param mixed $legDirection
     */
    public function setLegDirection($legDirection)
    {
        $this->legDirection = $legDirection;
    }

    /**
     * @return mixed
     */
    public function getLegId()
    {
        return $this->legId;
    }

    /**
     * @param mixed $legId
     */
    public function setLegId($legId)
    {
        $this->legId = $legId;
    }

    /**
     * @return mixed
     */
    public function getLineDirection()
    {
        return $this->lineDirection;
    }

    /**
     * @param mixed $lineDirection
     */
    public function setLineDirection($lineDirection)
    {
        $this->lineDirection = $lineDirection;
    }

    /**
     * @return mixed
     */
    public function getLineHasSeats()
    {
        return $this->lineHasSeats;
    }

    /**
     * @param mixed $lineHasSeats
     */
    public function setLineHasSeats($lineHasSeats)
    {
        $this->lineHasSeats = $lineHasSeats;
    }

    /**
     * @return mixed
     */
    public function getLineId()
    {
        return $this->lineId;
    }

    /**
     * @param mixed $lineId
     */
    public function setLineId($lineId)
    {
        $this->lineId = $lineId;
    }

    /**
     * @return mixed
     */
    public function getLineName()
    {
        return $this->lineName;
    }

    /**
     * @param mixed $lineName
     */
    public function setLineName($lineName)
    {
        $this->lineName = $lineName;
    }

    /**
     * @return mixed
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * @param mixed $lineNumber
     */
    public function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
    }

    /**
     * @return mixed
     */
    public function getLineSid()
    {
        return $this->lineSid;
    }

    /**
     * @param mixed $lineSid
     */
    public function setLineSid($lineSid)
    {
        $this->lineSid = $lineSid;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPriceSetId()
    {
        return $this->priceSetId;
    }

    /**
     * @param mixed $priceSetId
     */
    public function setPriceSetId($priceSetId)
    {
        $this->priceSetId = $priceSetId;
    }

    /**
     * @return mixed
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param mixed $seat
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
    }

    /**
     * @return mixed
     */
    public function getSeatId()
    {
        return $this->seatId;
    }

    /**
     * @param mixed $seatId
     */
    public function setSeatId($seatId)
    {
        $this->seatId = $seatId;
    }

    /**
     * @return mixed
     */
    public function getStopGetOff()
    {
        return $this->stopGetOff;
    }

    /**
     * @param mixed $stopGetOff
     */
    public function setStopGetOff($stopGetOff)
    {
        $this->stopGetOff = $stopGetOff;
    }

    /**
     * @return mixed
     */
    public function getStopGetOffOrder()
    {
        return $this->stopGetOffOrder;
    }

    /**
     * @param mixed $stopGetOffOrder
     */
    public function setStopGetOffOrder($stopGetOffOrder)
    {
        $this->stopGetOffOrder = $stopGetOffOrder;
    }

    /**
     * @return mixed
     */
    public function getStopGetOn()
    {
        return $this->stopGetOn;
    }

    /**
     * @param mixed $stopGetOn
     */
    public function setStopGetOn($stopGetOn)
    {
        $this->stopGetOn = $stopGetOn;
    }

    /**
     * @return mixed
     */
    public function getStopGetOnOrder()
    {
        return $this->stopGetOnOrder;
    }

    /**
     * @param mixed $stopGetOnOrder
     */
    public function setStopGetOnOrder($stopGetOnOrder)
    {
        $this->stopGetOnOrder = $stopGetOnOrder;
    }

    /**
     * @return mixed
     */
    public function getStopped()
    {
        return $this->stopped;
    }

    /**
     * @param mixed $stopped
     */
    public function setStopped($stopped)
    {
        $this->stopped = $stopped;
    }

    /**
     * @return mixed
     */
    public function getTripId()
    {
        return $this->tripId;
    }

    /**
     * @param mixed $tripId
     */
    public function setTripId($tripId)
    {
        $this->tripId = $tripId;
    }

    /**
     * @return mixed
     */
    public function getTicketType()
    {
        return $this->ticketType;
    }

    /**
     * @param mixed $ticketType
     */
    public function setTicketType($ticketType)
    {
        $this->ticketType = $ticketType;
    }



}