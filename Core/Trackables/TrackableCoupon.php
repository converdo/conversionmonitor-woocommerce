<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;
use Converdo\ConversionMonitor\Core\Enumerables\CouponType;

class TrackableCoupon implements Renderable
{
    /**
     * The name of the coupon.
     *
     * @var string
     */
    protected $coupon;

    protected $amount;

    protected $minimumCartTotal;

    protected $maximumCartTotal;

    protected $freeShipping = false;

    /**
     * The type of the coupon.
     *
     * @var CouponType
     */
    protected $type;

    /**
     * Set the name of the coupon.
     *
     * @param  string       $coupon
     * @return $this
     */
    public function setCoupon($coupon)
    {
        $this->coupon = trim($coupon);

        return $this;
    }

    /**
     * Get the name of the coupon.
     *
     * @return string
     */
    public function name()
    {
        return $this->coupon;
    }

    /**
     * Set the discount amount of the coupon.
     *
     * @param  float        $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = round($amount, 2);

        return $this;
    }

    /**
     * Get the discount amount of the coupon.
     *
     * @return float
     */
    public function amount()
    {
        return $this->amount;
    }

    /**
     * Set the minimum cart total amount of the coupon.
     *
     * @param  float        $amount
     * @return $this
     */
    public function setMinimumCartTotal($amount)
    {
        $this->minimumCartTotal = round($amount, 2);

        return $this;
    }

    /**
     * Get the minimum cart total amount of the coupon.
     *
     * @return float
     */
    public function minimumCartTotal()
    {
        return $this->minimumCartTotal;
    }

    /**
     * Set the maximum cart total amount of the coupon.
     *
     * @param  float        $amount
     * @return $this
     */
    public function setMaximumCartTotal($amount)
    {
        $this->maximumCartTotal = round($amount, 2);

        return $this;
    }

    /**
     * Get the maximum cart total amount of the coupon.
     *
     * @return float
     */
    public function maximumCartTotal()
    {
        return $this->maximumCartTotal;
    }

    /**
     * Set whether the coupon enables free shipping.
     *
     * @param  bool         $state
     * @return $this
     */
    public function setFreeShipping($state)
    {
        $this->freeShipping = (bool) $state;

        return $this;
    }

    /**
     * Get whether the coupon enables free shipping.
     *
     * @return bool
     */
    public function freeShipping()
    {
        return $this->freeShipping;
    }

    /**
     * Set the type of the coupon.
     *
     * @param  CouponType   $type
     * @return $this
     */
    public function setType(CouponType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the product type instance.
     *
     * @return CouponType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Determine if the given coupon type is the same as the model's coupon type.
     *
     * @param  CouponType   $type
     * @return bool
     */
    public function isOfType(CouponType $type)
    {
        return $this->type instanceof $type;
    }

    /**
     * Get the type of the coupon.
     *
     * @return string
     */
    public function type()
    {
        return $this->type->name();
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'na' => $this->name(),
            'am' => $this->amount(),
            'mi' => $this->minimumCartTotal,
            'ma' => $this->maximumCartTotal(),
            'sh' => $this->freeShipping(),
            'ty' => $this->type()
        ];
    }
}