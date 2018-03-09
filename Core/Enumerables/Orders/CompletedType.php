<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Orders;

use Converdo\ConversionMonitor\Core\Enumerables\OrderType;

class CompletedType implements OrderType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'COMPLETED';
    }
}