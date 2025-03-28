<?php

namespace piotrbaczek\rsaexamples\Rsa\Common;

interface RsaInterface
{
    /**
     * @param int $bits
     * @return mixed
     */
    public function createKey(int $bits = 2048): mixed;

    /**
     * Load privateKey
     * @param string $key
     * @param string $password
     * @return PrivateKeyWrapper
     */
    public function loadPrivateKey(string $key, string $password = ''): PrivateKeyWrapper;

    /**
     * Load public key
     * @param string $key
     * @return PublicKeyWrapper
     */
    public function loadPublicKey(string $key): PublicKeyWrapper;

    /**
     * Encrypt message
     * @param PublicKeyWrapper $publicKeyWrapper
     * @param string $message
     * @return string
     */
    public function encrypt(PublicKeyWrapper $publicKeyWrapper, string $message): string;

    /**
     * Decrypts ciphertext
     * @param PrivateKeyWrapper $privateKeyWrapper
     * @param string $cipherText
     * @return string
     */
    public function decrypt(PrivateKeyWrapper $privateKeyWrapper, string $cipherText): string;
}