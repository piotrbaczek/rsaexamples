<?php

namespace piotrbaczek\rsaexamples\Rsa\Common;

use phpseclib3\Crypt\Common\PublicKey;

class PublicKeyWrapper extends KeyWrapper
{
    public function __construct(PublicKey $publicKey)
    {
        parent::__construct($publicKey);
    }

    public function encrypt(string $message)
    {
        return $this->getAsymmetricKey()->encrypt($message);
    }

    public function toString(string $type): string
    {
        return $this->getAsymmetricKey()->toString($type);
    }
}