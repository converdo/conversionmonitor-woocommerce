<?php

namespace Converdo\ConversionMonitor\Woocommerce\Controllers;

use Converdo\ConversionMonitor\Core\Controllers\BaseInformationController;

class InformationController extends BaseInformationController
{
    /**
     * @inheritdoc
     */
    public function information()
    {
        $plugin = $this->buildPluginInformation();

        $logs = $this->buildLogOutput();

        $gateways = $this->buildPaymentGatewayInformation();

        return array_filter(compact('plugin', 'logs', 'gateways'));
    }

    protected function buildPaymentGatewayInformation()
    {
        if ($this->cannotSeePrivateInformation()) {
            return [];
        }

        $gateways = [];

        foreach (WC()->payment_gateways->get_available_payment_gateways() as $gateway) {
            $gateways[] = cvd_config()->platform()->paymentGateway($gateway)->render();
        }

        return $gateways;
    }
}