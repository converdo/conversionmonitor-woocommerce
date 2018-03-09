<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Products;

use Converdo\ConversionMonitor\Core\Enumerables\ProductType;

class SimpleProduct implements ProductType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'SIMPLE';
    }
}