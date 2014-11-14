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

use EurolinesClient\Data\Interfaces\UserInterface;
use EurolinesClient\Endpoint\Interfaces\SecurityInterface;

/**
 * Class Security
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
class Security extends AbstractEndpoint implements SecurityInterface
{
    const METHOD_LOGIN          = 'Login';
    const METHOD_IS_LOGGED_IN   = 'IsLoggedIn';
    const METHOD_LOGOUT         = 'Logout';

    /**
     * Log user into system and return authorization cookie.
     *
     * @param UserInterface $user
     *
     * @return mixed
     */
    public function login(UserInterface $user)
    {
        $data     = [self::METHOD_LOGIN => $user->asArray()];

        return $this->doRequest(self::METHOD_LOGIN, $data, false);
    }

    /**
     * Return information if user is logged in
     *
     * @return mixed
     */
    public function isLoggedIn()
    {
        $data     = [];

        return $this->doRequest(self::METHOD_IS_LOGGED_IN, $data);
    }

    /**
     * Log out user from system
     *
     * @return mixed
     */
    public function logout()
    {
        $data     = [];

        return $this->doRequest(self::METHOD_LOGOUT, $data);
    }
}
