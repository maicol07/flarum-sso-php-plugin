<?php /** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Encapsed\EncapsedStringsToSprintfRector;
use Rector\CodingStyle\Rector\Encapsed\WrapEncapsedVariableInCurlyBracesRector;
use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/documentation',
        __DIR__ . '/example',
        __DIR__ . '/src',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_80,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::NAMING,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
        SetList::STRICT_BOOLEANS,
        SetList::INSTANCEOF,
    ]);

    $rectorConfig->skip([
        EncapsedStringsToSprintfRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
        ChangeOrIfContinueToMultiContinueRector::class,
        RenameParamToMatchTypeRector::class,
        CatchExceptionNameMatchingTypeRector::class
    ]);
};
