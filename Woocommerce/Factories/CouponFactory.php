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
        return $this->model
                    ->setCoupon($this->coupon->get_code())
                    ->setAmount($this->cart->get_discount_total())
                    ->setMinimumCartTotal($this->coupon->get_minimum_amount())
                    ->setMaximumCartTotal($this->coupon->get_maximum_amount())
                    ->setFreeShipping($this->coupon->get_free_shipping())
                    ->setType($this->handleCouponType());
    }

    /**
     * Get the coupon type.
     *
     * @return CouponType
     */
    protected function handleCouponType()
    {
        switch (strtolower($this->coupon->get_discount_type())) {
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
}