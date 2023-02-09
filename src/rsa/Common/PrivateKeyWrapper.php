<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\Common\PrivateKey;
use phpseclib3\Math\BigInteger;
use ReflectionException;
use ReflectionObject;

class PrivateKeyWrapper extends KeyWrapper
{
    public function __construct(PrivateKey $privateKey)
    {
        parent::__construct($privateKey);
    }

    /**
     * @return PublicKeyWrapper
     */
    public function getPublicKey(): PublicKeyWrapper
    {
        return new PublicKeyWrapper($this->getAsymmetricKey()->getPublicKey());
    }

    /**
     * @return BigInteger[]
     * @throws ReflectionException
     */
    public function getPrimes(): array
    {
        $reflectionObject = new ReflectionObject($this->getAsymmetricKey());
        $primes = $reflectionObject->getProperty('primes');
        $primes->setAccessible(true);

        return $primes->getValue($this->getAsymmetricKey());
    }

    public function decrypt(string $ciphertext)
    {
        return $this->getAsymmetricKey()->decrypt($ciphertext);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function toString(string $type)
    {
        return $this->getAsymmetricKey()->toString($type);
    }
}