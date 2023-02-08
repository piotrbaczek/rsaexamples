<?php

namespace piotrbaczek\rsaexamples\rsa;

use piotrbaczek\rsaexamples\rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;
use ReflectionObject;

class PrivateKeyInfo
{
    /** @var RsaInterface $rsa */
    private $rsa;

    /** @var PrivateKeyWrapper $key */
    private $key;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function loadKey(string $path, string $password): bool
    {
        $privateContents = file_get_contents($path);

        $this->key = $this->rsa->loadPrivateKey($privateContents, $password);

        return true;
    }

    public function getPrimes()
    {
        return $this->key->getPrimes();
    }
}