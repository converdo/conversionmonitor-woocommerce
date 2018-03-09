<?php

// Supported platforms.
$platforms = ['Magento', 'Woocommerce', 'PrestaShop', 'Shopify'];
$platform = null;

// Include the Converdo functions.
$functions = require_once __DIR__ . '/functions.php';

// Autoload all Converdo files and files of the current platform.
$autoload = require_once __DIR__ . '/autoload.php';

foreach ($platforms as $pointer) {
    if (is_dir(dirname(__DIR__) . "/{$pointer}")) {
        $platform = $pointer;
    }
}

if (! $platform) {
    return;
}

$autoload_platform = require_once __DIR__ . "/../{$platform}/autoload.php";

foreach (array_merge($autoload, (array) $autoload_platform) as $class) {
    if (realpath(dirname(__DIR__) . $class . '.php')) {
        require_once dirname(__DIR__) . $class . '.php';
    }
}

$dependencies = require_once __DIR__ . '/dependencies.php';

cvd_config()->plugin($platform)->setup([
    'base_path' => cvd_config()->platform()->basePath(),
    'plugin_path' => cvd_config()->platform()->pluginPath(),
]);

if (count($dependencies) !== 0) {
    cvd_logger()->critical("The required dependencies are missing: " . implode(', ', $dependencies));

    cvd_config()->platform()->terminate();
}