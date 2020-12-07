<?php

namespace Xi\Netvisor\Resource\Xml;

class OfficeContactAddress
{
    private $streetAddress;
    private $postNumber;
    private $city;
    private $country;

    /**
     * @param string $streetAddress
     * @param string $postNumber
     * @param string $city
     * @param string $country
     */
    public function __construct(
        $streetAddress,
        $postNumber,
        $city,
        $country
    ) {
        $this->streetAddress = $streetAddress;
        $this->postNumber = $postNumber;
        $this->city = $city;
        $this->country = $country;
    }
}
