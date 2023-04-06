<?php

include './../../vendor/autoload.php';

use piotrbaczek\rsaexamples\Console\Rsa\EncryptionInfo;
use piotrbaczek\rsaexamples\Console\Rsa\PrivateKeyInfo;
use piotrbaczek\rsaexamples\Console\Rsa\PublicKeyInfo;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new PublicKeyInfo('rsa:pub_key_info'));
$application->add(new PrivateKeyInfo('rsa:priv_key_info'));
$application->add(new EncryptionInfo('rsa:encrypt'));

$application->run();