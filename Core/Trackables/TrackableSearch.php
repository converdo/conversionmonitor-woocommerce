<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableSearch implements Renderable
{
    /**
     * The search term string.
     *
     * @var string
     */
    protected $term;

    /**
     * The amount of results.
     *
     * @var int
     */
    protected $results;

    /**
     * Set the search term.
     *
     * @param  string       $term
     * @return $this
     */
    public function setTerm($term)
    {
        $this->term = (string) $term;

        return $this;
    }

    /**
     * Get the search term.
     *
     * @return string
     */
    public function term()
    {
        return $this->term;
    }

    /**
     * Set the amount of search results.
     *
     * @param  int          $results
     * @return $this
     */
    public function setResults($results)
    {
        $this->results = (int) $results;

        return $this;
    }

    /**
     * Get the amount of search results.
     *
     * @return string
     */
    public function results()
    {
        return $this->results;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'te' => $this->term(),
            'co' => $this->results(),
        ];
    }
}