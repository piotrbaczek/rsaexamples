<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\Common\PublicKey;

class PublicKeyWrapper
{
    /** @var PublicKey $publicKey */
    private $publicKey;

    public function __construct(PublicKey $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function toString(string $type)
    {
        return $this->publicKey->toString($type);
    }
}