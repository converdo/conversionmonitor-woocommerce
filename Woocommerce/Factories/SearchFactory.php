<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Factories\BaseSearchFactory;
use WP_Query;

class SearchFactory extends BaseSearchFactory
{
    /**
     * The query instance.
     *
     * @var WP_Query
     */
    protected $query;

    /**
     * SearchFactory constructor.
     *
     * @param  WP_Query          $query
     */
    public function __construct(WP_Query $query)
    {
        $this->query = $query;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        return $this->model
                    ->setTerm($this->query->get('s'))
                    ->setPageNumber($this->query->get('paged'))
                    ->setPageResults($this->query->post_count)
                    ->setTotalResults($this->query->found_posts);
    }
}