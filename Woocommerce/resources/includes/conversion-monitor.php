<?php

require_once __DIR__ . '/../../../Core/bootstrap.php';

class WC_ConversionMonitor extends WC_Integration
{
    public $id;

    /**
     * @var array
     */
    public $form_fields = [];

    /**
     * The User token.
     *
     * @var string
     */
    protected static $isEnabled;

    /**
     * The Website token.
     *
     * @var string
     */
    protected static $website;

    /**
     * The Encryption token.
     *
     * @var string
     */
    protected static $encryption;

    /**
     * The User token.
     *
     * @var string
     */
    protected static $user;

    /**
     * The attribute options.
     *
     * @var array
     */
    protected static $attributes = [];

    /**
     * Initialise Settings Form Fields
     *
     * @access public
     * @return void
     */
    function init_form_fields()
    {
        $this->form_fields = [
            'conversionmonitor_enabled' => [
                'title' => __('Enable', 'conversionmonitor'),
                'type' => 'checkbox',
                'checkboxgroup' => 'start',
                'default' => ($this->enabled()) ? 'no' : 'yes',
            ],
            'conversionmonitor_website' => [
                'title' => __('Website Token', 'conversionmonitor'),
                'type' => 'text',
                'placeholder' => 'WS_',
                'class' => 'conversionmonitor-input conversionmonitor-input-token',
            ],
            'conversionmonitor_encryption' => [
                'title' => __('Encryption Token', 'conversionmonitor'),
                'type' => 'text',
                'placeholder' => 'EC_',
                'class' => 'conversionmonitor-input conversionmonitor-input-token',
            ],
            'conversionmonitor_user' => [
                'title' => __('User Token', 'conversionmonitor'),
                'type' => 'text',
                'placeholder' => 'US_',
                'class' => 'conversionmonitor-input conversionmonitor-input-token',
            ],
            'conversionmonitor_attributes_heading' => [
                'title' => '<h3 style="cursor:default">' . __('Product Attributes', 'conversionmonitor') . '</h3>',
                'type' => 'hidden'
            ],
            'conversionmonitor_attribute_brand' => [
                'title' => __('Brand', 'conversionmonitor'),
                'type' => 'select',
                'desc_tip' => true,
                'description' => __('The product brand or manufacturer name', 'conversionmonitor'),
                'class' => 'conversionmonitor-input',
                'options' => $this->getAttributeArray(),
            ],
            'conversionmonitor_attribute_costprice' => [
                'title' => __('Cost Price', 'conversionmonitor'),
                'type' => 'select',
                'desc_tip' => true,
                'description' => __('The cost price of the product', 'conversionmonitor'),
                'class' => 'conversionmonitor-input',
                'options' => $this->getAttributeArray(),
            ],
            'conversionmonitor_attribute_set' => [
                'title' => __('Product Group', 'conversionmonitor'),
                'type' => 'select',
                'desc_tip' => true,
                'description' => __('The descriptive term of the product', 'conversionmonitor'),
                'class' => 'conversionmonitor-input',
                'options' => $this->getAttributeArray(),
            ],
        ];
    }

    /**
     * Init and hook in the integration.
     */
    public function __construct()
    {
        $this->id = 'conversionmonitor';

        $this->method_title = __('Conversion Monitor', 'woocommerce');
        $this->method_description = __('Conversion Monitor', 'woocommerce');

        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();

        static::$isEnabled = $this->get_option('conversionmonitor_enabled');

        static::$website = $this->get_option('conversionmonitor_website');

        static::$encryption = $this->get_option('conversionmonitor_encryption');

        static::$user = $this->get_option('conversionmonitor_user');

        static::$attributes['brand'] = $this->get_option('conversionmonitor_attribute_brand');

        static::$attributes['cost_price'] = $this->get_option('conversionmonitor_attribute_costprice');

        static::$attributes['set'] = $this->get_option('conversionmonitor_attribute_set');

        $this->actions();
    }

    protected function actions()
    {
        add_action('woocommerce_update_options_integration_conversionmonitor', [$this, 'process_admin_options']);

        if (self::$isEnabled) {
            add_action('wp_footer', [$this, 'conversionmonitor_tracking_code']);
        }
    }

    /**
     * Get whether the Conversion Monitor plugin is enabled.
     *
     * @return bool
     */
    public static function enabled()
    {
        return self::$isEnabled === 'no' ? false : true;
    }

    /**
     * Get the website token.
     *
     * @return string
     */
    public static function getWebsiteToken()
    {
        return self::$website;
    }

    /**
     * Get the encryption token.
     *
     * @return string
     */
    public static function getEncryptionToken()
    {
        return self::$encryption;
    }

    /**
     * Get the user token.
     *
     * @return string
     */
    public static function getUserToken()
    {
        return self::$user;
    }

    /**
     * Get the brand attribute.
     *
     * @return string
     */
    public static function getBrandAttribute()
    {
        return self::$attributes['brand'];
    }

    /**
     * Get the cost price attribute.
     *
     * @return string
     */
    public static function getCostPriceAttribute()
    {
        return self::$attributes['cost_price'];
    }

    /**
     * Get the group attribute set.
     *
     * @return string
     */
    public static function getGroupAttribute()
    {
        return self::$attributes['set'];
    }

    /**
     * Conversion Monitor tracking section.
     *
     * @access public
     * @return void
     */
    function conversionmonitor_tracking_code()
    {
        include_once(__DIR__ . '/../views/collection.php');
    }

    /**
     * Conversion Monitor admin section.
     *
     * @access public
     * @return void
     */
    public function admin_options()
    {
        include_once(__DIR__ . '/../views/administration.php');
    }

    /**
     * Get the attributes array.
     *
     * @return array
     */
    protected function getAttributeArray()
    {
        $attributes = [
            0 => '➖ Disabled',
        ];

        foreach (wc_get_attribute_taxonomies() as $attribute) {
            $attributes["pa_{$attribute->attribute_name}"] = $attribute->attribute_label;
        }

        return $attributes;
    }
}
