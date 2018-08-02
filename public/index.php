<?php

use Xervice\Core\Locator\Locator;

require_once dirname(__DIR__) . '/vendor/autoload.php';

putenv('APPLICATION_PATH=' . dirname(__DIR__));
$locator = Locator::getInstance();

$kernel = $locator->kernel()->facade();
$kernel->boot();
$kernel->run();