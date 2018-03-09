<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackablePage;

class BasePageFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackablePage
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackablePage
     */
    public function model()
    {
        return new TrackablePage();
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        return $this->model
                    ->setHttpStatusCode(http_response_code());
    }
}