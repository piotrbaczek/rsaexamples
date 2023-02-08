<?php


namespace piotrbaczek\rsaexamples\rsa;


interface RsaInterface
{
    /**
     * @param int $bits
     * @return mixed
     */
    public function createKey($bits = 2048);
}