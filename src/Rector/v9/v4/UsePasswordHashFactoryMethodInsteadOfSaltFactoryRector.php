<?php

declare(strict_types=1);


namespace Ssch\TYPO3Rector\Rector\v9\v4;


use PhpParser\Node;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

class UsePasswordHashFactoryMethodInsteadOfSaltFactoryRector extends AbstractRector
{

    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Various public properties in favor of Context API',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
$username = 'example';
PasswordHashFactory::getSaltingInstance()->getHashedPassword(random_bytes(32) . '|' . $username);
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
$username = 'example';
GeneralUtility::makeInstance(PasswordHashFactory::class)->getDefaultHashInstance('FE')->getHashedPassword(random_bytes(32) . '|' . $username);
CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        // TODO: Implement getNodeTypes() method.
    }

    public function refactor(Node $node)
    {
        // if ($this->shouldSkip($node)) {
        //     return null;
        // }


        return $this->nodeFactory->createMethodCall(
            $this->nodeFactory->createStaticCall('TYPO3\CMS\Core\Utility\GeneralUtility', 'makeInstance', [
                $this->nodeFactory->createClassConstReference('\TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory'),
            ]),
            'getPropertyFromAspect',
            ['language', $property]
        );
    }
}
