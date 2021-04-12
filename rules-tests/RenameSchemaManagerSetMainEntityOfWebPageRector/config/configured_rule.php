<?php

declare(strict_types=1);

/**
 * This file is part of brotkrueml/schema-rector.
 *
 * For the full copyright and license information, please view the
 * LICENSE.txt file that was distributed with this source code.
 */

use Brotkrueml\SchemaRector\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameSchemaManagerSetMainEntityOfWebPageRector::class);
};
