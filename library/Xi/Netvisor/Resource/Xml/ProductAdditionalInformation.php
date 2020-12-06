<?php

namespace Xi\Netvisor\Resource\Xml;

class ProductAdditionalInformation
{
    private $productNetWeight;
    private $productGrossWeight;
    private $productWeightUnit;
    private $productPackageInformation;

    /**
     * @param string $productNetWeight
     * @param string $productGrossWeight
     * @param string $productWeightUnit
     * @param string $productPackageInformation
     */
    public function __construct(
        $productNetWeight,
        $productGrossWeight,
        $productWeightUnit,
        ProductPackageInformation $productPackageInformation = null
    ) {
        $this->productNetWeight = $productNetWeight;
        $this->productGrossWeight = $productGrossWeight;
        $this->productWeightUnit = $productWeightUnit;
        $this->productPackageInformation = $productPackageInformation;
    }
}
