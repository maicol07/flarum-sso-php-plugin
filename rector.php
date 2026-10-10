<?php /** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\Config\RectorConfig;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/documentation/doctum.config.php',
        __DIR__ . '/example',
        __DIR__ . '/src',
    ])
    ->withPhpSets(php83: true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        naming: true,
        instanceOf: true,
        earlyReturn: true,
    )
    ->withSkip([
        RenameParamToMatchTypeRector::class,
        CatchExceptionNameMatchingTypeRector::class,
    ]);
