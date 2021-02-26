<?php
namespace Xi\Netvisor;

use DateTime;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use Xi\Netvisor\Config;
use Xi\Netvisor\Component\Request;
use Xi\Netvisor\Exception\NetvisorException;
use Xi\Netvisor\Component\Validate;
use Xi\Netvisor\Resource\Xml\Component\Root;
use JMS\Serializer\Serializer;
use Xi\Netvisor\Resource\Xml\Customer;
use Xi\Netvisor\Resource\Xml\SalesInvoice;
use Xi\Netvisor\Resource\Xml\PurchaseInvoice;
use Xi\Netvisor\Resource\Xml\PurchaseInvoiceState;
use Xi\Netvisor\Resource\Xml\Voucher;
use Xi\Netvisor\Resource\Xml\Product;
use Xi\Netvisor\Resource\Xml\Office;
use Xi\Netvisor\Serializer\Naming\LowercaseNamingStrategy;

/**
 * Connects to Netvisor-interface via HTTP.
 * Authentication is based on HTTP headers.
 * A single XML file is sent to the server.
 * The server returns a XML response that contains the transaction status.
 *
 * @category Xi
 * @package  Netvisor
 * @author   Panu Leppäniemi <me@panuleppaniemi.com>
 * @author   Henri Vesala    <henri.vesala@gmail.fi>
 * @author   Petri Koivula   <petri.koivula@iki.fi>
 * @author   Artur Gajewski  <info@arturgajewski.com>
 */
