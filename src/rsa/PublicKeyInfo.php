<?php

namespace piotrbaczek\rsaexamples\rsa;

use phpseclib3\Math\BigInteger;
use piotrbaczek\rsaexamples\rsa\Common\PublicKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;
use ReflectionException;

class PublicKeyInfo
{
    /** @var RsaInterface $rsa */
    private $rsa;

    /** @var PublicKeyWrapper $key */
    private $key;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function loadKey(string $path)
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
}