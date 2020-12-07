<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Office;
use Xi\Netvisor\XmlTestCase;

class OfficeTest extends XmlTestCase
{
    /**
     * @var Office
     */
    private $office;

    public function setUp(): void
    {
        parent::setUp();

        $this->office = new Office(
            'TestOffice'
        );
    }

    /**
     * @test
     */
    public function hasDtd()
    {
        $this->assertNotNull($this->office->getDtdPath());
    }

    /**
     * @test
     */
    public function xmlHasRequiredValues()
    {
        $xml = $this->toXml($this->office->getSerializableObject());

        $this->assertXmlContainsTagWithValue('name', 'TestOffice', $xml);
        $this->assertXmlIsValid($xml, $this->office->getDtdPath());
    }
}
