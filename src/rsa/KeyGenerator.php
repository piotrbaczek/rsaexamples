<?php

namespace piotrbaczek\rsaexamples\rsa;

use piotrbaczek\rsaexamples\rsa\Common\PrivateKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;

class KeyGenerator
{
    public const PUBLIC_PASSWORD = 'SOME_SECRET_PASSWORD';

    /** @var RsaInterface $rsa */
    private $rsa;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    /**
     * Generates private key
     * @param string $password
     * @param string $directoryPath
     * @return bool
     */
    public function generate(string $password, string $directoryPath): bool
    {
        /** @var PrivateKeyWrapper $privateKey */
        $privateKey = $this->rsa->createKey(2048);
        $privateKeyAsString = $privateKey->setPassword($password)->toString('PKCS8');

        $publicKeyAsString = $privateKey->getPublicKey()->toString('PKCS8');

        $privateKeySaved = file_put_contents($directoryPath . DIRECTORY_SEPARATOR . 'private.pem', $privateKeyAsString) !== false;
        $publicKeySaved = file_put_contents($directoryPath . DIRECTORY_SEPARATOR . 'public.pem', $publicKeyAsString) !== false;

        return $privateKeySaved && $publicKeySaved;
    }
}