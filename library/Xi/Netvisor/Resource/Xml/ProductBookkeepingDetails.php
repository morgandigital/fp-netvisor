<?php

namespace Xi\Netvisor\Resource\Xml;

class ProductBookkeepingDetails
{
    private $defaultVatPercent;
    private $defaultDomesticAccountNumber;
    private $defaultEuAccountNumber;
    private $defaultOutsideEuAccountnumber;

    /**
     * @param string $defaultVatPercent
     * @param string $defaultDomesticAccountNumber
     * @param string $defaultEuAccountNumber
     * @param string $defaultOutsideEuAccountnumber
     */
    public function __construct(
        $defaultVatPercent,
        $defaultDomesticAccountNumber = null,
        $defaultEuAccountNumber = null,
        $defaultOutsideEuAccountnumber = null
    ) {
        $this->defaultVatPercent = $defaultVatPercent;
        $this->defaultDomesticAccountNumber = $defaultDomesticAccountNumber;
        $this->defaultEuAccountNumber = $defaultEuAccountNumber;
        $this->defaultOutsideEuAccountnumber = $defaultOutsideEuAccountnumber;
    }
}
