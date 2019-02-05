<?php

use MadeiraMadeira\Framework\App\Http;

try {
    /** @var \Zend\ServiceManager\ServiceManager $serviceManager */
    $serviceManager = require dirname(__DIR__) . '/app/bootstrap.php';

} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}

$bootstrap = \MadeiraMadeira\Framework\App\Bootstrap::create($serviceManager, BP);
$application = $bootstrap->createApplication(Http::class, $bootstrap->getRoutes());
$bootstrap->run($application);
