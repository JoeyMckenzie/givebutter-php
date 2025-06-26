<?php

declare(strict_types=1);

namespace Tests;

use Wrapkit\Contracts\ResponseContract;

arch()->preset()->php();
arch()->preset()->security();

arch('All source files are strictly typed')
    ->expect('Givebutter\\')
    ->toUseStrictTypes();

arch('All tests files are strictly typed')
    ->expect('Tests\\')
    ->toUseStrictTypes();

arch('Value objects should be immutable')
    ->expect('Givebutter\\ValueObjects\\')
    ->toBeFinal()
    ->and('Givebutter\\ValueObjects\\')
    ->toBeReadonly();

arch('Responses should be immutable and implement response contracts')
    ->expect('Givebutter\\Responses\\')
    ->classes()
    ->toBeFinal()
    ->and('Givebutter\\Responses\\')
    ->classes()
    ->toBeReadonly()
    ->and('Givebutter\\Responses\\')
    ->classes()
    ->toImplement(ResponseContract::class);

arch('Resources should be final')
    ->expect('Givebutter\\Resources\\')
    ->classes()
    ->toBeFinal();

arch('Contracts should be abstract')
    ->expect('Givebutter\\Contracts\\')
    ->toBeInterfaces()
    ->toHaveSuffix('Contract');

arch('All Enums are backed')
    ->expect('Givebutter\\Enums\\')
    ->toBeStringBackedEnums();
