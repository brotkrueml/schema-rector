<?php

namespace Brotkrueml\SchemaRector\Tests\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector\Fixture;

use Brotkrueml\Schema\Manager\SchemaManager;
use Brotkrueml\Schema\Model\Type\Thing;

class Fixture
{
    public function run(SchemaManager $schemaManager)
    {
        $type = new Thing();
        $schemaManager->setMainEntityOfWebPage($type);
    }
}

?>
-----
<?php

namespace Brotkrueml\SchemaRector\Tests\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector\Fixture;

use Brotkrueml\Schema\Manager\SchemaManager;
use Brotkrueml\Schema\Model\Type\Thing;

class Fixture
{
    public function run(SchemaManager $schemaManager)
    {
        $type = new Thing();
        $schemaManager->addMainEntityOfWebPage($type);
    }
}

?>
