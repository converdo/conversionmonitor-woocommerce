<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;
use Converdo\ConversionMonitor\Core\Enumerables\PageType;

class TrackablePage implements Renderable
{
    /**
     * The name of the page.
     *
     * @var string
     */
    protected $name;

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
     * The type of the page.
     *
     * @var PageType
     */
    protected $type;

    /**
     * Set the name of the page.
     *
     * @param  string       $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = trim($name);

        return $this;
    }

    /**
     * Get the name of the page.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

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
            'na' => $this->name(),
            'ur' => $this->url(),
            'ty' => $this->type(),
            'me' => [
                'co' => $this->httpStatusCode(),
                'la' => $this->languageCode(),
            ],
        ];
    }
}