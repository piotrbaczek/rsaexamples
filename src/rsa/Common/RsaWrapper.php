<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

use phpseclib3\Crypt\RSA;

class RsaWrapper implements RsaInterface
{
    /**
     * @param int $bits
     * @return PrivateKeyWrapper
     */
    public function createKey($bits = 2048): PrivateKeyWrapper
    {
        return new PrivateKeyWrapper(RSA::createKey($bits));
    }

    /**
     * Load privateKey
     * @param string $key
     * @param string $password
     * @return PrivateKeyWrapper
     */
    public function loadPrivateKey(string $key, string $password = ''): PrivateKeyWrapper
    {
        return new PrivateKeyWrapper(RSA::loadPrivateKey($key, $password));
    }

    public function loadPublicKey(string $key): PublicKeyWrapper
    {
        return new PublicKeyWrapper(RSA::loadPublicKey($key));
    }
}