<?php

namespace piotrbaczek\rsaexamples\tests\rsa;

use phpseclib3\Exception\NoKeyLoadedException;
use phpseclib3\Math\BigInteger;
use PHPUnit\Framework\TestCase;
use piotrbaczek\rsaexamples\Rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\Rsa\DecryptionExample;
use piotrbaczek\rsaexamples\Rsa\EncryptionExample;
use piotrbaczek\rsaexamples\Rsa\KeyGenerator;
use piotrbaczek\rsaexamples\Rsa\PrivateKeyInfo;
use piotrbaczek\rsaexamples\Rsa\PublicKeyInfo;
use ReflectionException;

class RsaTest extends TestCase
{
    /** @var false|string $keysPath */
    private string|false $keysPath;

    /** @var string $privateKeyFileName */
    private string $privateKeyFileName;

    /** @var string $publicKeyFileName */
    private string $publicKeyFileName;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');
        $this->privateKeyFileName = 'private.pem';
        $this->publicKeyFileName = 'public.pem';
    }

    public function testGeneratingKey(): void
    {
        $keyGenerator = new KeyGenerator(new RsaWrapper());

        $this->assertTrue(
            $keyGenerator->generate(
                KeyGenerator::MY_PRIVATE_KEY_PASSWORD,
                $this->keysPath,
                $this->privateKeyFileName,
                $this->publicKeyFileName
            )
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testPrivateKeyCanBeRead(): void
    {
        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());
        $privateKeyInfo->loadKey(
            $this->keysPath . DIRECTORY_SEPARATOR . $this->privateKeyFileName,
            KeyGenerator::MY_PRIVATE_KEY_PASSWORD
        );

        $primes = $privateKeyInfo->getPrimes();

        $this->assertIsArray($primes);
        $this->assertCount(2, $primes);

        foreach ($primes as $key => $prime) {
            $this->assertInstanceOf(BigInteger::class, $prime);
        }

        $modulus = $privateKeyInfo->getModulus();
        $this->assertInstanceOf(BigInteger::class, $modulus);

        $publicExponent = $privateKeyInfo->getPublicExponent();
        $this->assertInstanceOf(BigInteger::class, $publicExponent);
    }

    public function testsThrowExceptionIfPrivateKeyPasswordIncorrect()
    {
        $this->expectException(NoKeyLoadedException::class);
        $this->expectExceptionMessage('Unable to read key');

        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());
        $privateKeyInfo->loadKey(
            $this->keysPath . DIRECTORY_SEPARATOR . $this->privateKeyFileName,
            'someOtherPassword'
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testPublicKeyCanBeRead(): void
    {
        $publicKeyInfo = new PublicKeyInfo(new RsaWrapper());
        $publicKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . $this->publicKeyFileName);

        $publicExponent = $publicKeyInfo->getPublicExponent();
        $this->assertInstanceOf(BigInteger::class, $publicExponent);

        $modulus = $publicKeyInfo->getModulus();
        $this->assertInstanceOf(BigInteger::class, $modulus);
    }

    /**
     *
     */
    public function testEncryptionDecryption(): void
    {
        $message = 'My private message';
        $rsaWrapper = new RsaWrapper();

        $encryptionExample = new EncryptionExample($rsaWrapper);

        $publicKeyInfo = new PublicKeyInfo($rsaWrapper);
        $publicKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . $this->publicKeyFileName);

        $cipherText = $encryptionExample->encrypt($publicKeyInfo->getKey(), $message);

        $this->assertIsString($cipherText);

        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());
        $privateKeyInfo->loadKey(
            $this->keysPath . DIRECTORY_SEPARATOR . $this->privateKeyFileName,
            KeyGenerator::MY_PRIVATE_KEY_PASSWORD
        );

        $decryptionExample = new DecryptionExample($rsaWrapper);
        $revertedMessage = $decryptionExample->decrypt($privateKeyInfo->getKey(), $cipherText);

        $this->assertEquals($message, $revertedMessage);
    }
}