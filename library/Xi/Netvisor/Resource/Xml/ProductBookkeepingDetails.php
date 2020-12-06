<?php

namespace Xi\Netvisor\Resource\Xml;

class ProductBookkeepingDetails
{
    private $defaultVatPercentage;
    private $defaultDomesticAccountNumber;
    private $defaultEuAccountNumber;
    private $defaultOutsideEuAccountnumber;

    /**
     * @param string $defaultVatPercentage
     * @param string $defaultDomesticAccountNumber
     * @param string $defaultEuAccountNumber
     * @param string $defaultOutsideEuAccountnumber
     */
    public function __construct(
        $defaultVatPercentage,
        $defaultDomesticAccountNumber = null,
        $defaultEuAccountNumber = null,
        $defaultOutsideEuAccountnumber = null
    ) {
        $this->defaultVatPercentage = $defaultVatPercentage;
        $this->defaultDomesticAccountNumber = $defaultDomesticAccountNumber;
        $this->defaultEuAccountNumber = $defaultEuAccountNumber;
        $this->defaultOutsideEuAccountnumber = $defaultOutsideEuAccountnumber;
    }
}
