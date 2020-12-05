<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Product;
use Xi\Netvisor\Resource\Xml\ProductBaseInformation;
use Xi\Netvisor\XmlTestCase;

class ProductTest extends XmlTestCase
{
    /**
     * @var Customer
     */
    private $product;

    /**
     * @var ProductBaseInformation
     */
    private $baseInformation;

    public function setUp(): void
    {
        parent::setUp();

        $this->baseInformation = new ProductBaseInformation(
            null,
            'TestProductGroup',
            'TestProduct',
            null,
            '100,25',
            null,
            null,
            null,
            null,
            null,
            null,
            '1',
            '1',
            'FI'
        );

        $this->product = new Product(
            $this->baseInformation
        );
    }

    /**
     * @test
     */
    public function hasDtd()
    {
        $this->assertNotNull($this->product->getDtdPath());
    }

    /**
     * @test
     */
    public function xmlHasRequiredValues()
    {
        $xml = $this->toXml($this->product->getSerializableObject());

        $this->assertXmlContainsTagWithValue('name', 'TestProduct', $xml);
        $this->assertXmlIsValid($xml, $this->product->getDtdPath());
    }
}
