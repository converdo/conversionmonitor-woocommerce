<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Factories\BasePaymentGatewayFactory;
use WC_Payment_Gateway;

class PaymentGatewayFactory extends BasePaymentGatewayFactory
{
    /**
     * The payment gateway instance.
     *
     * @var WC_Payment_Gateway
     */
    protected $gateway;

    /**
     * PaymentGatewayFactory constructor.
     *
     * @param  WC_Payment_Gateway   $gateway
     */
    public function __construct(WC_Payment_Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        return $this->model
                    ->setIdentifier($this->gateway->id)
                    ->setName($this->gateway->get_title())
                    ->setMethod($this->gateway->get_method_title())
                    ->setIsEnabled($this->gateway->enabled);
    }
}