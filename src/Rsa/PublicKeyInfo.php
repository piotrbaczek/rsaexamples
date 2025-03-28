<?php

namespace piotrbaczek\rsaexamples\Rsa;

use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\Rsa\Common\PublicKeyWrapper;
use piotrbaczek\rsaexamples\Rsa\Common\RsaInterface;
use ReflectionException;

class PublicKeyInfo
{
    /** @var RsaInterface $rsa */
    private RsaInterface $rsa;

    /** @var PublicKeyWrapper $key */
    private PublicKeyWrapper $key;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function loadKey(string $path): true
    {
        $publicFileContents = file_get_contents($path);

        $this->key = $this->rsa->loadPublicKey($publicFileContents);

        return true;
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

    /**
     * @return PublicKeyWrapper
     */
    public function getKey(): PublicKeyWrapper
    {
        return $this->key;
    }
}