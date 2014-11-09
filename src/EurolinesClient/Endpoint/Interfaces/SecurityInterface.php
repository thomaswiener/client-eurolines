<?php

namespace EurolinesClient\Endpoint\Interfaces;

use EurolinesClient\Data\Interfaces\UserInterface;

interface SecurityInterface
{
    /**
     * Log user into system and return authorization cookie.
     *
     * @param UserInterface $user
     *
     * @return mixed
     */
    public function login(UserInterface $user);

    /**
     * Return information if user is logged in
     *
     * @param $sessionId
     *
     * @return mixed
     */
    public function isLoggedIn();

    /**
     * Log out user from system
     *
     * @return mixed
     */
    public function logout();
} 