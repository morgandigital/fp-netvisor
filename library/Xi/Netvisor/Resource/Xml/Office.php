<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\Root;

class Office extends Root
{
    private $name;
    private $phoneNumber;
    private $teleFaxNumber;
    private $officeContactAddress;
    private $officeVisitAddress;
    private $officeFinvoiceDetails;

    public function __construct(
        $name,
        $phoneNumber = null,
        $teleFaxNumber = null,
        OfficeContactAddress $officeContactAddress = null,
        OfficeVisitAddress $officeVisitAddress = null,
        OfficeFinvoiceDetails $officeFinvoiceDetails = null
    ) {
        parent::__construct();

        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->teleFaxNumber = $teleFaxNumber;
        $this->officeContactAddress = $officeContactAddress;
        $this->officeVisitAddress = $officeVisitAddress;
        $this->officeFinvoiceDetails = $officeFinvoiceDetails;
    }

    public function getDtdPath()
    {
        return $this->getDtdFile('office.dtd');
    }

    protected function getXmlName()
    {
        return 'office';
    }
}
