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
     * Initialise Settings Form Fields
     *
     * @access public
     * @return void
     */
    function init_form_fields()
    {
        $this->form_fields = [
            'conversionmonitor_enabled' => [
                'title'             => __('Enable', 'conversionmonitor'),
                'type'              => 'checkbox',
                'checkboxgroup'     => 'start',
                'default'           => ($this->enabled()) ? 'no' : 'yes',
            ],
            'conversionmonitor_website' => [
                'title'             => __('Website Token', 'conversionmonitor'),
                'type'              => 'text',
                'placeholder'       => 'WS_',
            ],
            'conversionmonitor_encryption' => [
                'title'             => __('Encryption Token', 'conversionmonitor'),
                'type'              => 'text',
                'placeholder'       => 'EC_',
            ],
            'conversionmonitor_user' => [
                'title'             => __('User Token', 'conversionmonitor'),
                'type'              => 'text',
                'placeholder'       => 'US_',
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

        self::$isEnabled = $this->get_option('conversionmonitor_enabled');
        self::$website = $this->get_option('conversionmonitor_website');
        self::$encryption = $this->get_option('conversionmonitor_encryption');
        self::$user = $this->get_option('conversionmonitor_user');

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
     * Gets whether the Conversion Monitor plugin is enabled.
     *
     * @return bool
     */
    public static function enabled()
    {
        return self::$isEnabled === 'no' ? false : true;
    }

    /**
     * Gets the website token.
     *
     * @return string
     */
    public static function getWebsiteToken()
    {
        return self::$website;
    }

    /**
     * Gets the encryption token.
     *
     * @return string
     */
    public static function getEncryptionToken()
    {
        return self::$encryption;
    }

    /**
     * Gets the User token.
     *
     * @return string
     */
    public static function getUserToken()
    {
        return self::$user;
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
}

