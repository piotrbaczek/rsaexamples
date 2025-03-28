<?php

namespace piotrbaczek\rsaexamples\Aes;

use piotrbaczek\rsaexamples\Aes\Common\AesInterface;

class EncryptionExample
{
    /** @var AesInterface $aes */
    private AesInterface $aes;

    public function __construct(AesInterface $aes)
    {
        $this->aes = $aes;
    }

    public function encrypt(string $message): string
    {
        return $this->aes->encrypt($message);
    }
}