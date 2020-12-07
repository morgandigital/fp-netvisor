<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

class OfficeVisitAddress
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
        if (!empty($country)) {
            $this->country = new AttributeElement(
                $country, array('type' => 'ISO-3166')
            );
        } else {
            $this->country = $country;
        }
    }
}
