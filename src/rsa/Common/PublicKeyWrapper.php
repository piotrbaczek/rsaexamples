<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\Common\PublicKey;

class PublicKeyWrapper extends KeyWrapper
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

    protected function getBaseObject()
    {
        return $this->publicKey;
    }
}