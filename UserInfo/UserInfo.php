<?php

namespace UserInfo;


use LocatorByIp\LocatorByIp;
use LocationLocatorIpapi\LocationLocatorIpapi;

class UserInfo
{
    private $browser = null;
    private $browserVersion = null;
    private $ip = null;
    private $systemOs = null;
    private $timestamp = null;
    private $location = null;

    public
    function __construct(string $httpUserAgent, string $remoteAddr, string $requestTime, LocatorByIp $locator)
    {
        $this->ip = $remoteAddr;
        $this->setBrowserInfo($httpUserAgent);
        $this->setCurrentTimestamp($requestTime);
        $this->setLocation($locator);
    }

    /**
     * Getting users browser & platform
     *
     * @param null $httpUserAgent
     *
     * @return void
     */
    private
    function setBrowserInfo($httpUserAgent = null): void
    {
        $clientInfo = @get_browser(null, true);
        if ( ! is_array($clientInfo)) {
            $this->browser  = $httpUserAgent;
            $this->systemOs = php_uname('v');

            return;
        }
        $this->browser        = $clientInfo['browser'];
        $this->browserVersion = $clientInfo['version'];
        $this->systemOs       = $clientInfo['platform'];
    }

    /**
     * Getting current timestamp
     *
     * @param string $requestTime
     *
     * @return void
     */
    private
    function setCurrentTimestamp(string $requestTime): void
    {
        date_default_timezone_set('UTC');
        $this->timestamp = date("Y-m-d H:i:s", $requestTime);
    }

    /**
     * Getting users location
     *
     * @param LocatorByIp $locator
     *
     * @return void
     */
    private
    function setLocation(LocatorByIp $locator): void
    {
        $locationInfo = $locator->getLocationByIp($this->ip);
        if ( ! is_null($locationInfo['country_name'])) {
            $this->location = 'country_name: '.$locationInfo['country_name'];
            $this->location .= ' + region_name: '.$locationInfo['region_name'];
            $this->location .= ' + city: '.$locationInfo['city'];
        }
    }

    /**
     * Get Browser.
     *
     * @return string|null
     */
    public
    function getBrowser(): ?string
    {
        return $this->browser;
    }

    /**
     * Get BrowserVersion.
     *
     * @return string|null
     */
    public
    function getBrowserVersion(): ?string
    {
        return $this->browserVersion;
    }

    /**
     * Get Ip.
     *
     * @return string|null
     */
    public
    function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * Get users platform.
     *
     * @return string|null
     */
    public
    function getSystemOs(): ?string
    {
        return $this->systemOs;
    }

    /**
     * Get Timestamp.
     *
     * @return string|null
     */
    public
    function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    /**
     * Get Location.
     *
     * @return string|null
     */
    public
    function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     *  Print class info if called as string
     *
     * @return string
     */
    public
    function __toString(): string
    {
        $output = '<pre>';

        foreach ($this as $key => $value) {
            if (is_null($value)) {
                $value = 'unknown';
            }
            $output .= $key.' => '.$value.'<br />';
        }

        $output .= '</pre>';

        return $output;
    }
}