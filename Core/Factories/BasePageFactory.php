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
        if (! isset($_SERVER['HTTP_HOST'])) {
            return null;
        }

        $path = current(explode('?', (! empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/'), 2));

        $scheme = $this->isHttpsRequest() ? 'https' : 'http';

        return "{$scheme}://{$_SERVER['HTTP_HOST']}{$path}";
    }

    /**
     * Determine if the request is over https.
     *
     * @return bool
     */
    protected function isHttpsRequest()
    {
        return (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https')
            || (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443')
            || (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');
    }
}