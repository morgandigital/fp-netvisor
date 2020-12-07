<?php

namespace Xi\Netvisor\Resource\Xml;

class CustomerAdditionalInformation
{
    private $comment;
    private $customerAgreementIdentifier;
    private $customerReferenceNumber;
    private $invoicingLanguage;
    private $invoicePrintChannelFormat;
    private $yourDefaultReference;
    private $defaultTextBeforeInvoiceLines;
    private $defaultTextAfterInvoiceLines;
    private $defaultPaymentTerm;

    /**
     * @param string $comment
     * @param string $customerAgreementIdentifier
     * @param string $customerReferenceNumber
     * @param string $invoicingLanguage
     * @param string $invoicePrintChannelFormat
     * @param string $yourDefaultReference
     * @param string $defaultTextBeforeInvoiceLines
     * @param string $defaultTextAfterInvoiceLines
     * @param string $defaultPaymentTerm
     */
    public function __construct(
        $comment,
        $customerAgreementIdentifier,
        $customerReferenceNumber,
        $invoicingLanguage,
        $invoicePrintChannelFormat,
        $yourDefaultReference,
        $defaultTextBeforeInvoiceLines,
        $defaultTextAfterInvoiceLines,
        $defaultPaymentTerm
    ) {
        $this->comment = $comment;
        $this->customerAgreementIdentifier = $customerAgreementIdentifier;
        $this->customerReferenceNumber = $customerReferenceNumber;
        $this->invoicingLanguage = $invoicingLanguage;
        $this->invoicePrintChannelFormat = $invoicePrintChannelFormat;
        $this->yourDefaultReference = $yourDefaultReference;
        $this->defaultTextBeforeInvoiceLines = $defaultTextBeforeInvoiceLines;
        $this->defaultTextAfterInvoiceLines = $defaultTextAfterInvoiceLines;
        $this->defaultPaymentTerm = $defaultPaymentTerm;
    }
}
