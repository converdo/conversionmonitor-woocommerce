<?php

namespace Converdo\ConversionMonitor\Core\Support;

class TrackableCollection
{
    /**
     * Render all data sets.
     *
     * @return array
     */
    public function all()
    {
        return array_filter([
            '_p' => array_filter($this->page()),
            '_m' => array_filter($this->model()),
            '_v' => array_filter($this->visitor()),
            '_c' => array_filter($this->cart()),
        ]);
    }

    /**
     * Build the page data.
     *
     * @return array
     */
    protected function page()
    {
        if (! cvd_config()->platform()->isPage()) {
            return [];
        }

        return cvd_config()->platform()->page()->render();
    }

    /**
     * Build the visitor data.
     *
     * @return array
     */
    protected function visitor()
    {
        return cvd_config()->platform()->visitor()->render();
    }

    /**
     * Build the cart data.
     *
     * @return array
     */
    protected function cart()
    {
        if (! cvd_config()->platform()->hasCart()) {
            return [];
        }

        return cvd_config()->platform()->cart()->render();
    }

    /**
     * Build the model data.
     *
     * @return array
     */
    protected function model()
    {
        if (cvd_config()->platform()->isSearch()) {
            return cvd_config()->platform()->search()->render();
        }

        if (cvd_config()->platform()->isCategory()) {
            return cvd_config()->platform()->category()->render();
        }

        if (cvd_config()->platform()->isProduct()) {
            return cvd_config()->platform()->product()->render();
        }

        return [];
    }

    /**
     * Render the data as json string.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->all());
    }

    /**
     * Render the data as encrypted string.
     *
     * @return string
     */
    public function toEncryptedString()
    {
        return cvd_config()->crypt()->encrypt($this->toJson());
    }
}