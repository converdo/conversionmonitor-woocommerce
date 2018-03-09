<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Orders;

use Converdo\ConversionMonitor\Core\Enumerables\OrderType;

class PendingType implements OrderType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'PENDING';
    }
}