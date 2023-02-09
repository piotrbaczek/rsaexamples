<?php

namespace piotrbaczek\rsaexamples\Rsa\Common;

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

    /**
     * Encrypt message
     * @param PublicKeyWrapper $publicKeyWrapper
     * @param string $message
     * @return string
     */
    public function encrypt(PublicKeyWrapper $publicKeyWrapper, string $message): string
    {
        return $publicKeyWrapper->encrypt($message);
    }

    /**
     * Decrypt ciphertext
     * @param PrivateKeyWrapper $privateKeyWrapper
     * @param string $cipherText
     * @return string
     */
    public function decrypt(PrivateKeyWrapper $privateKeyWrapper, string $cipherText): string
    {
        return $privateKeyWrapper->decrypt($cipherText);
    }
}