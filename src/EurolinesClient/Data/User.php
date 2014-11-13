<?php

namespace EurolinesClient\Data;

use EurolinesClient\Data\Interfaces\UserInterface;

class User implements UserInterface
{
    protected $username;
    protected $password;
    protected $languageCode= 'en';

    public function asArray()
    {
        return [
            'userName'      => $this->getUsername(),
            'password'      => $this->getPassword(),
            'languageCode'  => $this->getLanguageCode()
        ];
    }

    /**
     * @return mixed
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param mixed $languageCode
     * @return $this
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
}
