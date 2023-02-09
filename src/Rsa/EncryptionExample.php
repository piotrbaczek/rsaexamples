<?php

namespace piotrbaczek\rsaexamples\Rsa;

use piotrbaczek\rsaexamples\Rsa\Common\PublicKeyWrapper;
use piotrbaczek\rsaexamples\Rsa\Common\RsaInterface;

class EncryptionExample
{
    /** @var RsaInterface $rsa */
    private $rsa;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function encrypt(PublicKeyWrapper $publicKeyWrapper, string $message)
    {
        return $this->rsa->encrypt($publicKeyWrapper, $message);
    }
}