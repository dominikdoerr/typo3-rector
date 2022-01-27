<?php

declare(strict_types=1);

namespace Ssch\TYPO3Rector\FileProcessor\Fluid\Rector;

use Nette\Utils\Strings;
use Rector\Core\ValueObject\Application\File;
use Ssch\TYPO3Rector\Contract\FileProcessor\Fluid\Rector\FluidRectorInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://docs.typo3.org/c/typo3/cms-core/main/en-us/Changelog/10.0/Deprecation-88406-SetCacheHashnoCacheHashOptionsInViewHelpersAndUriBuilder.html
 */
final class RemoveUseCacheHashFluidRector implements FluidRectorInterface
{
    /**
     * @var string
     */
    private const PATTERN = '#(<f:[form|link.typolink|link.action|link.page|uri.action|uri.page|uri.typolink|widget.link|widget.uri].*) useCacheHash=".*"#imsU';

    /**
     * @var string
     */
    private const INLINE_PATTERN = '#({f:[form|link.typolink|link.action|link.page|uri.action|uri.page|uri.typolink|widget.link|widget.uri].*) ?useCacheHash:.*,#imsU';

    public function transform(File $file): void
    {
        $content = $file->getFileContent();

        $content = Strings::replace($content, self::PATTERN, '$1');
        $content = Strings::replace($content, self::INLINE_PATTERN, '$1');

        $file->changeFileContent($content);
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove argument useCacheHash from different ViewHelpers', [
            new CodeSample(
                <<<'CODE_SAMPLE'

CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'

CODE_SAMPLE
            ),
        ]);
    }
}
