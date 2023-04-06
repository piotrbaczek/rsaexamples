<?php

namespace piotrbaczek\rsaexamples\Aes\Common;

interface AesInterface
{
    public function setKey(string $key): self;

    public function setKeyLength(int $length): self;

    public function encrypt(string $message): string;

    public function decrypt(string $cipherText): string;
}