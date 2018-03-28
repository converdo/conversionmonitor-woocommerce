<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableCustomer implements Renderable
{
    /**
     * The name of the customer.
     *
     * @var string
     */
    protected $name;

    /**
     * The email address of the customer.
     *
     * @var string
     */
    protected $email;

    /**
     * The telephone number of the customer.
     *
     * @var string|null
     */
    protected $telephone;

    /**
     * The billing address of the customer.
     *
     * @var TrackableAddress|null
     */
    protected $billing;

    /**
     * The shipping address of the customer.
     *
     * @var TrackableAddress|null
     */
    protected $shipping;

    /**
     * Set the name of the customer.
     *
     * @param  string       $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = trim($name);

        return $this;
    }

    /**
     * Get the name of the customer.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set the email address of the customer.
     *
     * @param  string       $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the email address of the customer.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Set the telephone number of the customer.
     *
     * @param  string       $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the telephone number of the customer.
     *
     * @return string
     */
    public function telephone()
    {
        return $this->telephone;
    }

    /**
     * Set the billing address of the customer.
     *
     * @param  TrackableAddress     $address
     * @return $this
     */
    public function setBillingAddress(TrackableAddress $address)
    {
        $this->billing = $address;

        return $this;
    }

    /**
     * Get the billing address of the customer.
     *
     * @return TrackableAddress|null
     */
    public function billing()
    {
        return $this->billing;
    }

    /**
     * Set the shipping address of the customer.
     *
     * @param  TrackableAddress     $address
     * @return $this
     */
    public function setShippingAddress(TrackableAddress $address)
    {
        $this->shipping = $address;

        return $this;
    }

    /**
     * Get the shipping address of the customer.
     *
     * @return TrackableAddress|null
     */
    public function shipping()
    {
        return $this->shipping;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'na' => $this->name(),
            'em' => $this->email(),
            'te' => $this->telephone(),
            'bi' => $this->billing()->render(),
            'sh' => $this->shipping()->render(),
        ];
    }
}