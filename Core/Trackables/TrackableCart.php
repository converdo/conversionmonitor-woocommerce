<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableCart implements Renderable
{
    /**
     * The cart products.
     *
     * @var TrackableProduct[]
     */
    protected $products = [];

    /**
     * The total value of the cart.
     *
     * @var float
     */
    protected $total = 0;

    /**
     * The subtotal value of the cart.
     *
     * @var float
     */
    protected $subtotal = 0;

    /**
     * The tax value of the cart.
     *
     * @var float
     */
    protected $tax = 0;

    /**
     * The shipping value of the cart.
     *
     * @var float
     */
    protected $shipping = 0;

    /**
     * The discount value of the cart.
     *
     * @var float
     */
    protected $discount = 0;

    /**
     * The names of the applied coupons.
     *
     * @var TrackableCoupon[]
     */
    protected $coupons = [];

    /**
     * Set the cart products.
     *
     * @param  array                $products
     * @return $this
     */
    public function setProducts(array $products)
    {
        $this->products = (array) $products;

        return $this;
    }

    /**
     * Add a cart product.
     *
     * @param  TrackableProduct     $product
     * @return $this
     */
    public function addProduct(TrackableProduct $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Get the cart products.
     *
     * @return array
     */
    public function products()
    {
        return $this->products;
    }

    /**
     * Set the total value of the cart.
     *
     * @param  float        $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = round($total, 2);

        return $this;
    }

    /**
     * Get the total value of the cart.
     *
     * @return float
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * Set the subtotal value of the cart.
     *
     * @param  float        $subtotal
     * @return $this
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = round($subtotal, 2);

        return $this;
    }

    /**
     * Get the subtotal value of the cart.
     *
     * @return float
     */
    public function subtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the tax value of the cart.
     *
     * @param  float        $tax
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = round($tax, 2);

        return $this;
    }

    /**
     * Get the tax value of the cart.
     *
     * @return float
     */
    public function tax()
    {
        return $this->tax;
    }

    /**
     * Set the shipping value of the cart.
     *
     * @param  float        $shipping
     * @return $this
     */
    public function setShipping($shipping)
    {
        $this->shipping = round($shipping, 2);

        return $this;
    }

    /**
     * Get the shipping value of the cart.
     *
     * @return float
     */
    public function shipping()
    {
        return $this->shipping;
    }

    /**
     * Set the discount value of the cart.
     *
     * @param  float        $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = round($discount, 2);

        return $this;
    }

    /**
     * Get the discount value of the cart.
     *
     * @return float
     */
    public function discount()
    {
        return $this->discount;
    }

    /**
     * Set the trackable coupon instances.
     *
     * @param  array        $coupons
     * @return $this
     */
    public function setCoupons(array $coupons)
    {
        $this->coupons = (array) $coupons;

        return $this;
    }

    /**
     * Add a trackable coupon instance.
     *
     * @param  TrackableCoupon  $coupon
     * @return $this
     */
    public function addCoupon(TrackableCoupon $coupon)
    {
        $this->coupons[] = $coupon;

        return $this;
    }

    /**
     * Get the trackable coupon instances.
     *
     * @return array
     */
    public function coupons()
    {
        return array_filter($this->coupons);
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'it' => $this->handleProducts(),
            'to' => $this->total(),
            'st' => $this->subtotal(),
            'ta' => $this->tax(),
            'sh' => $this->shipping(),
            'di' => $this->discount(),
            'co' => $this->handleCoupons(),
        ];
    }

    /**
     * Render the cart products.
     *
     * @return array
     */
    protected function handleProducts()
    {
        $products = [];

        foreach ($this->products() as $product) {
            $products[] = [
                'sk' => $product->sku(),
                'pr' => $product->price(),
                'qu' => $product->quantity(),
            ];
        }

        return $products;
    }

    /**
     * Render the cart coupons.
     *
     * @return array
     */
    protected function handleCoupons()
    {
        $coupons = [];

        foreach ($this->coupons() as $coupon) {
            $coupons[] = array_filter($coupon->render());
        }

        return $coupons;
    }
}