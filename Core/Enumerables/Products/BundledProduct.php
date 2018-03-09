<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Products;

use Converdo\ConversionMonitor\Core\Enumerables\ProductType;

class BundledProduct implements ProductType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'BUNDLED';
    }
}