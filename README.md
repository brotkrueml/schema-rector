# Rector rules for the TYPO3 schema extension

[![CI Status](https://github.com/brotkrueml/schema-rector/workflows/CI/badge.svg?branch=master)](https://github.com/brotkrueml/schema-rector/actions?query=workflow%3ACI)

This package provides [Rector](https://github.com/rectorphp/rector) rules for migrating code
from older versions of the TYPO3 extension [schema](https://extensions.typo3.org/extension/schema).

**Note:** If you don't know already, you can also migrate TYPO3 core-specific
code with [Rector for TYPO3](https://github.com/sabbelasichon/typo3-rector/).

## Installation

The package can be installed with composer:

```bash
composer req --dev brotkrueml/schema-rector:dev-master@dev
```

**Caution:** Never run this tool on production, only on development environment where code is
under version control (e.g. git). Always review and test automatic changes before releasing
to production.

## Configuration

Create a `rector.php` file in the project's root folder:

```php
<?php

declare(strict_types=1);

use Brotkrueml\SchemaRector\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector;use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameSchemaManagerSetMainEntityOfWebPageRector::class);
};
```

Afterwards you can start a dry-run to see the possible changes
(assuming the extensions of your projects are available under the
`packages` folder):

```bash
vendor/bin/rector process packages --dry-run
```

If everything is okay for you than you can omit the `dry-run` option
to write the changes to your code.

## Rules

The following rules are available:

### RenameSchemaManagerSetMainEntityOfWebPageRector

This Rector migrates the deprecated `SchemaManager->setMainEntityOfWebPage()`
method call to the new `SchemaManager->addMainEntityOfWebPage()`.

:wrench: **configure it!**

- class: [`Brotkrueml\SchemaRector\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector`](rules/RenameSchemaManagerSetMainEntityOfWebPageRector.php)

```php
use Brotkrueml\SchemaRector\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameSchemaManagerSetMainEntityOfWebPageRector::class);
};
```

↓

```diff
 $schemaManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(Brotkrueml\Schema\Manager\SchemaManager::class);
 $type = new \Brotkrueml\Schema\Model\Type\Thing();
-$schemaManager->setMainEntityOfPage($type);
+$schemaManager->addMainEntityOfPage($type);
```
