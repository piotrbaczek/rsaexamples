<?php


namespace piotrbaczek\rsaexamples\rsa;


class KeyGenerator
{
    public const PUBLIC_PASSWORD = 'SOME_SECRET_PASSWORD';

    /** @var RsaWrapper $rsa */
    private $rsa;

    public function __construct(RsaWrapper $rsa)
    {
        $this->rsa = $rsa;
    }

    /**
     * Generates private key
     * @return bool
     */
    public function generate(): bool
    {
        $privateKey = $this->rsa->createKey(2048);
        $privateKeyAsString = $privateKey->withPassword(self::PUBLIC_PASSWORD)->toString('PKCS8');

        $publicKeyAsString = $privateKey->getPublicKey()->toString('PKCS8');

        $directory = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');

        $privateKeyBytesSaved = file_put_contents($directory . DIRECTORY_SEPARATOR . 'private.pem', $privateKeyAsString) !== false;
        $publicKeyBytesSaved = file_put_contents($directory . DIRECTORY_SEPARATOR . 'public.pem', $publicKeyAsString) !== false;

        return $privateKeyBytesSaved && $publicKeyBytesSaved;
    }
}