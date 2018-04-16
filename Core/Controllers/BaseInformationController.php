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
        $plugin = $this->buildPluginInformation();

        $logs = $this->buildLogOutput();

        return array_filter(compact('plugin', 'logs'));
    }

    /**
     * Build the public plugin information.
     *
     * @return array
     */
    protected function buildPluginInformation()
    {
        return [
            'version' => cvd_config()->version(),
        ];
    }

    /**
     * Build the plugin log file output.
     *
     * @return array
     */
    protected function buildLogOutput()
    {
        if ($this->cannotSeePrivateInformation()) {
            return [];
        }

        return cvd_logger()->tail(100);
    }

    /**
     * Determine if private information can be seen in the response.
     *
     * @return bool
     */
    protected function canSeePrivateInformation()
    {
        return isset($_GET['key']) && $_GET['key'] === cvd_config()->platform()->encryption();
    }

    /**
     * Determine if private information cannot be seen in the response.
     *
     * @return bool
     */
    protected function cannotSeePrivateInformation()
    {
        return ! $this->canSeePrivateInformation();
    }
}