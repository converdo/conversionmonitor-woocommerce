<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;
use Converdo\ConversionMonitor\Core\Enumerables\PageType;

class TrackablePage implements Renderable
{
    /**
     * The url of the page.
     *
     * @var string
     */
    protected $url;

    /**
     * The http status code of the page.
     *
     * @var int
     */
    protected $httpStatusCode;

    /**
     * The ISO 639-1 language code of the page.
     *
     * @var string
     */
    protected $languageCode;

    /**
     * The source URL of the visitor.
     *
     * @var string
     */
    protected $sourceUrl;

    /**
     * The type of the page.
     *
     * @var PageType
     */
    protected $type;

    /**
     * Set the url of the page.
     *
     * @param  string       $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = trim($url);

        return $this;
    }

    /**
     * Get the url of the page.
     *
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * Set the http status code of the page.
     *
     * @param  int          $httpStatusCode
     * @return $this
     */
    public function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode = (int) $httpStatusCode;

        return $this;
    }

    /**
     * Get the http status code of the page.
     *
     * @return int
     */
    public function httpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Set the language code of the page.
     *
     * @param  string       $languageCode
     * @return $this
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = (string) $languageCode;

        return $this;
    }

    /**
     * Get the language code of the page.
     *
     * @return string
     */
    public function languageCode()
    {
        return $this->languageCode;
    }

    /**
     * Set the source URL of the visitor.
     *
     * @param  string       $url
     * @return $this
     */
    public function setSourceUrl($url)
    {
        $this->sourceUrl = $url;

        return $this;
    }

    /**
     * Get the source URL of the visitor.
     *
     * @return string
     */
    public function source()
    {
        return $this->sourceUrl;
    }

    /**
     * Set the type of the page.
     *
     * @param  PageType     $type
     * @return $this
     */
    public function setType(PageType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the page type instance.
     *
     * @return PageType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Determine if the given page type is the same as the model's page type.
     *
     * @param  PageType     $type
     * @return bool
     */
    public function isOfType(PageType $type)
    {
        return $this->type instanceof $type;
    }

    /**
     * Get the type of the page.
     *
     * @return string
     */
    public function type()
    {
        return $this->type->name();
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'ur' => $this->url(),
            'su' => $this->source(),
            'ty' => $this->type(),
            'me' => [
                'co' => $this->httpStatusCode(),
                'la' => $this->languageCode(),
            ],
        ];
    }
}