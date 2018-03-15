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
                    ->setSourceUrl(isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null)
                    ->setHttpStatusCode(http_response_code());
    }
}