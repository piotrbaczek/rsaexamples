<?php

namespace piotrbaczek\rsaexamples\rsa;

use piotrbaczek\rsaexamples\rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;

class DecryptionExample
{
    /** @var RsaInterface $rsa */
    private $rsa;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function decrypt(PrivateKeyWrapper $privateKeyWrapper, string $cipherText)
    {
        return $this->rsa->decrypt($privateKeyWrapper, $cipherText);
    }
}