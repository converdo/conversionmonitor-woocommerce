<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Factories\BaseCartFactory;
use Converdo\ConversionMonitor\Core\Trackables\TrackableCoupon;
use Converdo\ConversionMonitor\Core\Trackables\TrackableProduct;
use WC_Cart;
use WC_Coupon;

class CartFactory extends BaseCartFactory
{
    /**
     * The cart instance.
     *
     * @var WC_Cart
     */
    protected $cart;

    /**
     * CartFactory constructor.
     *
     * @param  WC_Cart          $cart
     */
    public function __construct(WC_Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        $this->model->setProducts($this->handleProducts())
                    ->setCoupons($this->handleCoupons());

        $this->setPrices();

        return $this->model;
    }

    /**
     * Handle the cart product instances.
     *
     * @return TrackableProduct[]
     */
    protected function handleProducts()
    {
        $products = [];

        foreach ($this->cart->get_cart() as $product) {
            $products[] = (new ProductFactory($product['data'], $product['quantity']))->call();
        }

        return $products;
    }

    /**
     * Handle the cart coupon instances.
     *
     * @return TrackableCoupon[]
     */
    protected function handleCoupons()
    {
        $coupons = [];

        foreach ($this->cart->get_applied_coupons() as $coupon) {
            $coupons[] = cvd_config()->platform()->coupon($this->cart, new WC_Coupon($coupon));
        }

        return $coupons;
    }

    /**
     * Set the product prices.
     *
     * @return void
     */
    protected function setPrices()
    {
        global $woocommerce;

        // We're dealing with Woocommerce 3.0.0 or later.
        if (version_compare($woocommerce->version, '3.0.0', '>=')) {
            $this->model->setTotal($this->cart->get_total('price'))
                        ->setSubtotal($this->cart->get_subtotal())
                        ->setShipping($this->cart->get_shipping_total())
                        ->setDiscount($this->cart->get_discount_total())
                        ->setTax($this->cart->get_total_tax());

            // We're dealing with an older version of Woocommerce.
        } else {
            $this->model->setTotal($this->cart->total)
                        ->setSubtotal($this->cart->subtotal)
                        ->setShipping($this->cart->shipping_total)
                        ->setDiscount($this->cart->discount_cart)
                        ->setTax($this->cart->tax_total);
        }
    }
}