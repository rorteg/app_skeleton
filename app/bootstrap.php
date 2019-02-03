<?php

/**
 * Environment initialization
 */

use Zend\Config\Factory;
use Zend\ServiceManager\ServiceManager;

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BP', dirname(__DIR__));

/* PHP version validation */
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 70000) {
    if (PHP_SAPI == 'cli') {
        echo 'This app supports PHP 7 or later. ';
    } else {
        echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <p>This app supports PHP 7 or later.</p>
</div>
HTML;
    }
    exit(1);
}

// Setup/verify autoloading
if (file_exists($a = __DIR__ . '/../../../autoload.php')) {
    require $a;
} elseif (file_exists($a = __DIR__ . '/../vendor/autoload.php')) {
    require $a;
} elseif (file_exists($a = __DIR__ . '/../autoload.php')) {
    require $a;
} else {
    fwrite(STDERR, 'Cannot locate autoloader; please run "composer install"' . PHP_EOL);
    exit(1);
}

date_default_timezone_set('America/Sao_Paulo');

// Modules Settings
$modulesConfig = Factory::fromFiles(glob('app/code/*/config/*.*'), true);

// Global Settings
$globalConfig = Factory::fromFiles(glob('app/config/*.*'), true);
$configMerged = $modulesConfig->merge($globalConfig)->toArray();

$serviceManager = new ServiceManager();

if (isset($configMerged['dependencies'])) {
    $serviceManager->configure($configMerged['dependencies']);
}

$serviceManager->setService('config', $configMerged);

return $serviceManager;