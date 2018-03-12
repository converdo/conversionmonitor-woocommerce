<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;
use Converdo\ConversionMonitor\Core\Enumerables\ProductType;

class TrackableProduct implements Renderable
{
    /**
     * The name of the product.
     *
     * @var string
     */
    protected $name;

    /**
     * The sku of the product.
     *
     * @var string
     */
    protected $sku;

    /**
     * The price of the product.
     *
     * @var float
     */
    protected $price;

    /**
     * The cost price of the product.
     *
     * @var float|null
     */
    protected $cost;

    /**
     * The attribute set of the product.
     *
     * @var string
     */
    protected $attributes;

    /**
     * The brand name of the product.
     *
     * @var string
     */
    protected $brand;

    /**
     * The image url of the product.
     *
     * @var string
     */
    protected $image;

    /**
     * The type of the product.
     *
     * @var ProductType
     */
    protected $type;

    /**
     * The names of product categories.
     *
     * @var array
     */
    protected $categories = [];

    /**
     * The cart quantity of the product.
     *
     * @var int|null
     */
    protected $quantity;

    /**
     * Set the name of the product.
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
     * Get the name of the product.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Set the sku of the product.
     *
     * @param  string       $sku
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = trim($sku);

        return $this;
    }

    /**
     * Get the sku of the product.
     *
     * @return string
     */
    public function sku()
    {
        return $this->sku;
    }

    /**
     * Set the price of the product.
     *
     * @param  float        $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;

        return $this;
    }

    /**
     * Get the price of the product.
     *
     * @return float
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * Set the cost price of the product.
     *
     * @param  float        $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = (float) $cost;

        return $this;
    }

    /**
     * Get the cost price of the product.
     *
     * @return float|null
     */
    public function cost()
    {
        return $this->cost;
    }

    /**
     * Set the attributes of the product.
     *
     * @param  string       $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = (string) $attributes;

        return $this;
    }

    /**
     * Get the attributes of the product.
     *
     * @return string
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * Set the brand name of the product.
     *
     * @param  string       $brand
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the brand name of the product.
     *
     * @return string
     */
    public function brand()
    {
        return $this->brand;
    }

    /**
     * Set the image url of the product.
     *
     * @param  string       $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the image url of the product.
     *
     * @return string
     */
    public function image()
    {
        return $this->image;
    }

    /**
     * Set the type of the product.
     *
     * @param  ProductType  $type
     * @return $this
     */
    public function setType(ProductType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the product type instance.
     *
     * @return ProductType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Determine if the given page type is the same as the model's product type.
     *
     * @param  ProductType  $type
     * @return bool
     */
    public function isOfType(ProductType $type)
    {
        return $this->type instanceof $type;
    }

    /**
     * Get the type of the product.
     *
     * @return string
     */
    public function type()
    {
        return $this->type->name();
    }

    /**
     * Set the category names of the product.
     *
     * @param  array        $categories
     * @return $this
     */
    public function setCategories(array $categories)
    {
        $this->categories = (array) $categories;

        return $this;
    }

    /**
     * Add a category name of the product.
     *
     * @param  string       $category
     * @return $this
     */
    public function addCategory($category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Get the category names of the product.
     *
     * @return array
     */
    public function categories()
    {
        return array_filter($this->categories);
    }

    /**
     * Set the cart quantity of the product.
     *
     * @param  int          $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the cart quantity of the product.
     *
     * @return int|null
     */
    public function quantity()
    {
        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'na' => $this->name(),
            'sk' => $this->sku(),
            'pr' => $this->price(),
            'co' => $this->cost(),
            'at' => $this->attributes(),
            'br' => $this->brand(),
            'im' => $this->image(),
            'ca' => $this->categories(),
            'ty' => $this->type(),
            'qu' => $this->quantity(),
        ];
    }
}