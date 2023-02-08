<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Math\BigInteger;
use ReflectionException;
use ReflectionObject;

abstract class KeyWrapper
{
    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getModulus(): BigInteger
    {
        $reflectionObject = new ReflectionObject($this->getBaseObject());
        $modulus = $reflectionObject->getProperty('modulus');
        $modulus->setAccessible(true);

        return $modulus->getValue($this->getBaseObject());
    }

    /**
     * @return BigInteger
     * @throws ReflectionException
     */
    public function getPublicExponent(): BigInteger
    {
        $reflectionObject = new ReflectionObject($this->getBaseObject());
        $publicExponent = $reflectionObject->getProperty('publicExponent');
        $publicExponent->setAccessible(true);

        return $publicExponent->getValue($this->getBaseObject());
    }

    abstract protected function getBaseObject();
}