<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Enumerables\Coupons\FixedCartType;
use Converdo\ConversionMonitor\Core\Enumerables\Coupons\FixedProductType;
use Converdo\ConversionMonitor\Core\Enumerables\Coupons\PercentageCartType;
use Converdo\ConversionMonitor\Core\Enumerables\Coupons\PercentageProductType;
use Converdo\ConversionMonitor\Core\Enumerables\CouponType;
use Converdo\ConversionMonitor\Core\Factories\BaseCouponFactory;
use WC_Cart;
use WC_Coupon;

class CouponFactory extends BaseCouponFactory
{
    /**
     * The cart instance.
     *
     * @var WC_Cart
     */
    protected $cart;

    /**
     * The coupon instance.
     *
     * @var WC_Coupon
     */
    protected $coupon;

    /**
     * CouponFactory constructor.
     *
     * @param  WC_Cart          $cart
     * @param  WC_Coupon        $coupon
     */
    public function __construct(WC_Cart $cart, WC_Coupon $coupon)
    {
        $this->cart = $cart;

        $this->coupon = $coupon;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        $this->model->setFreeShipping($this->coupon->enable_free_shipping());

        $this->handleVersions();

        return $this->model;
    }

    /**
     * Get the coupon type.
     *
     * @param  string           $type
     * @return CouponType
     */
    protected function handleCouponType($type)
    {
        switch (strtolower($type)) {
            case 'fixed_product':
                return new FixedProductType();
            case 'fixed_cart':
                return new FixedCartType();
            case 'percent':
                return new PercentageCartType();
            default:
                return new PercentageProductType();
        }
    }

    /**
     * Set properties for the model in different Woocommerce versions.
     *
     * @return void
     */
    protected function handleVersions()
    {
        global $woocommerce;

        // We're dealing with Woocommerce 3.0.0 or later.
        if (version_compare($woocommerce->version, '3.0.0', '>=')) {
            $this->model->setType($this->handleCouponType($this->coupon->get_discount_type()))
                ->setCoupon($this->coupon->get_code())
                ->setAmount($this->cart->get_discount_total())
                ->setMinimumCartTotal($this->coupon->get_minimum_amount())
                ->setMaximumCartTotal($this->coupon->get_maximum_amount());

            // We're dealing with an older version of Woocommerce.
        } else {
            $this->model->setType($this->handleCouponType($this->coupon->discount_type))
                ->setCoupon($this->coupon->code)
                ->setAmount($this->cart->discount_cart)
                ->setMinimumCartTotal($this->coupon->minimum_amount)
                ->setMaximumCartTotal($this->coupon->maximum_amount);
        }
    }
}