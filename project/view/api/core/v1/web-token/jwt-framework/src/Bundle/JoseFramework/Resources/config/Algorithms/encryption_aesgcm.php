<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2019 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use Jose\Component\Encryption\Algorithm\ContentEncryption;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $container) {
    $container = $container->services()->defaults()
        ->private()
        ->autoconfigure()
        ->autowire()
    ;

    $container->set(ContentEncryption\A128GCM::class)
        ->tag('jose.algorithm', ['alias' => 'A128GCM'])
    ;

    $container->set(ContentEncryption\A192GCM::class)
        ->tag('jose.algorithm', ['alias' => 'A192GCM'])
    ;

    $container->set(ContentEncryption\A256GCM::class)
        ->tag('jose.algorithm', ['alias' => 'A256GCM'])
    ;
};
