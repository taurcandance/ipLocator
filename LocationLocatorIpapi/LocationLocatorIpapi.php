<?php

namespace LocationLocatorIpapi;


use LocatorByIp\LocatorByIp;

class LocationLocatorIpapi implements LocatorByIp
{
    private $accessKey = 'c8be025bbe1ea7dc1104f180f22a2d11';

    public
    function __construct(string $accessKey = null)
    {
        if ( ! is_null($accessKey)) {
            $this->accessKey = $accessKey;
        }
    }

    /**
     * Getting location user by external api service
     *
     * @param string $ip
     *
     * @return array|null
     */
    public
    function getLocationByIp(string $ip): ?array
    {
        $url = 'http://api.ipapi.com/api/'.$ip.'?access_key='.$this->accessKey;
        $response = @file_get_contents($url);

        if (false === $response) {
            return null;
        }
        return json_decode($response, true);
    }
}