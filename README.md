# Rector rules for the TYPO3 schema extension

This package provides [Rector](https://github.com/rectorphp/rector) rules for migrating code
from older versions of the TYPO3 extension [schema](https://extensions.typo3.org/extension/schema).

The following rules are available:

## RenameSchemaManagerSetMainEntityOfWebPageRector

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
