<?php

namespace LinksSwitcher;


use LinksStorage\LinksStorage;

class LinksSwitcher
{
    private $links = [];

    public
    function __construct(LinksStorage $linksStorage)
    {
        $this->links = $linksStorage->getLinks();
    }

    /**
     * Return switched link
     *
     * @param string $link
     *
     * @return null|string
     */
    public
    function getSwitchedLink(string $link): ?string
    {
        $resultLink = null;
        if (in_array($link, $this->links)) {
            $resultLink = array_search($link, $this->links);
            if ($resultLink !== false) {
                return $resultLink;
            }
        }
        return $resultLink;
    }

    /**
     * Return list of the all links
     *
     * @return array
     */
    public
    function getLinksList(): array
    {
        return $this->links;
    }
}