<?php

namespace Xi\Netvisor\Resource\Xml;

class CustomerDeliveryDetails
{
    private $deliveryName;
    private $deliveryStreetAddress;
    private $deliveryCity;
    private $deliveryPostNumber;
    private $deliveryCountry;

    /**
     * @param string $deliveryName
     * @param string $deliveryStreetAddress
     * @param string $deliveryCity
     * @param string $deliveryPostNumber
     * @param string $deliveryCountry
     */
    public function __construct(
        $deliveryName,
        $deliveryStreetAddress,
        $deliveryCity,
        $deliveryPostNumber,
        $deliveryCountry
    ) {
        $this->deliveryName = $deliveryName;
        $this->deliveryStreetAddress = $deliveryStreetAddress;
        $this->deliveryCity = $deliveryCity;
        $this->deliveryPostNumber = $deliveryPostNumber;
        $this->deliveryCountry = $deliveryCountry;
    }
}
