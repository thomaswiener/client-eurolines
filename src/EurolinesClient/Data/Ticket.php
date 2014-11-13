<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\TicketCancelInterface;
use EurolinesClient\Data\Interfaces\TicketInterface;
use EurolinesClient\Data\Interfaces\TicketPdfInterface;

class Ticket implements TicketInterface, TicketCancelInterface, TicketPdfInterface
{
    const TICKET_TYPE_SELL                = 'Sell';
    const TICKET_TYPE_OFFLINE_RESERVATION = 'OfflineReservation';
    const TICKET_TYPE_INVOICE             = 'Invoice';
    const TICKET_TYPE_RESERVATION         = 'Reservation';
    const TICKET_TYPE_STANDBY             = 'Standby';
    const TICKET_TYPE_BOOKING             = 'Booking';
    const TICKET_TYPE_ORDER               = 'Order';
    const TICKET_TYPE_WEBORDER            = 'WebOrder';
    const TICKET_TYPE_VOUCHER             = 'Voucher';
    const TICKET_TYPE_DRIVER              = 'Driver';

    const PAYMENT_TYPE_CASH     = 'PAY_CASH';
    const PAYMENT_TYPE_OP       = 'PAY_OP';
    const PAYMENT_TYPE_POS      = 'PAY_POS';
    const PAYMENT_TYPE_ADV      = 'PAY_ADV';
    const PAYMENT_TYPE_ONLINE   = 'PAY_ONLINE';

    protected $ticketType;
    protected $journeyType;
    protected $journeys;
    protected $passengerCollection;
    protected $priceCollection;
    protected $paymentType;
    protected $invoiceNumber;
    protected $offlineSalePartnerId;

    protected $referenceNumber;
    protected $ticketNumber;
    protected $tariffId;
    protected $cancelOnlyBackWay;

    protected $templateName;

    public function __construct()
    {
        //as defined in https://busaobr.atlassian.net/browse/EURO-244
        $this->paymentType = self::PAYMENT_TYPE_OP;
        $this->offlineSalePartnerId = 0;
    }

    public function asArray()
    {
        return [
            'ticketType'            => $this->getTicketType(),
            'journeyType'           => $this->getJourneyType(),
            'journey'               => $this->getJourneys(),
            'passengerCollection'   => $this->getPassengerCollection(),
            'priceCollection'       => $this->getPriceCollection(),
            'paymentType'           => $this->getPaymentType(),
            'invoiceNumber'         => $this->getInvoiceNumber(),
            'offlineSalePartnerId'  => $this->getOfflineSalePartnerId()
        ];
    }

    /**
     * Get ticket cancel as array
     *
     * @return mixed
     */
    public function getTicketCancelAsArray()
    {
        return [
            'referenceNumber'   => $this->getReferenceNumber(),
            'ticketNumber'      => $this->getTicketNumber(),
            'tariffID'          => $this->getTariffId(),
            'cancelOnlyBackWay' => $this->getCancelOnlyBackWay()
        ];
    }

    /**
     * Get ticket pdf as array
     *
     * @return mixed
     */
    public function getTicketPdfAsArray()
    {
        return [
            'refNum'       => $this->getReferenceNumber(),
            'templateName' => $this->getTemplateName()
        ];
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param mixed $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
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
     */
    public function setJourneyType($journeyType)
    {
        $this->journeyType = $journeyType;
    }

    /**
     * @return mixed
     */
    public function getJourneys()
    {
        $items = [];
        foreach ($this->journeys as $item) {
            $items[] = ['Leg' => $item->getLegForTicketSaleAsArray()];
        }

        if (sizeof($items) == 1) {
            return $items[0];
        }

        return $items;
    }

    /**
     * @param mixed $journeys
     */
    public function setJourneys($journeys)
    {
        $this->journeys = $journeys;
    }

    /**
     * @param mixed $journey
     */
    public function addJourney($journey)
    {
        $this->journeys[] = $journey;
    }

    /**
     * @return mixed
     */
    public function getOfflineSalePartnerId()
    {
        return $this->offlineSalePartnerId;
    }

    /**
     * @param mixed $offlineSalePartnerId
     */
    public function setOfflineSalePartnerId($offlineSalePartnerId)
    {
        $this->offlineSalePartnerId = $offlineSalePartnerId;
    }

    /**
     * @return mixed
     */
    public function getPassengerCollection()
    {
        $items = [];
        foreach ($this->passengerCollection as $passenger) {
            $items[] = $passenger->asArray();
        }

        if (sizeof($items) == 1) {
            return $items[0];
        }

        return $items;
    }

    /**
     * @param mixed $passengerCollection
     */
    public function setPassengerCollection($passengerCollection)
    {
        $this->passengerCollection = $passengerCollection;
    }

    /**
     * @param Passenger $passenger
     */
    public function addPassenger(Passenger $passenger)
    {
        $this->passengerCollection[] = $passenger;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param mixed $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }

    /**
     * @return mixed
     */
    public function getPriceCollection()
    {
        $items = [];
        foreach ($this->priceCollection as $item) {
            $items[] = $item->asArray();
        }

        if (sizeof($items) == 1) {
            return ['ArrayOfPrice' => $items[0]];
        }

        return ['ArrayOfPrice' => $items];
    }

    /**
     * @param mixed $priceCollection
     */
    public function setPriceCollection($priceCollection)
    {
        $this->priceCollection = $priceCollection;
    }

    /**
     * @param mixed $price
     */
    public function addPrice(Price $price)
    {
        $this->priceCollection[] = $price;
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

    /**
     * @return mixed
     */
    public function getCancelOnlyBackWay()
    {
        return $this->cancelOnlyBackWay;
    }

    /**
     * @param mixed $cancelOnlyBackWay
     */
    public function setCancelOnlyBackWay($cancelOnlyBackWay)
    {
        $this->cancelOnlyBackWay = $cancelOnlyBackWay;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $referenceNumber
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @return mixed
     */
    public function getTariffId()
    {
        return $this->tariffId;
    }

    /**
     * @param mixed $tariffId
     */
    public function setTariffId($tariffId)
    {
        $this->tariffId = $tariffId;
    }

    /**
     * @return mixed
     */
    public function getTicketNumber()
    {
        return $this->ticketNumber;
    }

    /**
     * @param mixed $ticketNumber
     */
    public function setTicketNumber($ticketNumber)
    {
        $this->ticketNumber = $ticketNumber;
    }

    /**
     * @return mixed
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param mixed $templateName
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }
}
