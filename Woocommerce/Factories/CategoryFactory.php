<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Factories\BaseCategoryFactory;
use WP_Term;

class CategoryFactory extends BaseCategoryFactory
{
    /**
     * The category instance.
     *
     * @var WP_Term
     */
    protected $category;

    /**
     * CategoryFactory constructor.
     *
     * @param  WP_Term          $category
     */
    public function __construct(WP_Term $category)
    {
        $this->category = $category;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        return $this->model
                    ->setName($this->category->name);
    }
}