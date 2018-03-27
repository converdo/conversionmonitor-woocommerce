<?php

/*
 * Plugin Name: Conversion Monitor
 * Plugin URI: https://www.converdo.com
 * Description: Convert more visitors into paying customers. Fast & easy.
 * Author: Converdo BV
 * Text Domain: conversionmonitor
 * Author URI: https://www.conversionmonitor.com
 * Domain Path: /languages
 * Version: 3.0.0.0
 */

/**
 * Add the Conversion Monitor integration for WooCommerce.
 *
 * @param  mixed        $integrations
 * @return array
 */
function conversionmonitor_add_integration($integrations)
{
    global $woocommerce;

    if (is_object($woocommerce) && version_compare($woocommerce->version, '2.1-beta-1', '>=')) {
        include_once(__DIR__ . '/Woocommerce/resources/includes/conversion-monitor.php');

        $integrations[] = 'WC_ConversionMonitor';
    }

    return $integrations;
}

add_filter('woocommerce_integrations', 'conversionmonitor_add_integration');
add_action('woocommerce_checkout_order_processed', 'conversionmonitor_api_order_new', 10, 1);
add_action('woocommerce_update_order', 'conversionmonitor_api_order_update', 10, 1);
add_action('rest_api_init', 'conversionmonitor_controller');

/**
 * Add a settings shortcut in the plugin list.
 *
 * @return array
 */
add_filter('plugin_action_links_conversion-monitor/conversion-monitor.php', function ($links)
{
    $label = __('Settings');

    $url = get_admin_url(null, 'admin.php?page=wc-settings&tab=integration&section=conversionmonitor');

    $links[] = "<a href=\"{$url}\">{$label}</a>";

    return $links;
});

/**
 * Send a created order to the Conversion Monitor.
 *
 * @param  string       $orderId
 * @return void
 */
function conversionmonitor_api_order_new($orderId)
{
    cvd_app()->make(\Converdo\ConversionMonitor\Core\API\API::class)->order_create(
        cvd_config()->platform()->order(wc_get_order($orderId))
    );
}

/**
 * Send an updated order to the Conversion Monitor.
 *
 * @param  string       $orderId
 * @return void
 */
function conversionmonitor_api_order_update($orderId)
{
    cvd_app()->make(\Converdo\ConversionMonitor\Core\API\API::class)->order_update(
        cvd_config()->platform()->order(wc_get_order($orderId))
    );
}

/**
 * Register the Conversion Monitor API route.
 *
 * @return void
 */
function conversionmonitor_controller() {
    register_rest_route('conversionmonitor', '/ping', [
        'methods' => 'GET',
        'callback' => function () {
            $controller = new \Converdo\ConversionMonitor\Woocommerce\Controllers\InformationController();

            $response = $controller->information();

            return $response;
        }
    ]);
}