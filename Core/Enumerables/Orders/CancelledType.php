<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Orders;

use Converdo\ConversionMonitor\Core\Enumerables\OrderType;

class CancelledType implements OrderType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'CANCELLED';
    }
}