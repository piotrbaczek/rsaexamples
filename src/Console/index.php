<?php

include __DIR__ . '/../../vendor/autoload.php';

use piotrbaczek\rsaexamples\Console\Aes\EncryptionInfo as AesEncryptionInfo;
use piotrbaczek\rsaexamples\Console\Rsa\EncryptionInfo as RsaEncryptionInfo;
use piotrbaczek\rsaexamples\Console\Rsa\GenerateKey;
use piotrbaczek\rsaexamples\Console\Rsa\PrivateKeyInfo;
use piotrbaczek\rsaexamples\Console\Rsa\PublicKeyInfo;
use Symfony\Component\Console\Application;

$application = new Application();
$application->addCommand(new PublicKeyInfo('rsa:pub_key_info'));
$application->addCommand(new PrivateKeyInfo('rsa:priv_key_info'));
$application->addCommand(new RsaEncryptionInfo('rsa:encrypt'));

$application->addCommand(new AesEncryptionInfo('aes:encrypt'));
$application->addCommand(new GenerateKey('rsa:generate_key'));

$application->run();