<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\BaseInterface;

class Passenger implements BaseInterface
{
    protected $passengerId;
    protected $firstName;
    protected $lastName;
    protected $city;
    protected $street;
    protected $zipCode;
    protected $email;
    protected $country;
    protected $phoneNumber;
    protected $birthDate;
    protected $passport;
    protected $note;
    protected $loyalty;
    protected $price;
    protected $tax;
    protected $tickets;

    public function asArray()
    {
        $passenger = [
            'PassengerId'   => $this->getPassengerId(),
            'FirstName'     => $this->getFirstName(),
            'LastName'      => $this->getLastName(),
            //'City'          => $this->getCity(),
            'Street'        => $this->getStreet(),
            'ZipCode'       => $this->getZipCode(),
            'Email'         => $this->getEmail(),
            'Country'       => $this->getCountry(),
            'PhoneNumber'   => $this->getPhoneNumber(),
            'BirthDate'     => $this->getBirthDate(),
            'Passport'      => $this->getPassport(),
            'Note'          => $this->getNote(),
            'Loyalty'       => $this->getLoyalty(),
            'Price'         => $this->getPrice(),
            'Tax'           => $this->getTax(),
            'Tickets'       => $this->getTickets()
        ];

        return [
            'Passenger' => $passenger
        ];
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * @param mixed $loyalty
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getPassengerId()
    {
        return $this->passengerId;
    }

    /**
     * @param mixed $passengerId
     */
    public function setPassengerId($passengerId)
    {
        $this->passengerId = $passengerId;
    }

    /**
     * @return mixed
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * @param mixed $passport
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return mixed
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param mixed $tickets
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }


}