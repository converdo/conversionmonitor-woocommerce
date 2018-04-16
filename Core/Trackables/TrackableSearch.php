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
     * The page number.
     *
     * @var int
     */
    protected $page;

    /**
     * The amount of results on the current page.
     *
     * @var int
     */
    protected $current = 0;

    /**
     * The total amount of results.
     *
     * @var int
     */
    protected $count = 0;

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
     * Set the page number.
     *
     * @param  string       $page
     * @return $this
     */
    public function setPageNumber($page)
    {
        $this->page = (int) $page;

        return $this;
    }

    /**
     * Get the page number.
     *
     * @return string
     */
    public function page()
    {
        return $this->page;
    }

    /**
     * Set the amount of results on the current page.
     *
     * @param  int          $current
     * @return $this
     */
    public function setPageResults($current)
    {
        $this->current = (int) $current;

        return $this;
    }

    /**
     * Get the amount of results on the current page.
     *
     * @return int
     */
    public function pageResults()
    {
        return $this->current;
    }

    /**
     * Set the total amount of results.
     *
     * @param  int          $count
     * @return $this
     */
    public function setTotalResults($count)
    {
        $this->count = (int) $count;

        return $this;
    }

    /**
     * Get the total amount of results.
     *
     * @return int
     */
    public function totalResults()
    {
        return $this->count;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'te' => $this->term(),
            'pa' => $this->page(),
            'pc' => $this->pageResults(),
            'co' => $this->totalResults(),
        ];
    }
}