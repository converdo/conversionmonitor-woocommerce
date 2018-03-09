<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableSearch;

class BaseSearchFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableSearch
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableSearch
     */
    public function model()
    {
        return new TrackableSearch();
    }
}