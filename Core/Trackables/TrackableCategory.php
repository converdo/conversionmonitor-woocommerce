<?php

namespace Converdo\ConversionMonitor\Core\Trackables;

use Converdo\ConversionMonitor\Core\Contracts\Renderable;

class TrackableCategory implements Renderable
{
    /**
     * The name of the category.
     *
     * @var string
     */
    protected $name;

    /**
     * Set the name of the category.
     *
     * @param  string       $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * Get the name of the category.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return [
            'na' => $this->name(),
        ];
    }
}