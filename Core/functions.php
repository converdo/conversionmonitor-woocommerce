<?php

if (! function_exists('cvd_app')) {
    /**
     * Get the available container instance.
     *
     * @param  string       $instance
     * @return mixed
     */
    function cvd_app($instance = null)
    {
        if ($instance) {
            return cvd_app()->make($instance);
        }

        return \Converdo\ConversionMonitor\Core\Support\Container::instance();
    }
}

if (! function_exists('cvd_logger'))
{
    /**
     * Get the Logger instance.
     *
     * @return \Converdo\ConversionMonitor\Core\Log\LogWriter
     */
    function cvd_logger()
    {
        return cvd_app(\Converdo\ConversionMonitor\Core\Log\LogWriter::class);
    }
}

if (! function_exists('cvd_config'))
{
    /**
     * Returns the configuration instance.
     *
     * @return \Converdo\ConversionMonitor\Core\Configuration\Configuration
     */
    function cvd_config()
    {
        return cvd_app(\Converdo\ConversionMonitor\Core\Configuration\Configuration::class);
    }
}