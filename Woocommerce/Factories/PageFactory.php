<?php

namespace Converdo\ConversionMonitor\Woocommerce\Factories;

use Converdo\ConversionMonitor\Core\Enumerables\Pages\AccountPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\CartPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\CategoryPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\CheckoutPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\HomePage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\ProductPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\SearchPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\SeoPage;
use Converdo\ConversionMonitor\Core\Enumerables\Pages\SuccessPage;
use Converdo\ConversionMonitor\Core\Enumerables\PageType;
use Converdo\ConversionMonitor\Core\Factories\BasePageFactory;
use WP_Query;

class PageFactory extends BasePageFactory
{
    /**
     * The query instance.
     *
     * @var WP_Query
     */
    protected $query;

    /**
     * PageFactory constructor.
     *
     * @param  WP_Query     $query
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
                    ->setType($this->handlePageType())
                    ->setName($this->handlePageTitle())
                    ->setUrl($this->handleRequestUrl())
                    ->setLanguageCode($this->handleLocale());
    }

    /**
     * Get the page title.
     *
     * @return string
     */
    protected function handlePageTitle()
    {
        if ($this->model->isOfType(new CategoryPage())) {
            return $this->query->queried_object->name;
        }

        if ($this->model->isOfType(new HomePage())) {
            return get_option('blogname');
        }

        if ($this->model->isOfType(new SearchPage())) {
            return $this->query->query['s'];
        }

        return $this->query->post->post_title ?: $this->query->post->label;
    }

    /**
     * Build the requested page URL, ignore query parameters.
     *
     * @return string
     */
    protected function handleRequestUrl()
    {
        $path = current(explode('?', $_SERVER['REQUEST_URI'], 2));

        return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$path}";
    }

    /**
     * Parse the locale as valid ISO 639-1 locale code.
     *
     * @return string
     */
    protected function handleLocale()
    {
        return substr(get_locale(), 0, 2);
    }

    /**
     * Get the page type.
     *
     * @return PageType
     */
    protected function handlePageType()
    {
        if (is_product()) {
            return new ProductPage();
        } elseif (is_product_category()) {
            return new CategoryPage();
        } elseif (is_cart()) {
            return new CartPage();
        } elseif (is_order_received_page()) {
            return new SuccessPage();
        } elseif (is_checkout() || is_checkout_pay_page()) {
            return new CheckoutPage();
        } elseif (is_account_page()) {
            return new AccountPage();
        } elseif (is_search()) {
            return new SearchPage();
        } elseif (is_shop() || is_home()) {
            return new HomePage();
        }

        return new SeoPage();
    }
}