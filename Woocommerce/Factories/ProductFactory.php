<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Enumerables\Products\ConfigurableProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\DownloadableProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\ExternalProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\GroupedProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\SimpleProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\VirtualProduct;
use Converdo\ConversionMonitor\Core\Enumerables\Products\VoucherProduct;
use Converdo\ConversionMonitor\Core\Enumerables\ProductType;
use Converdo\ConversionMonitor\Core\Factories\BaseProductFactory;
use WC_ConversionMonitor;
use WC_Product;

class ProductFactory extends BaseProductFactory
{
    /**
     * The product instance.
     *
     * @var WC_Product
     */
    protected $product;

    /**
     * The product quantity.
     *
     * @var int
     */
    protected $quantity;

    /**
     * ProductFactory constructor.
     *
     * @param  WC_Product       $product
     * @param  int              $quantity
     */
    public function __construct(WC_Product $product, $quantity = null)
    {
        $this->product = $product;

        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        return $this->model
                    ->setName($this->product->get_name())
                    ->setSku($this->product->get_sku())
                    ->setPrice($this->product->get_price())
                    ->setBrand($this->handleManufacturerString())
                    ->setAttributes($this->product->get_attribute(WC_ConversionMonitor::getGroupAttribute()))
                    ->setCost($this->product->get_attribute(WC_ConversionMonitor::getCostPriceAttribute()))
                    ->setImage($this->handleImageUrlString())
                    ->setType($this->handleProductType())
                    ->setCategories($this->handleCategories())
                    ->setQuantity($this->quantity);
    }

    /**
     * Get the first manufacturer on the manufacturers list.
     *
     * @return string
     */
    protected function handleManufacturerString()
    {
        $manufacturers = $this->product->get_attribute(WC_ConversionMonitor::getBrandAttribute());

        if (! $manufacturers = array_filter(explode(',', $manufacturers))) {
            return null;
        }

        return current($manufacturers);
    }

    /**
     * Get the URL of the product image.
     *
     * @return string
     */
    protected function handleImageUrlString()
    {
        if (! $thumbnail = get_post_thumbnail_id($this->product->get_id())) {
            return null;
        }

        if (! count($image = wp_get_attachment_image_src($thumbnail, 'full'))) {
            return null;
        }

        return current($image);
    }

    /**
     * Get the product type.
     *
     * @return ProductType
     */
    protected function handleProductType()
    {
        if ($this->product->is_downloadable()) {
            return new DownloadableProduct();
        }

        if ($this->product->is_virtual()) {
            return new VirtualProduct();
        }

        switch (strtolower($this->product->get_type())) {
            case 'grouped':
                return new GroupedProduct();
            case 'external':
            case 'affiliate':
                return new ExternalProduct();
            case 'variable':
                return new ConfigurableProduct();
            case 'voucher':
                return new VoucherProduct();
            default:
                return new SimpleProduct();
        }
    }

    /**
     * Get the product category names from the category ids.
     *
     * @return array
     */
    protected function handleCategories()
    {
        $categories = [];

        // Get the level and name of each available category.
        foreach (array_filter($this->product->get_category_ids()) as $key => $id) {
            $category = get_term_by('id', $id, 'product_cat');

            $categories[] = [
                'level' => $category->parent,
                'name' => $category->name,
            ];
        }

        // Sort the categories by their level.
        usort($categories, function ($a, $b) {
            return $a['level'] < $b['level'];
        });

        // Only keep the top three categories.
        $categories = array_slice($categories, 0, 3);

        // Only keep the name of the categories.
        $categories = array_column($categories, 'name');

        return $categories;
    }
}