class Netvisor
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Validate
     */
    private $validate;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Initialize with Netvisor::build()
     *
     * @param Client   $client
     * @param Config   $config
     * @param Validate $validate
     */
    public function __construct(
        Client $client,
        Config $config,
        Validate $validate
    ) {
        $this->client     = $client;
        $this->config     = $config;
        $this->validate   = $validate;
        $this->serializer = $this->createSerializer();
    }

    /**
     * Builds a default instance of this class.
     *
     * @param  Config   $config
     * @return Netvisor
     */
    public static function build(Config $config)
    {
        return new Netvisor(new Client(), $config, new Validate());
    }

    /**
     * @param  SalesInvoice $invoice
     * @param  String       $language
     * @return null|string
     */
    public function sendInvoice(SalesInvoice $invoice, $language = null)
    {
        return $this->requestWithBody($invoice, 'salesinvoice', array(), $language);
    }

    /**
     * @param Customer $customer
     * @return null|string
     */
    public function sendCustomer(Customer $customer)
    {
        return $this->requestWithBody($customer, 'customer', ['method' => 'add']);
    }

    /**
     * @param Voucher $voucher
     * @return null|string
     */
    public function sendVoucher(Voucher $voucher)
    {
        return $this->requestWithBody($voucher, 'accounting');
    }

    /**
     * @param PurchaseInvoice $invoice
     * @return null|string
     */
    public function sendPurchaseInvoice(PurchaseInvoice $invoice)
    {
        return $this->requestWithBody($invoice, 'purchaseinvoice');
    }

    /**
     * @param PurchaseInvoiceState $state
     * @return null|string
     */
    public function updatePurchaseInvoiceState(PurchaseInvoiceState $state)
    {
        return $this->requestWithBody($state, 'purchaseinvoicepostingdata');
    }

    /**
     * @param Customer $customer
     * @param int $id
     * @return null|string
     */
    public function updateCustomer(Customer $customer, int $id)
    {
        return $this->requestWithBody(
            $customer,
            'customer',
            [
                'method' => 'edit',
                'id' => $id,
            ]
        );
    }

    /**
     * @param Office $office
     * @param int $customer_id Customer netvisor key
     * @return null|string
     */
    public function sendOffice(Office $office, int $customer_id)
    {
        return $this->requestWithBody($office, 'office', ['method' => 'add', 'customer_id' => $customerid]);
    }

    /**
     * @param Office $office
     * @param int $customer_id Customer netvisor key
     * @param int $id Office netvisor key
     * @return null|string
     */
    public function updateOffice(Office $office, int $customer_id, int $id)
    {
        return $this->requestWithBody(
            $office,
            'office',
            [
                'method' => 'edit',
                'customerid' => $customer_id,
                'officeid' => $id,
            ]
        );
    }

    /**
     * @param SalesInvoice $invoice
     * @param int $id
     * @return null|string
     */
    public function updateInvoice(SalesInvoice $invoice, int $id)
    {
        return $this->requestWithBody(
            $invoice,
            'salesinvoice',
            [
                'method' => 'edit',
                'id' => $id,
            ]
        );
    }

    /**
     * List customers, optionally filtered by a keyword.
     *
     * The keyword matches Netvisor fields
     * Name, Customer Code, Organization identifier, CoName
     *
     * @param null|string $keyword
     * @return null|string
     */
    public function getCustomers($keyword = null)
    {
        return $this->get(
            'customerlist',
            [
                'keyword' => $keyword,
            ]
        );
    }

    /**
     * List customers that have changed since given date.
     *
     * Giving a keyword would override the changed since parameter.
     *
     * @param DateTime $changedSince
     * @return null|string
     */
    public function getCustomersChangedSince(DateTime $changedSince)
    {
        return $this->get(
            'customerlist',
            [
                'changedsince' => $changedSince->format('Y-m-d'),
            ]
        );
    }

    /**
     * Get details for a customer identified by Netvisor id.
     *
     * @param int $id
     * @return null|string
     */
    public function getCustomer($id)
    {
        return $this->get(
            'getcustomer',
            [
                'id' => $id,
            ]
        );
    }

    /**
     * List products.
     *
     * @return null|string
     */
    public function getProducts()
    {
        return $this->get(
            'productlist',
        );
    }

    /**
     * List products that have changed since given date.
     *
     * Giving a keyword would override the changed since parameter.
     *
     * @param DateTime $changedSince
     * @return null|string
     */
    public function getProductsChangedSince(DateTime $changedSince)
    {
        return $this->get(
            'productlist',
            [
                'changedsince' => $changedSince->format('Y-m-d'),
            ]
        );
    }

    /**
     * Get details for a product identified by Netvisor id.
     *
     * @param int $id
     * @return null|string
     */
    public function getProduct($id)
    {
        return $this->get(
            'getproduct',
            [
                'id' => $id,
            ]
        );
    }

    /**
     * @param Product $product
     * @return null|string
     */
    public function sendProduct(Product $product)
    {
        return $this->requestWithBody($product, 'product', ['method' => 'add']);
    }

    /**
     * @param Product $product
     * @param int $id
     * @return null|string
     */
    public function updateProduct(Product $product, int $id)
    {
        return $this->requestWithBody(
            $product,
            'product',
            [
                'method' => 'edit',
                'id' => $id,
            ]
        );
    }

    /**
     * List sales invoices.
     *
     * @param string $listtype 'preinvoice' for order list
     * @return null|string
     */
    public function getSalesInvoices($listtype = '')
    {
        return $this->get(
            'salesinvoicelist',
            [
                'ListType' => $listtype,
            ]
        );
    }

    /**
     * Get inventory by warehouse.
     *
     * @param int $product_id List by product netvisor key
     * @param int $warehouse_id List by warehouse id
     * @return null|string
     */
    public function getInventoryByWarehouse($product_id = '', $warehouse_id = '')
    {
        return $this->get(
            'inventorybywarehouse',
            [
                'productid' => $product_id,
                'inventoryplaceid' => $warehouse_id
            ]
        );
    }

    /**
     * List sales personnel.
     *
     * @return null|string
     */
    public function getSalesPersonnelList()
    {
        return $this->get(
            'salespersonnellist'
        );
    }

    /**
     * List sales invoices modified since given date.
     *
     * @param DateTime $modifiedSince
     * @param string $listtype 'preinvoice' for order list
     * @return null|string
     */
    public function getSalesInvoicesModifiedSince(\DateTime $modifiedSince, $listtype = '')
    {
        return $this->get(
            'salesinvoicelist',
            [
                'ListType' => $listtype,
                'lastmodifiedstart' => $modifiedSince->format('Y-m-d'),
            ]
        );
    }

    /**
     * Get details for a invoice identified by Netvisor id.
     *
     * @param int $id
     * @return null|string
     */
    public function getSalesInvoice($id)
    {
        return $this->get(
            'getsalesinvoice',
            [
                'netvisorkey' => $id,
            ]
        );
    }

    /**
     * Get details for a invoices identified by Netvisor id.
     *
     * @param int $id
     * @return null|string
     */
    public function getPurchaseInvoice($id)
    {
        return $this->get(
            'getpurchaseinvoice',
            [
                'netvisorkey' => $id,
            ]
        );
    }

    /**
     * Get vouchers by timeframe
     *
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return null|string
     */
    public function getVouchers(\DateTime $startDate, \DateTime $endDate)
    {
        return $this->get(
            'accountingledger',
            [
                'startdate' => $startDate->format('Y-m-d'),
                'enddate' => $endDate->format('Y-m-d'),
            ]
        );
    }

    /**
     * Get details for a certain voucher from timeframe identified by Netvisor id.
     *
     * @param int $id
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return null|string
     */
    public function getVoucher($id, \DateTime $startDate, \DateTime $endDate)
    {
        $response = new \SimpleXMLElement($this->getVouchers($startDate, $endDate));
        
        foreach ($response->Vouchers->children() as $voucher) {
            if ((int) $voucher->NetvisorKey === (int) $id) {
                return $voucher->asXml();
            }
        }

        return null;
    }

    /**
     * @param string  $service
     * @param array   $params
     * @return null|string
     */
    protected function get($service, array $params = [])
    {
        if (!$this->config->isEnabled()) {
            return null;
        }

        $request = new Request($this->client, $this->config);

        return $request->get($service, $params);
    }

    /**
     * Update sales invoice status.
     *
     * @param string $netvisor_key Invoice Netvisor ID
     * @param string $netvisor_key_list Invoices Netvisor ID list separated with comma
     * @param string $status To which status invoice/invoices will be set
     * @return null|string
     */
    public function updateSalesInvoiceStatus($netvisor_key, $netvisor_key_list, $status)
    {
        return $this->get(
            'updatesalesinvoicestatus',
            [
                'netvisorkey' => $netvisor_key,
                'netvisorkeylist' => $netvisor_key_list,
                'status' => $status,
            ]
        );
    }

    /**
     * @param  Root              $root
     * @param  string            $service
     * @param  array             $params
     * @param  string            $language
     * @return null|string
     * @throws NetvisorException
     */
    public function requestWithBody(Root $root, $service, array $params = [], $language = null)
    {
        if (!$this->config->isEnabled()) {
            return null;
        }

        $xml = $this->serializer->serialize($root->getSerializableObject(), 'xml');

        if (!$this->validate->isValid($xml, $root->getDtdPath())) {
            throw new NetvisorException('XML is not valid according to DTD');
        }

        if ($language !== null) {
            $this->config->setLanguage($language);
        }

        $request = new Request($this->client, $this->config);

        return $request->post($this->processXml($xml), $service, $params);
    }

    /**
     * @return Serializer
     */
    private function createSerializer()
    {
        $builder = SerializerBuilder::create();
        $builder->setPropertyNamingStrategy(new LowercaseNamingStrategy());

        return $builder->build();
    }

    /**
     * Process given XML into Netvisor specific format
     *
     * @param  string $xml
     * @return string
     */
    public function processXml($xml)
    {
        $xml = str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n", "", $xml);

        return $xml;
    }
}
