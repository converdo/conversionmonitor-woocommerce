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
                    ->setIpAddress($this->readServerSafely('REMOTE_ADDR'));
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
}