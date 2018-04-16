<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackablePaymentGateway implements Renderable
{
    /**
     * The payment gateway identifier.
     *
     * @var string
     */
    protected $identifier;

    /**
     * The payment gateway name.
     *
     * @var string
     */
    protected $name;

    /**
     * The payment gateway method name.
     *
     * @var string
     */
    protected $method;

    /**
     * Determine if the payment gateway is enabled.
     *
     * @var bool
     */
    protected $isEnabled = false;

    /**
     * Set the payment gateway identifier.
     *
     * @param  string       $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get the payment gateway identifier.
     *
     * @return string
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /**
     * Set the payment gateway name.
     *
     * @param  string       $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the payment gateway name.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set the payment gateway method name.
     *
     * @param  string       $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the payment gateway method name.
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Set whether the payment gateway is enabled.
     *
     * @param  bool         $enabled
     * @return $this
     */
    public function setIsEnabled($enabled)
    {
        $this->isEnabled = (bool) $enabled;

        return $this;
    }

    /**
     * Get whether the payment gateway is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'id' => $this->identifier(),
            'na' => $this->name(),
            'me' => $this->method(),
            'en' => $this->isEnabled(),
        ];
    }
}