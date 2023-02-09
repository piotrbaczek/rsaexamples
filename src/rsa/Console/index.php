<?php

include './../../../vendor/autoload.php';

use piotrbaczek\rsaexamples\rsa\Console\EncryptionInfo;
use piotrbaczek\rsaexamples\rsa\Console\PrivateKeyInfo;
use piotrbaczek\rsaexamples\rsa\Console\PublicKeyInfo;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new PublicKeyInfo('rsa:pub_key_info'));
$application->add(new PrivateKeyInfo('rsa:priv_key_info'));
$application->add(new EncryptionInfo('rsa:encrypt'));

$application->run();