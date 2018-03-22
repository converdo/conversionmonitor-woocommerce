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
                    ->setUrl($this->handleRequestUrl())
                    ->setHttpStatusCode(http_response_code());
    }

    /**
     * Build the requested page URL, ignore query parameters.
     *
     * @return string
     */
    protected function handleRequestUrl()
    {
        $path = current(explode('?', $_SERVER['REQUEST_URI'], 2));

        return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$path}";
    }
}