<?php

$dependencies = [
    'openssl',
    'curl',
];

foreach ($dependencies as $key => $dependency) {
    if (extension_loaded($dependency)) {
        unset($dependencies[$key]);
    }
}

return (array) $dependencies;