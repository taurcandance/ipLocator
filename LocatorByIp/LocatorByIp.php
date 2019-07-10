<?php

namespace LocatorByIp;


interface LocatorByIp
{
    public
    function getLocationByIp(string $ip): ?array;
}