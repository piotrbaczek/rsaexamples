<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\Common\PrivateKey;
use phpseclib3\Math\BigInteger;
use ReflectionException;
use ReflectionObject;

class PrivateKeyWrapper extends KeyWrapper
{
    /** @var PrivateKey $privateKey */
    private $privateKey;

    public function __construct(PrivateKey $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return PublicKeyWrapper
     */
    public function getPublicKey(): PublicKeyWrapper
    {
        return new PublicKeyWrapper($this->privateKey->getPublicKey());
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->privateKey = $this->privateKey->withPassword($password);

        return $this;
    }

    /**
     * @return BigInteger[]
     * @throws ReflectionException
     */
    public function getPrimes(): array
    {
        $reflectionObject = new ReflectionObject($this->privateKey);
        $primes = $reflectionObject->getProperty('primes');
        $primes->setAccessible(true);

        return $primes->getValue($this->privateKey);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function toString(string $type)
    {
        return $this->privateKey->toString($type);
    }

    protected function getBaseObject()
    {
        return $this->privateKey;
    }
}