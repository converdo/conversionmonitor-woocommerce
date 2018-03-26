<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableVisitor;

class BaseVisitorFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableVisitor
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableVisitor
     */
    public function model()
    {
        return new TrackableVisitor();
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        return $this->model
                    ->setReferrerUrl($this->readServerSafely('HTTP_REFERER'))
                    ->setUserAgent($this->readServerSafely('HTTP_USER_AGENT'))
                    ->setIpAddress($this->readServerSafely('REMOTE_ADDR'))
                    ->setIsProxy($this->handleProxyVisit());
    }

    /**
     * Get a value from the server variable safely.
     *
     * @param  string           $variable
     * @return string|null
     */
    protected function readServerSafely($variable)
    {
        return isset($_SERVER[$variable]) ? $_SERVER[$variable] : null;
    }

    /**
     * Determine if the current visit is from a proxy server.
     *
     * @return bool
     */
    protected function handleProxyVisit()
    {
        $headers = [
            'CLIENT_IP', 'FORWARDED', 'FORWARDED_FOR', 'FORWARDED_FOR_IP', 'HTTP_CLIENT_IP', 'HTTP_FORWARDED',
            'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED_FOR_IP', 'HTTP_PROXY_CONNECTION', 'HTTP_VIA', 'VIA',
            'HTTP_X_FORWARDED', 'HTTP_X_FORWARDED_FOR', 'X_FORWARDED', 'X_FORWARDED_FOR',
        ];

        foreach ($headers as $header) {
            if ($this->readServerSafely($header)) {
                return true;
            }
        }

        return false;
    }
}