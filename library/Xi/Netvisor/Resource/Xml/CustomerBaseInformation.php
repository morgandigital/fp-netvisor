<?php

namespace Xi\Netvisor\Resource\Xml;

class CustomerBaseInformation
{
    private $externalIdentifier;
    private $organizationUnitNumber;
    private $name;
    private $nameExtension;
    private $streetAddress;
    private $additionalAddressLine;
    private $city;
    private $postNumber;
    private $country;
    private $customerGroupName;
    private $phonenumber;
    private $faxnumber;
    private $email;
    private $homepageUri;
    private $isActive;
    private $isPrivateCustomer = 1;
    private $emailInvoicingAddress;

    /**
     * @param string $name
     * @param string $streetAddress
     * @param string $city
     * @param string $postNumber
     * @param string $country
     */
    public function __construct(
        $name,
        $streetAddress,
        $city,
        $postNumber,
        $country
    ) {
        $this->name = $name;
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->postNumber = $postNumber;
        $this->country = $country;
    }

    /**
     * @param string $number
     * @return self
     */
    public function setOrganizationUnitNumber($number)
    {
        $this->organizationUnitNumber = $number;
        return $this;
    }

    /**
     * @param string $nameExtension
     * @return self
     */
    public function setNameExtension($nameExtension)
    {
        $this->nameExtension = $nameExtension;
        return $this;
    }

    /**
     * @param string $additionalAddressLine
     * @return self
     */
    public function setAdditionalAddressLine($additionalAddressLine)
    {
        $this->additionalAddressLine = $additionalAddressLine;
        return $this;
    }

    /**
     * @param string $customerGroupName
     * @return self
     */
    public function setCustomerGroupName($customerGroupName)
    {
        $this->customerGroupName = $customerGroupName;
        return $this;
    }

    /**
     * @param string $number
     * @return self
     */
    public function setFaxNumber($number)
    {
        $this->faxNumber = $number;
        return $this;
    }

    /**
     * @param string $uri
     * @return self
     */
    public function setHomepageUri($uri)
    {
        $this->homepageUri = $uri;
        return $this;
    }

    /**
     * @param int $active
     * @return self
     */
    public function setIsActive($active)
    {
        $this->isActive = $active;
        return $this;
    }

    /**
     * @param string $emailInvoicingAddress
     * @return self
     */
    public function setEmailInvoicingAddress($emailInvoicingAddress)
    {
        $this->emailInvoicingAddress = $emailInvoicingAddress;
        return $this;
    }

    /**
     * @param string $number
     * @return self
     */
    public function setPhoneNumber($number)
    {
        $this->phonenumber = $number;
        return $this;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $od
     * @return self
     */
    public function setBusinessId($id)
    {
        $this->externalIdentifier = null;
        $this->isPrivateCustomer = 1;

        if ($id) {
            $this->externalIdentifier = $id;
            $this->isPrivateCustomer = 0;
        }

        return $this;
    }
}
