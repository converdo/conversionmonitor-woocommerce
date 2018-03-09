<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Products;

use Converdo\ConversionMonitor\Core\Enumerables\ProductType;

class DownloadableProduct implements ProductType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'DOWNLOADABLE';
    }
}