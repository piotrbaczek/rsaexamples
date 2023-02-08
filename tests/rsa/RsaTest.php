<?php

use PHPUnit\Framework\TestCase;
use piotrbaczek\rsaexamples\rsa\Common\RsaWrapper;
use piotrbaczek\rsaexamples\rsa\KeyGenerator;
use piotrbaczek\rsaexamples\rsa\PrivateKeyInfo;

class RsaTest extends TestCase
{
    /**
     * @var false|string
     */
    private $keysPath;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->keysPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'keys');
    }

    public function testSomething()
    {
        $this->assertEquals(1, 1);
        $this->assertNotEquals(1, 0);
    }

    public function testGeneratingKey()
    {
        $keyGenerator = new KeyGenerator(new RsaWrapper());

        $this->assertTrue($keyGenerator->generate(KeyGenerator::PUBLIC_PASSWORD, $this->keysPath));
    }

    public function testPrivateKeyCanBeRead()
    {
        $privateKeyInfo = new PrivateKeyInfo(new RsaWrapper());
        $privateKeyInfo->loadKey($this->keysPath . DIRECTORY_SEPARATOR . 'private.pem', KeyGenerator::PUBLIC_PASSWORD);

        $primes = $privateKeyInfo->getPrimes();

        $this->assertIsArray($primes);
        $this->assertCount(2, $primes);

        foreach ($primes as $key => $prime) {
            echo 'p' . ($key) . '= ' . $prime . '(' . strlen($prime) . ')' . PHP_EOL;
        }
    }
}