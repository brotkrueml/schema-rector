<?php

declare(strict_types=1);

/**
 * This file is part of brotkrueml/schema-rector.
 *
 * For the full copyright and license information, please view the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\SchemaRector\Rules;

use Brotkrueml\Schema\Manager\SchemaManager;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://docs.typo3.org/p/brotkrueml/schema/1.11/en-us/Developer/Deprecations.html#cmdoption-arg-brotkrueml-schema-manager-schemamanager-setmainentityofwebpage
 *
 * @see \Brotkrueml\SchemaRector\Tests\Rules\RenameSchemaManagerSetMainEntityOfWebPageRector\RenameSchemaManagerSetMainEntityOfWebPageRectorTest
 */
final class RenameSchemaManagerSetMainEntityOfWebPageRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Fixes deprecated Brotkrueml\\Schema\\Manager\\SchemaManager->setMainEntityOfWebPage() calls', [
            new CodeSample(
                <<<'CODE_SAMPLE'
Brotkrueml\Schema\Manager\SchemaManager->setMainEntityOfWebPage($mainEntity);
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
Brotkrueml\Schema\Manager\SchemaManager->addMainEntityOfWebPage($mainEntity)
CODE_SAMPLE
            )
        ]);
    }

    /**
     * @return array<class-string<\PhpParser\Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->nodeTypeResolver->isObjectType($node, new ObjectType(SchemaManager::class))) {
            return null;
        }

        if (!$this->isName($node->name, 'setMainEntityOfWebPage')) {
            return null;
        }

        return $this->nodeFactory->createMethodCall($node->var, 'addMainEntityOfWebPage', $node->args);
    }
}
