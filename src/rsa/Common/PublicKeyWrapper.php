<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

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

    public function toString(string $type)
    {
        return $this->getAsymmetricKey()->toString($type);
    }
}