<?php

namespace Converdo\ConversionMonitor\Core\Contracts;

interface Renderable
{
    /**
     * Render the data.
     *
     * @return array
     */
    public function render();
}