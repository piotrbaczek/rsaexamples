<?php

namespace piotrbaczek\rsaexamples\Rsa;

use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\Rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\Rsa\Common\RsaInterface;
use ReflectionException;

class PrivateKeyInfo
{
    /** @var RsaInterface $rsa */
    private RsaInterface $rsa;

    /** @var PrivateKeyWrapper $key */
    private PrivateKeyWrapper $key;

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
    public function getPrimes(): array
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