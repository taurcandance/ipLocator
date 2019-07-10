<?php
require_once 'functions.php';


use UserInfo\UserInfo;
use LinksSwitcher\LinksSwitcher;
use LinksStorage\LinksStorage;
use LocationLocatorIpapi\LocationLocatorIpapi;

$link = $_GET['link'];
if (empty($link) || ! isset($link)) {
    die('Not have link');
}

$pathToLinks = get_full_data_path('linksStorage.txt');
$linkStorage = new LinksStorage;
if ( ! $linkStorage->loadFromFile($pathToLinks)) {
    die('Can`t load from file'.$pathToLinks);
};
$linkSwitcher = new LinksSwitcher($linkStorage);
$resultLink   = $linkSwitcher->getSwitchedLink($link);

echo '<a href="'.$resultLink.'">New link</a>';

$ip = $_SERVER['REMOTE_ADDR'];

$currentUserInfo = new UserInfo(
    $_SERVER['HTTP_USER_AGENT'],
    $ip,
    $_SERVER['REQUEST_TIME'],
    new LocationLocatorIpapi($ip)
);
echo $currentUserInfo;