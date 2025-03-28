<?php

namespace piotrbaczek\rsaexamples\Rsa;

use piotrbaczek\rsaexamples\Rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\Rsa\Common\RsaInterface;

class DecryptionExample
{
    /** @var RsaInterface $rsa */
    private RsaInterface $rsa;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function decrypt(PrivateKeyWrapper $privateKeyWrapper, string $cipherText): string
    {
        return $this->rsa->decrypt($privateKeyWrapper, $cipherText);
    }
}