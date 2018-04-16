<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableVisitor implements Renderable
{
    /**
     * The referrer URL of the visitor.
     *
     * @var string
     */
    protected $referrerUrl;

    /**
     * The user agent string of the visitor.
     *
     * @var string
     */
    protected $userAgent;

    /**
     * The ip address of the visitor.
     *
     * @var string
     */
    protected $ipAddress;

    /**
     * Determine if the visitor is browsing via a proxy.
     *
     * @var bool
     */
    protected $isProxy = false;

    /**
     * Set the referrer URL of the visitor.
     *
     * @param  string       $url
     * @return $this
     */
    public function setReferrerUrl($url)
    {
        $this->referrerUrl = (string) $url;

        return $this;
    }

    /**
     * Get the referrer URL of the visitor.
     *
     * @return string
     */
    public function referrer()
    {
        return $this->referrerUrl;
    }

    /**
     * Set the user agent string of the visitor.
     *
     * @param  string       $userAgent
     * @return $this
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string) $userAgent;

        return $this;
    }

    /**
     * Get the user agent string of the visitor.
     *
     * @return string
     */
    public function userAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set the ip address of the visitor.
     *
     * @param  string       $ip
     * @return $this
     */
    public function setIpAddress($ip)
    {
        $this->ipAddress = (string) $ip;

        return $this;
    }

    /**
     * Get the ip address of the visitor.
     *
     * @return string
     */
    public function ip()
    {
        return $this->ipAddress;
    }

    /**
     * Set whether the visitor is browsing via a proxy.
     *
     * @param  bool         $proxy
     * @return $this
     */
    public function setIsProxy($proxy)
    {
        $this->isProxy = (bool) $proxy;

        return $this;
    }

    /**
     * Get whether the visitor is browsing via a proxy.
     *
     * @return bool
     */
    public function isProxy()
    {
        return $this->isProxy;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'ur' => $this->referrer(),
            'ua' => $this->userAgent(),
            'ip' => $this->ip(),
            'pr' => $this->isProxy(),
        ];
    }
}