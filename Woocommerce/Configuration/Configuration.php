<?php

namespace Converdo\ConversionMonitor\Woocommerce\Configuration;

use Converdo\ConversionMonitor\Core\Contracts\PlatformConfigurable;
use Converdo\ConversionMonitor\Core\Factories\BaseVisitorFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\CartFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\CategoryFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\CouponFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\OrderFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\PageFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\PaymentGatewayFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\ProductFactory;
use Converdo\ConversionMonitor\Woocommerce\Factories\SearchFactory;
use WC_ConversionMonitor;

class Configuration implements PlatformConfigurable
{
    /**
     * Determine if the plugin is activated.
     *
     * @var bool
     */
    protected $activated = true;

    /**
     * @inheritDoc
     */
    public function enabled($store = null)
    {
        return $this->user($store)
            && $this->website($store)
            && $this->encryption($store)
            && $this->activated($store)
            && WC_ConversionMonitor::enabled()
            && $this->activated;
    }

    /**
     * @inheritDoc
     */
    public function disabled($store = null)
    {
        return ! $this->enabled($store);
    }

    /**
     * @inheritDoc
     */
    public function website($store = null)
    {
        return (string) WC_ConversionMonitor::getWebsiteToken();
    }

    /**
     * @inheritDoc
     */
    public function encryption($store = null)
    {
        return (string) WC_ConversionMonitor::getEncryptionToken();
    }

    /**
     * @inheritDoc
     */
    public function user($store = null)
    {
        return (string) WC_ConversionMonitor::getUserToken();
    }

    /**
     * @inheritDoc
     */
    public function activated($store = null)
    {
        return (bool) WC_ConversionMonitor::enabled();
    }

    /**
     * @inheritDoc
     */
    public function terminate()
    {
        $this->activated = false;
    }

    /**
     * @inheritdoc
     */
    public function isPage()
    {
        global $wp_query;

        return get_class($wp_query) === 'WP_Query';
    }

    /**
     * @inheritdoc
     */
    public function page()
    {
        global $wp_query;

        return $this->getPageFactory($wp_query)->call();
    }

    /**
     * @inheritdoc
     */
    public function getPageFactory($page)
    {
        return new PageFactory($page);
    }

    /**
     * @inheritdoc
     */
    public function isProduct()
    {
        return is_product();
    }

    /**
     * @inheritdoc
     */
    public function product()
    {
        global $product;

        return $this->getProductFactory($product)->call();
    }

    /**
     * @inheritdoc
     */
    public function getProductFactory($product, $quantity = null)
    {
        return new ProductFactory($product, $quantity);
    }

    /**
     * @inheritdoc
     */
    public function isCategory()
    {
        return is_product_category();
    }

    /**
     * @inheritdoc
     */
    public function category()
    {
        global $wp_query;

        return $this->getCategoryFactory($wp_query->get_queried_object())->call();
    }

    /**
     * @inheritdoc
     */
    public function getCategoryFactory($category)
    {
        return new CategoryFactory($category);
    }

    /**
     * @inheritdoc
     */
    public function isSearch()
    {
        return is_search();
    }

    /**
     * @inheritdoc
     */
    public function search()
    {
        global $wp_query;

        return $this->getSearchFactory($wp_query)->call();
    }

    /**
     * @inheritdoc
     */
    public function getSearchFactory($search)
    {
        return new SearchFactory($search);
    }

    /**
     * @inheritdoc
     */
    public function visitor()
    {
        return $this->getVisitorFactory()->call();
    }

    /**
     * @inheritdoc
     */
    public function getVisitorFactory()
    {
        return new BaseVisitorFactory();
    }

    /**
     * @inheritdoc
     */
    public function hasCart()
    {
        return WC()->cart && count(WC()->cart->get_cart());
    }

    /**
     * @inheritdoc
     */
    public function cart()
    {
        return $this->getCartFactory(WC()->cart)->call();
    }

    /**
     * @inheritdoc
     */
    public function getCartFactory($cart)
    {
        return new CartFactory($cart);
    }

    /**
     * @inheritdoc
     */
    public function coupon($cart, $coupon)
    {
        return $this->getCouponFactory($cart, $coupon)->call();
    }

    /**
     * @inheritdoc
     */
    public function getCouponFactory($cart, $coupon)
    {
        return new CouponFactory($cart, $coupon);
    }

    /**
     * @inheritdoc
     */
    public function order($order)
    {
        return $this->getOrderFactory($order)->call();
    }

    /**
     * @inheritdoc
     */
    public function getOrderFactory($order)
    {
        return new OrderFactory($order);
    }

    /**
     * @inheritdoc
     */
    public function paymentGateway($gateway)
    {
        return $this->getPaymentGatewayFactory($gateway)->call();
    }

    /**
     * @inheritdoc
     */
    public function getPaymentGatewayFactory($gateway)
    {
        return new PaymentGatewayFactory($gateway);
    }

    /**
     * @inheritDoc
     */
    public function directory()
    {
        return 'Woocommerce';
    }

    /**
     * @inheritDoc
     */
    public function basePath()
    {
        return ABSPATH;
    }

    /**
     * @inheritDoc
     */
    public function pluginPath($path = null)
    {
        return trim(WP_CONTENT_DIR . "/plugins/conversion-monitor/{$path}");
    }

    /**
     * @inheritDoc
     */
    public function httpPath($path = null)
    {
        return trim(WP_CONTENT_URL . "/plugins/conversion-monitor/{$path}");
    }
}