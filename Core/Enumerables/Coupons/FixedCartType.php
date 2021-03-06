<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Coupons;

use Converdo\ConversionMonitor\Core\Enumerables\CouponType;

class FixedCartType implements CouponType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'FIXED_CART';
    }
}