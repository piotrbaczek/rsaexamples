<?php

namespace piotrbaczek\rsaexamples\rsa;

use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;
use ReflectionException;

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

    /**
     * @return PrivateKeyWrapper
     */
    public function getKey(): PrivateKeyWrapper
    {
        return $this->key;
    }

    public function loadKey(string $path, string $password): bool
    {
        $privateContents = file_get_contents($path);

        $this->key = $this->rsa->loadPrivateKey($privateContents, $password);

        return true;
    }

    /**
     * @return BigInteger[]
     * @throws ReflectionException
     */
    public function getPrimes()
    {
        return $this->key->getPrimes();
    }

    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getModulus(): BigInteger
    {
        return $this->key->getModulus();
    }

    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getPublicExponent(): BigInteger
    {
        return $this->key->getPublicExponent();
    }
}