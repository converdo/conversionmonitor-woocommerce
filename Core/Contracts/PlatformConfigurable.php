<?php

namespace Converdo\ConversionMonitor\Core\Contracts;

use Converdo\ConversionMonitor\Core\Factories\BaseCartFactory;
use Converdo\ConversionMonitor\Core\Factories\BaseCategoryFactory;
use Converdo\ConversionMonitor\Core\Factories\BaseCouponFactory;
use Converdo\ConversionMonitor\Core\Factories\BaseOrderFactory;
use Converdo\ConversionMonitor\Core\Factories\BasePageFactory;
use Converdo\ConversionMonitor\Core\Factories\BaseProductFactory;
use Converdo\ConversionMonitor\Core\Factories\BaseVisitorFactory;

interface PlatformConfigurable
{
    /**
     * Determine if the plugin is enabled.
     *
     * @return bool
     */
    public function enabled();

    /**
     * Determine if the plugin is disabled.
     *
     * @return bool
     */
    public function disabled();

    /**
     * The website token
     *
     * @param  string|null      $store
     * @return string|null
     */
    public function website($store = null);

    /**
     * The encryption token
     *
     * @param  string|null      $store
     * @return string|null
     */
    public function encryption($store = null);

    /**
     * The user token
     *
     * @param  string|null      $store
     * @return string|null
     */
    public function user($store = null);

    /**
     * Determine if the plugin is activated.
     *
     * @param  string|null      $store
     * @return mixed
     */
    public function activated($store = null);

    /**
     * Terminate the plugin.
     *
     * @return void
     */
    public function terminate();

    /**
     * Determine if the current page is a valid page.
     *
     * @return bool
     */
    public function isPage();

    /**
     * Get the page object.
     *
     * @return mixed
     */
    public function page();

    /**
     * Get the page factory instance.
     *
     * @param  mixed                $page
     * @return BasePageFactory
     */
    public function getPageFactory($page);

    /**
     * Determine if the current page is a product page.
     *
     * @return bool
     */
    public function isProduct();

    /**
     * Get the product object.
     *
     * @return mixed
     */
    public function product();

    /**
     * Get the product factory instance.
     *
     * @param  mixed                $product
     * @param  int|null             $quantity
     * @return BaseProductFactory
     */
    public function getProductFactory($product, $quantity = null);

    /**
     * Determine if the current page is a category page.
     *
     * @return bool
     */
    public function isCategory();

    /**
     * Get the category object.
     *
     * @return mixed
     */
    public function category();

    /**
     * Get the category factory instance.
     *
     * @param  mixed                $category
     * @return BaseCategoryFactory
     */
    public function getCategoryFactory($category);

    /**
     * Determine if the current page is a search page.
     *
     * @return bool
     */
    public function isSearch();

    /**
     * Get the search object.
     *
     * @return mixed
     */
    public function search();

    /**
     * Get the search factory instance.
     *
     * @param  mixed                $search
     * @return BasePageFactory
     */
    public function getSearchFactory($search);

    /**
     * Get the visitor object.
     *
     * @return mixed
     */
    public function visitor();

    /**
     * Get the visitor factory instance.
     *
     * @return BaseVisitorFactory
     */
    public function getVisitorFactory();

    /**
     * Get a coupon object.
     *
     * @param  mixed                $cart
     * @param  mixed                $coupon
     * @return mixed
     */
    public function coupon($cart, $coupon);

    /**
     * Get the coupon factory instance.
     *
     * @param  mixed                $cart
     * @param  mixed                $coupon
     * @return BaseCouponFactory
     */
    public function getCouponFactory($cart, $coupon);

    /**
     * Get an order object.
     *
     * @param  mixed                $order
     * @return mixed
     */
    public function order($order);

    /**
     * Get the order factory instance.
     *
     * @param  mixed                $order
     * @return BaseOrderFactory
     */
    public function getOrderFactory($order);

    /**
     * Determine if there is a cart with products.
     *
     * @return bool
     */
    public function hasCart();

    /**
     * Get the cart object.
     *
     * @return mixed
     */
    public function cart();

    /**
     * Get the cart factory instance.
     *
     * @param  mixed                $cart
     * @return BaseCartFactory
     */
    public function getCartFactory($cart);

    /**
     * Get the name of the directory.
     *
     * @return string
     */
    public function directory();

    /**
     * Get the root path of the platform.
     *
     * @return string
     */
    public function basePath();

    /**
     * Get the relative path to the plugin root directory.
     *
     * @param  string|null      $path
     * @return string
     */
    public function pluginPath($path = null);
}