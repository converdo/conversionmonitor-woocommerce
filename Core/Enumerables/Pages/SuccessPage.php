<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Pages;

use Converdo\ConversionMonitor\Core\Enumerables\PageType;

class SuccessPage implements PageType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'SUCCESS';
    }
}