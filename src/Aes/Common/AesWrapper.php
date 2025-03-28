<?php

namespace piotrbaczek\rsaexamples\Aes\Common;

use Exception;
use phpseclib3\Crypt\AES;

class AesWrapper implements AesInterface
{
    /** @var AES $aes */
    private AES $aes;

    public function __construct(AES $aes)
    {
        $this->aes = $aes;
    }

    public function setKey(string $key): AesInterface
    {
        $this->aes->setKey($key);

        return $this;
    }

    public function setKeyLength(int $length): AesInterface
    {
        $this->aes->setKeyLength($length);

        return $this;
    }

    /**
     * @param string $message
     * @return string
     * @throws Exception
     */
    public function encrypt(string $message): string
    {
        $this->aes->setIV(random_bytes(16));
        return $this->aes->encrypt($message);
    }

    public function decrypt(string $cipherText): string
    {
        return $this->aes->decrypt($cipherText);
    }
}