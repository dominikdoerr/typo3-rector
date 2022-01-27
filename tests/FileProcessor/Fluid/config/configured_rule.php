<?php

declare(strict_types=1);

use Ssch\TYPO3Rector\FileProcessor\Fluid\Rector\DefaultSwitchFluidRector;
use Ssch\TYPO3Rector\FileProcessor\Fluid\Rector\RemoveUseCacheHashFluidRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../config/config_test.php');
    $services = $containerConfigurator->services();
    $services->set(DefaultSwitchFluidRector::class);
    $services->set(RemoveUseCacheHashFluidRector::class);
};
