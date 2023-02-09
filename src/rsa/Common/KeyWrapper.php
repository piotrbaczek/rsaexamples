<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\Common\AsymmetricKey;
use phpseclib3\Crypt\Common\PrivateKey;
use phpseclib3\Math\BigInteger;
use ReflectionException;
use ReflectionObject;

abstract class KeyWrapper
{
    /**
     * @var AsymmetricKey
     */
    private $asymmetricKey;

    public function __construct(AsymmetricKey $key)
    {
        $this->asymmetricKey = $key;
    }

    /**
     * @return AsymmetricKey
     */
    protected function getAsymmetricKey(): AsymmetricKey
    {
        return $this->asymmetricKey;
    }

    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getModulus(): BigInteger
    {
        $reflectionObject = new ReflectionObject($this->asymmetricKey);
        $modulus = $reflectionObject->getProperty('modulus');
        $modulus->setAccessible(true);

        return $modulus->getValue($this->asymmetricKey);
    }

    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getPublicExponent(): BigInteger
    {
        $reflectionObject = new ReflectionObject($this->asymmetricKey);
        $publicExponent = $reflectionObject->getProperty('publicExponent');
        $publicExponent->setAccessible(true);

        return $publicExponent->getValue($this->asymmetricKey);
    }

    public function setPassword(string $password)
    {
        if ($this->asymmetricKey instanceof PrivateKey) {
            $this->asymmetricKey = $this->asymmetricKey->withPassword($password);
        }

        return $this;
    }
}