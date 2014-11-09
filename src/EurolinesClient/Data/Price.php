<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\BaseInterface;
use EurolinesClient\Data\Interfaces\TicketInterface;

class Price implements BaseInterface
{
    protected $TariffId;
    protected $TariffCode;
    protected $TariffName;
    protected $PriceThere;
    protected $PriceBack;
    protected $Tax;
    protected $CurrencyID;
    protected $CurrencyCode;

    public function asArray()
    {
        $price = [
            'TariffId'      => $this->getTariffId(),
            'TariffCode'    => $this->getTariffCode(),
            'TariffName'    => $this->getTariffName(),
            'PriceThere'    => $this->getPriceThere(),
            'PriceBack'     => $this->getPriceBack(),
            'Tax'           => $this->getTax(),
            'CurrencyID'    => $this->getCurrencyID(),
            'CurrencyCode'  => $this->getCurrencyCode()
        ];

        return [
            'Price' => $price
        ];
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->CurrencyCode;
    }

    /**
     * @param mixed $CurrencyCode
     */
    public function setCurrencyCode($CurrencyCode)
    {
        $this->CurrencyCode = $CurrencyCode;
    }

    /**
     * @return mixed
     */
    public function getCurrencyID()
    {
        return $this->CurrencyID;
    }

    /**
     * @param mixed $CurrencyID
     */
    public function setCurrencyID($CurrencyID)
    {
        $this->CurrencyID = $CurrencyID;
    }

    /**
     * @return mixed
     */
    public function getPriceBack()
    {
        return $this->PriceBack;
    }

    /**
     * @param mixed $PriceBack
     */
    public function setPriceBack($PriceBack)
    {
        $this->PriceBack = $PriceBack;
    }

    /**
     * @return mixed
     */
    public function getPriceThere()
    {
        return $this->PriceThere;
    }

    /**
     * @param mixed $PriceThere
     */
    public function setPriceThere($PriceThere)
    {
        $this->PriceThere = $PriceThere;
    }

    /**
     * @return mixed
     */
    public function getTariffCode()
    {
        return $this->TariffCode;
    }

    /**
     * @param mixed $TariffCode
     */
    public function setTariffCode($TariffCode)
    {
        $this->TariffCode = $TariffCode;
    }

    /**
     * @return mixed
     */
    public function getTariffId()
    {
        return $this->TariffId;
    }

    /**
     * @param mixed $TariffId
     */
    public function setTariffId($TariffId)
    {
        $this->TariffId = $TariffId;
    }

    /**
     * @return mixed
     */
    public function getTariffName()
    {
        return $this->TariffName;
    }

    /**
     * @param mixed $TariffName
     */
    public function setTariffName($TariffName)
    {
        $this->TariffName = $TariffName;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->Tax;
    }

    /**
     * @param mixed $Tax
     */
    public function setTax($Tax)
    {
        $this->Tax = $Tax;
    }


}