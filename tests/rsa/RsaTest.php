<?php

use PHPUnit\Framework\TestCase;
use piotrbaczek\rsaexamples\rsa\KeyGenerator;
use piotrbaczek\rsaexamples\rsa\RsaWrapper;

class RsaTest extends TestCase
{
    public function testSomething()
    {
        $this->assertEquals(1, 1);
        $this->assertNotEquals(1, 0);
    }

    public function testGeneratingKey()
    {
        $keyGenerator = new KeyGenerator(new RsaWrapper());
        $this->assertTrue($keyGenerator->generate());
    }

    public function testPrivateKeyCanBeRead()
    {
        
    }
}