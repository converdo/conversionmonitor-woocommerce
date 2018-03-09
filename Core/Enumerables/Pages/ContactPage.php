<?php

namespace Converdo\ConversionMonitor\Core\Enumerables\Pages;

use Converdo\ConversionMonitor\Core\Enumerables\PageType;

class ContactPage implements PageType
{
    /**
     * @inheritdoc
     */
    public function name()
    {
        return 'CONTACT';
    }
}