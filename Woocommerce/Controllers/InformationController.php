<?php

namespace Converdo\ConversionMonitor\Woocommerce\Controllers;

use Converdo\ConversionMonitor\Core\Controllers\BaseInformationController;

class InformationController extends BaseInformationController
{
    /**
     * @inheritdoc
     */
    public function information()
    {
        $plugin = $this->buildPluginInformation();

        $logs = $this->buildLogOutput();

        $gateways = $this->buildPaymentGatewayInformation();

        $products = $this->buildProductRelationMapping();

        return array_filter(compact('plugin', 'logs', 'gateways', 'products'));
    }

    /**
     * Display the payment gateway configuration block.
     *
     * @return array
     */
    protected function buildPaymentGatewayInformation()
    {
        if ($this->cannotSeePrivateInformation()) {
            return [];
        }

        $gateways = [];

        foreach (WC()->payment_gateways->get_available_payment_gateways() as $gateway) {
            $gateways[] = cvd_config()->platform()->paymentGateway($gateway)->render();
        }

        return $gateways;
    }

    /**
     * Display the product relation mapping block.
     *
     * @return array
     */
    protected function buildProductRelationMapping()
    {
        if (! $this->shouldDisplayProductRelationMapping()) {
            return [];
        }

        $relations = [];

        foreach ($this->fetchBundleProducts() as $bundle) {
            foreach ($this->fetchProducts(unserialize($bundle->children)) as $child) {
                $relations[$bundle->sku][] = $child->sku;
            }
        }

        foreach ($this->fetchVariationProducts() as $bundle) {
            foreach ($this->fetchProducts(explode(',', $bundle->children)) as $child) {
                $relations[$bundle->sku][] = $child->sku;
            }
        }

        foreach ($relations as $sku => $children) {
            if (empty($sku)) {
                unset($relations[$sku]);

                continue;
            }

            $relations[$sku] = array_values(array_filter($children));
        }

        return array_filter($relations);
    }

    /**
     * Determine if the product relation mapping should be displayed.
     *
     * @return bool
     */
    protected function shouldDisplayProductRelationMapping()
    {
        return $this->canSeePrivateInformation() && isset($_GET['products']) && $_GET['products'] === 'true';
    }

    /**
     * Fetch all bundle products from the database.
     *
     * @return object|null
     */
    protected function fetchBundleProducts()
    {
        global $wpdb;

        $query  = "SELECT pm1.meta_value AS children, pm2.meta_value AS sku ";
        $query .= "FROM {$wpdb->posts} p ";
        $query .= "JOIN {$wpdb->postmeta} pm1 ON pm1.post_id = p.ID AND pm1.meta_key = '_children' AND LENGTH(pm1.meta_value) > 8 ";
        $query .= "JOIN {$wpdb->postmeta} pm2 ON pm2.post_id = p.ID AND pm2.meta_key = '_sku' ";
        $query .= "WHERE p.post_type IN ('product', 'product_variation') AND p.post_status = 'publish'";

        return $wpdb->get_results($query);
    }

    /**
     * Fetch all variation products from the database.
     *
     * @return object|null
     */
    protected function fetchVariationProducts()
    {
        global $wpdb;

        $query  = "SELECT pm.meta_value AS sku, GROUP_CONCAT(p2.ID) as children ";
        $query .= "FROM {$wpdb->posts} p ";
        $query .= "JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = '_sku' ";
        $query .= "JOIN {$wpdb->posts} p2 ON p2.post_parent = p.ID AND p2.post_type = 'product_variation' AND p.post_status = 'publish' ";
        $query .= "WHERE p.post_type = 'product' AND p.post_parent = 0 AND p.post_status = 'publish' ";
        $query .= "GROUP BY pm.meta_value";

        return $wpdb->get_results($query);
    }

    /**
     * Fetch the products from the database.
     *
     * @param  array            $ids
     * @return object|null
     */
    protected function fetchProducts(array $ids)
    {
        global $wpdb;

        $ids = implode(', ', $ids);

        $query  = "SELECT pm.meta_value AS sku ";
        $query .= "FROM {$wpdb->posts} p ";
        $query .= "JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = '_sku' ";
        $query .= "WHERE p.ID IN ({$ids}) AND p.post_type IN ('product', 'product_variation') AND p.post_status = 'publish'";

        return $wpdb->get_results($query);
    }
}