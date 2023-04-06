<?php

include './../../vendor/autoload.php';

use piotrbaczek\rsaexamples\Console\Aes\EncryptionInfo as AesEncryptionInfo;
use piotrbaczek\rsaexamples\Console\Rsa\EncryptionInfo as RsaEncryptionInfo;
use piotrbaczek\rsaexamples\Console\Rsa\PrivateKeyInfo;
use piotrbaczek\rsaexamples\Console\Rsa\PublicKeyInfo;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new PublicKeyInfo('rsa:pub_key_info'));
$application->add(new PrivateKeyInfo('rsa:priv_key_info'));
$application->add(new RsaEncryptionInfo('rsa:encrypt'));

$application->add(new AesEncryptionInfo('aes:encrypt'));

$application->run();