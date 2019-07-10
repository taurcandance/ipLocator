<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace LinksStorage;


class LinksStorage
{
    private $links = [];

    public
    function __construct()
    {
    }

    /**
     * Return links array
     *
     * @return array|null
     */
    public
    function getLinks(): ?array
    {
        return $this->links;
    }

    public
    function loadFromFile(string $pathToStorage): bool
    {
        $savedData = file_get_contents($pathToStorage);

        if (false === $savedData) {
            debug_log("Links storage not found in $pathToStorage");

            return false;
        }
        $this->links = unserialize($savedData);

        return true;
    }
}