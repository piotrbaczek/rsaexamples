<?php


namespace piotrbaczek\rsaexamples\rsa;


use phpseclib3\Crypt\RSA;

class KeyGenerator
{
    /**
     * @var RSA
     */
    private $rsa;

    public function __construct(RSA $rsa)
    {
        $this->rsa = $rsa;
    }
}