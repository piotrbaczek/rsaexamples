<?php

namespace piotrbaczek\rsaexamples\rsa\Common;

interface RsaInterface
{
    /**
     * @param int $bits
     * @return mixed
     */
    public function createKey($bits = 2048);

    /**
     * Load privateKey
     * @param string $key
     * @param string $password
     * @return PrivateKeyWrapper
     */
    public function loadPrivateKey(string $key, string $password = ''): PrivateKeyWrapper;
}