<?php

namespace Converdo\ConversionMonitor\Core\Controllers;

class BaseInformationController
{
    /**
     * Get the plugin information.
     *
     * @return array
     */
    public function information()
    {
        $plugin = $this->getPluginInformation();

        $logs = $this->getLogOutput();

        return array_filter(compact('plugin', 'logs'));
    }

    /**
     * Get the plugin information.
     *
     * @return array
     */
    protected function getPluginInformation()
    {
        return [
            'version' => cvd_config()->version(),
        ];
    }

    /**
     * Get the plugin information.
     *
     * @return array
     */
    protected function getLogOutput()
    {
        if (! $this->shouldDisplayPrivateInformation()) {
            return [];
        }

        return cvd_logger()->tail(100);
    }

    /**
     * Determine if private information should be shown in the response.
     *
     * @return bool
     */
    protected function shouldDisplayPrivateInformation()
    {
        return isset($_GET['key']) && $_GET['key'] === cvd_config()->platform()->encryption();
    }
}