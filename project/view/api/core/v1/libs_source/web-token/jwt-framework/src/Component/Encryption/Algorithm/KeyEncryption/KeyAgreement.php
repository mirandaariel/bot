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

namespace Jose\Component\Encryption\Algorithm\KeyEncryption;

use Jose\Component\Core\JWK;
use Jose\Component\Encryption\Algorithm\KeyEncryptionAlgorithm;

interface KeyAgreement extends KeyEncryptionAlgorithm
{
    /**
     * Computes the agreement key.
     */
    public function getAgreementKey(int $encryptionKeyLength, string $algorithm, JWK $recipientKey, ?JWK $senderKey, array $completeHeader = [], array &$additionalHeaderValues = []): string;
}