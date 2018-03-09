<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableCategory;

class BaseCategoryFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableCategory
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableCategory
     */
    public function model()
    {
        return new TrackableCategory();
    }
}