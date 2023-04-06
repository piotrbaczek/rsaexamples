<?php

namespace piotrbaczek\rsaexamples\Aes;

use piotrbaczek\rsaexamples\Aes\Common\AesInterface;

class DecryptionExample
{
    /** @var AesInterface $aes */
    private $aes;

    public function __construct(AesInterface $aes)
    {
        $this->aes = $aes;
    }

    public function decrypt(string $cipherText): string
    {
        return $this->aes->decrypt($cipherText);
    }
}