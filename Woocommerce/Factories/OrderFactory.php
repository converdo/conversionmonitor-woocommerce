<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Enumerables\Orders\CancelledType;
use Converdo\ConversionMonitor\Core\Enumerables\Orders\CompletedType;
use Converdo\ConversionMonitor\Core\Enumerables\Orders\PendingType;
use Converdo\ConversionMonitor\Core\Enumerables\OrderType;
use Converdo\ConversionMonitor\Core\Factories\BaseOrderFactory;
use Converdo\ConversionMonitor\Core\Trackables\TrackableAddress;
use Converdo\ConversionMonitor\Core\Trackables\TrackableCustomer;
use WC_Order;

class OrderFactory extends BaseOrderFactory
{
    /**
     * The order instance.
     *
     * @var WC_Order
     */
    protected $order;

    /**
     * CategoryFactory constructor.
     *
     * @param  WC_Order         $order
     */
    public function __construct(WC_Order $order)
    {
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        return $this->model
                    ->setIdentifier($this->order->get_id())
                    ->setName($this->order->get_order_number())
                    ->setTotal($this->order->get_total('price'))
                    ->setSubtotal($this->order->get_subtotal())
                    ->setShipping($this->order->get_shipping_total())
                    ->setDiscount($this->order->get_discount_total())
                    ->setTax($this->order->get_total_tax())
                    ->setGateway($this->order->get_payment_method())
                    ->setCustomer($this->handleCustomer())
                    ->setType($this->handleOrderType())
                    ->setProducts($this->handleProducts());
    }

    /**
     * Get the order status type.
     *
     * @return OrderType
     */
    protected function handleOrderType()
    {
        switch (strtolower($this->order->get_status())) {
            case 'failed':
            case 'cancelled':
            case 'refunded':
                return new CancelledType();

            case 'on-hold':
            case 'pending':
                return new PendingType();

            case 'processing':
            case 'completed':
            default:
                return new CompletedType();
        }
    }

    /**
     * Get the order products.
     *
     * @return array
     */
    protected function handleProducts()
    {
        $products = [];

        foreach ($this->order->get_items() as $product) {
            $products[] = cvd_config()->platform()->getProductFactory(
                wc_get_product($product->get_product_id()), $product->get_quantity()
            )->call();
        }

        return $products;
    }

    /**
     * Build the customer trackable instance.
     *
     * @return TrackableCustomer
     */
    protected function handleCustomer()
    {
        $billing = new TrackableAddress();
        $billing->setAddress($this->order->get_billing_address_1());
        $billing->setPostal($this->order->get_billing_postcode());
        $billing->setCity($this->order->get_billing_city());
        $billing->setCountry($this->order->get_billing_country());

        $shipping = new TrackableAddress();
        $shipping->setAddress($this->order->get_shipping_address_1());
        $shipping->setPostal($this->order->get_shipping_postcode());
        $shipping->setCity($this->order->get_shipping_city());
        $shipping->setCountry($this->order->get_shipping_country());

        $customer = new TrackableCustomer();
        $customer->setName("{$this->order->get_billing_first_name()} {$this->order->get_billing_last_name()}");
        $customer->setEmail($this->order->get_billing_email());
        $customer->setTelephone($this->order->get_billing_phone());
        $customer->setBillingAddress($billing);
        $customer->setShippingAddress($shipping);

        return $customer;
    }
}