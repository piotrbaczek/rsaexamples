<?php

use phpseclib3\Math\BigInteger;
use PHPUnit\Framework\TestCase;
use piotrbaczek\rsaexamples\rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\rsa\KeyGenerator;
use piotrbaczek\rsaexamples\rsa\PrivateKeyInfo;

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

    public function testPrivateKeyCanBeRead()
    {
        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());
        $privateKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . 'private.pem', KeyGenerator::MY_PRIVATE_KEY_PASSWORD);

        $primes = $privateKeyInfo->getPrimes();

        $this->assertIsArray($primes);
        $this->assertCount(2, $primes);

        foreach ($primes as $key => $prime) {
            $this->assertInstanceOf(BigInteger::class, $prime);
            //echo 'p' . ($key) . '= ' . $prime . '(' . strlen($prime) . ')' . PHP_EOL;
        }
    }
}