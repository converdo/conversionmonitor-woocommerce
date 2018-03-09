<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Enumerables\Orders\CancelledType;
use Converdo\ConversionMonitor\Core\Enumerables\Orders\CompletedType;
use Converdo\ConversionMonitor\Core\Enumerables\Orders\PendingType;
use Converdo\ConversionMonitor\Core\Enumerables\OrderType;
use Converdo\ConversionMonitor\Core\Factories\BaseOrderFactory;
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
                    ->setSubtotal($this->order->get_subtotal())
                    ->setTotal($this->order->get_total('price'))
                    ->setTax($this->order->get_total_tax())
                    ->setShipping($this->order->get_shipping_total())
                    ->setDiscount($this->order->get_discount_total())
                    ->setGateway($this->order->get_payment_method_title())
                    ->setCustomerIp($this->order->get_customer_ip_address())
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
            $products[] = cvd_config()->platform()->getProductFactory(wc_get_product($product->get_product_id()))->call();
        }

        return $products;
    }
}