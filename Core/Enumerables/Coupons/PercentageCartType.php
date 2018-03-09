<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Coupons;

use Converdo\ConversionMonitor\Core\Enumerables\CouponType;

class PercentageCartType implements CouponType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'PERCENTAGE_CART';
    }
}