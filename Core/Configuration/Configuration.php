<?php

namespace Converdo\ConversionMonitor\Core\Configuration;

use Converdo\ConversionMonitor\Core\Contracts\PlatformConfigurable;
use Converdo\ConversionMonitor\Core\Support\Crypt;

class Configuration
{
    /**
     * The plugin version.
     *
     * @var string
     */
    const VERSION = '3.0.0.0';

    /**
     * The name of the plugin.
     *
     * @var string
     */
    protected $plugin;

    /**
     * The namespace name of the platform.
     *
     * @var PlatformConfigurable|string
     */
    protected $platform;

    /**
     * The absolute path to the platform directory.
     *
     * @var string
     */
    protected $basePath;

    /**
     * The absolute path to the plugin directory.
     *
     * @var string
     */
    protected $path;

    /**
     * The environment configuration
     *
     * @var array
     */
    protected $environment;

    /**
     * Get the version number of the plugin.
     *
     * @return string
     */
    public function version()
    {
        return self::VERSION;
    }

    /**
     * Set up the configuration.
     *
     * @param array $options
     */
    public function setup(array $options)
    {
        $this->basePath = $options['base_path'];

        $this->path = realpath($this->basePath . '/' . $options['plugin_path']);

        $this->resolveEnvironment();
    }

    /**
     * Returns the Crypt instance.
     *
     * @return Crypt
     */
    public function crypt()
    {
        return cvd_app(Crypt::class);
    }

    /**
     * Resolves the environment of the plugin.
     *
     * @return array
     */
    protected function resolveEnvironment()
    {
        if (file_exists($this->basePath . '/conversionmonitor-environment.php')) {
            $this->environment = include($this->basePath . '/conversionmonitor-environment.php');
        } else {
            $this->environment = include(cvd_config()->platform()->pluginPath() . '/Core/config.php');
        }

        return $this->environment;
    }

    /**
     * Define the name of the plugin.
     *
     * @param  string       $name
     * @return $this
     */
    public function plugin($name)
    {
        $this->plugin = $name;

        $this->platform = cvd_app("\\Converdo\\ConversionMonitor\\{$name}\\Configuration\\Configuration");

        return $this;
    }

    /**
     * Get the environment of the plugin.
     *
     * @param  null|string      $check
     * @return bool|string
     */
    public function environment($check = null)
    {
        if ($check) {
            return $this->environment['name'] === $check;
        }

        return $this->environment;
    }

    /**
     * Get the tracker url.
     *
     * @param  string|null      $append
     * @return string
     */
    public function url($append = null)
    {
        $subdomain = 'connect.' . cvd_config()->platform->location();

        return "{$this->environment['scheme']}://{$subdomain}.{$this->environment['url']}{$append}";
    }

    /**
     * Get the platform-specific configuration.
     *
     * @return PlatformConfigurable|null
     */
    public function platform()
    {
        return $this->platform;
    }

    /**
     * Get the path to the plugin.
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }
}