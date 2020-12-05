<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

class ProductBaseInformation
{
    public const UNIT_PRICE_TYPE_WITH_VAT = 'gross';
    public const UNIT_PRICE_TYPE_WITHOUT_VAT = 'net';

    private $productCode;
    private $productGroup;
    private $name;
    private $description;
    private $unitPrice;
    private $unit;
    private $unitWeight;
    private $kaukevaProductCode;
    private $purchasePrice;
    private $tariffHeading;
    private $comissionPercentage;
    private $isActive;
    private $isSalesProduct;
    private $inventoryEnabled;
    private $countryOfOrigin;

    /**
     * @param string $productCode
     * @param string $productGroup
     * @param string $name
     * @param string $description
     * @param string $unitPrice
     * @param string $unit
     * @param string $unitWeight
     * @param string $kaukevaProductCode
     * @param string $purchasePrice
     * @param string $tariffHeading
     * @param string $comissionPercentage
     * @param string $isActive
     * @param string $isSalesProduct
     * @param string $inventoryEnabled
     * @param string $countryOfOrigin
     */
    public function __construct(
        $productCode = null,
        $productGroup,
        $name,
        $description = null,
        $unitPrice,
        $unit = null,
        $unitWeight = null,
        $kaukevaProductCode = null,
        $purchasePrice = null,
        $tariffHeading = null,
        $comissionPercentage = null,
        $isActive,
        $isSalesProduct,
        $inventoryEnabled = null,
        $countryOfOrigin = null
    ) {
        $this->productCode = $productCode;
        $this->productGroup = $productGroup;
        $this->name = $name;
        $this->description = $description;
        $this->unitPrice = new AttributeElement(
            $unitPrice, array('type' => self::UNIT_PRICE_TYPE_WITHOUT_VAT)
        );
        $this->unit = $unit;
        $this->unitWeight = $unitWeight;
        $this->kaukevaProductCode = $kaukevaProductCode;
        $this->purchasePrice = $purchasePrice;
        $this->tariffHeading = $tariffHeading;
        $this->comissionPercentage = $comissionPercentage;
        $this->isActive = $isActive;
        $this->isSalesProduct = $isSalesProduct;
        $this->inventoryEnabled = $inventoryEnabled;
        $this->countryOfOrigin = new AttributeElement(
            $countryOfOrigin, array('type' => 'ISO-3166')
        );
    }

    /**
     * @param string $type
     * @return self
     */
    public function setUnitPriceType($type)
    {
        $this->unitPrice->setAttribute('type', $type);
        return $this;
    }
}
