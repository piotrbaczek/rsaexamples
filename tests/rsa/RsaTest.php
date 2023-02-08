<?php

use phpseclib3\Exception\NoKeyLoadedException;
use phpseclib3\Math\BigInteger;
use PHPUnit\Framework\TestCase;
use piotrbaczek\rsaexamples\rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\rsa\KeyGenerator;
use piotrbaczek\rsaexamples\rsa\PrivateKeyInfo;
use piotrbaczek\rsaexamples\rsa\PublicKeyInfo;

class RsaTest extends TestCase
{
    /** @var false|string $keysPath */
    private $keysPath;

    /** @var string $privateKeyFileName */
    private $privateKeyFileName;

    /** @var string $publicKeyFileName */
    private $publicKeyFileName;

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
        $privateKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . $this->privateKeyFileName, KeyGenerator::MY_PRIVATE_KEY_PASSWORD);

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
        $privateKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . 'private.pem', 'someOtherPassword');
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
}