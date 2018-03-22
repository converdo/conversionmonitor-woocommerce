<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;
use Converdo\ConversionMonitor\Core\Enumerables\OrderType;

class TrackableOrder implements Renderable
{
    /**
     * The identifier of the order.
     *
     * @var string
     */
    protected $identifier;

    /**
     * The total value of the cart.
     *
     * @var float
     */
    protected $total;

    /**
     * The subtotal value of the cart.
     *
     * @var float
     */
    protected $subtotal;

    /**
     * The tax value of the cart.
     *
     * @var float
     */
    protected $tax;

    /**
     * The shipping value of the cart.
     *
     * @var float
     */
    protected $shipping;

    /**
     * The discount value of the cart.
     *
     * @var float
     */
    protected $discount;

    /**
     * The status type of the order.
     *
     * @var OrderType
     */
    protected $type;

    /**
     * The payment gateway of the order.
     *
     * @var string
     */
    protected $gateway;

    /**
     * The customer ip of the order.
     *
     * @var string
     */
    protected $ip;

    /**
     * The products of the order.
     *
     * @var array
     */
    protected $products = [];

    /**
     * Set the identifier of the order.
     *
     * @param  string       $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = (string) $identifier;

        return $this;
    }

    /**
     * Get the identifier of the order.
     *
     * @return string
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * Set the total value of the order.
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
     * Get the total value of the order.
     *
     * @return float
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * Set the subtotal value of the order.
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
     * Get the subtotal value of the order.
     *
     * @return float
     */
    public function subtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set the tax value of the order.
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
     * Get the tax value of the order.
     *
     * @return float
     */
    public function tax()
    {
        return $this->tax;
    }

    /**
     * Set the shipping value of the order.
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
     * Get the shipping value of the order.
     *
     * @return float
     */
    public function shipping()
    {
        return $this->shipping;
    }

    /**
     * Set the discount value of the order.
     *
     * @param  float        $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = round(abs($discount), 2);

        return $this;
    }

    /**
     * Get the discount value of the order.
     *
     * @return float
     */
    public function discount()
    {
        return $this->discount;
    }

    /**
     * Set the payment gateway of the order.
     *
     * @param  string       $gateway
     * @return $this
     */
    public function setGateway($gateway)
    {
        $this->gateway = (string) $gateway;

        return $this;
    }

    /**
     * Get the payment gateway of the order.
     *
     * @return string
     */
    public function gateway()
    {
        return $this->gateway;
    }

    /**
     * Set the customer ip of the order.
     *
     * @param  string       $ip
     * @return $this
     */
    public function setCustomerIp($ip)
    {
        $this->ip = (string) $ip;

        return $this;
    }

    /**
     * Get the customer ip of the order.
     *
     * @return string
     */
    public function ip()
    {
        return $this->ip;
    }

    /**
     * Set the status type of the order.
     *
     * @param  OrderType    $type
     * @return $this
     */
    public function setType(OrderType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the order status type instance.
     *
     * @return OrderType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Determine if the given order status type is the same as the model's order status type.
     *
     * @param  OrderType    $type
     * @return bool
     */
    public function isOfType(OrderType $type)
    {
        return $this->type instanceof $type;
    }

    /**
     * Get the order status type of the product.
     *
     * @return string
     */
    public function type()
    {
        return $this->type->name();
    }

    /**
     * Set the trackable product instances.
     *
     * @param  array        $products
     * @return $this
     */
    public function setProducts(array $products)
    {
        $this->products = (array) $products;

        return $this;
    }

    /**
     * Add a trackable product instance.
     *
     * @param  TrackableProduct $product
     * @return $this
     */
    public function addProduct(TrackableProduct $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Get the trackable product instances.
     *
     * @return array
     */
    public function products()
    {
        return array_filter($this->products);
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'id' => $this->identifier(),
            'to' => $this->total(),
            'st' => $this->subtotal(),
            'di' => $this->discount(),
            'sh' => $this->shipping(),
            'ta' => $this->tax(),
            'gn' => $this->gateway(),
            'ip' => $this->ip(),
            'ty' => $this->type(),
            'pr' => $this->handleProducts(),
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
            ];
        }

        return $products;
    }
}