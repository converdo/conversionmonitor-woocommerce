<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Coupons;

use Converdo\ConversionMonitor\Core\Enumerables\CouponType;

class PercentageProductType implements CouponType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'PERCENTAGE_PRODUCT';
    }
}