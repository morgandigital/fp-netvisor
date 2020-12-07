<?php

namespace Xi\Netvisor\Resource\Xml;

class CustomerContactDetails
{
    private $contactName;
    private $contactPerson;
    private $contactPersonEmail;
    private $contactPersonPhone;

    /**
     * @param string $contactName
     * @param string $contactPerson
     * @param string $contactPersonEmail
     * @param string $contactPersonPhone
     */
    public function __construct(
        $contactName,
        $contactPerson,
        $contactPersonEmail,
        $contactPersonPhone
    ) {
        $this->contactName = $contactName;
        $this->contactPerson = $contactPerson;
        $this->contactPersonEmail = $contactPersonEmail;
        $this->contactPersonPhone = $contactPersonPhone;
    }
}
