<?php

namespace piotrbaczek\rsaexamples\rsa;

use phpseclib3\Crypt\RSA;

class RsaWrapper implements RsaInterface
{
    /**
     * @param int $bits
     * @return RSA\PrivateKey
     */
    public function createKey($bits = 2048): RSA\PrivateKey
    {
        return RSA::createKey($bits);
    }
}