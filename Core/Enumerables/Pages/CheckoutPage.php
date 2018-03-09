<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Pages;

use Converdo\ConversionMonitor\Core\Enumerables\PageType;

class CheckoutPage implements PageType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'CHECKOUT';
    }
}