<?php

include '../phpseclib/vendor/autoload.php';

$rsa = new \phpseclib\Crypt\RSA();
$public = file_get_contents('public.pem');
$rsa->loadKey($public);
$rsa->setHash('sha512');
$rsa->setMGFHash('sha512');

echo 'n= ' . $rsa->modulus . PHP_EOL;

echo 'e= ' . $rsa->exponent . PHP_EOL;

echo 'Bits: ' . $rsa->getSize() . ' bits.' . '(' . strlen($rsa->modulus) . ')' . PHP_EOL;

echo PHP_EOL;

echo $rsa->getPublicKey(\phpseclib\Crypt\RSA::PUBLIC_FORMAT_PKCS1) . PHP_EOL;
