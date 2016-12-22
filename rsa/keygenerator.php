<?php

include '../phpseclib/vendor/autoload.php';
$rsa = new \phpseclib\Crypt\RSA();

extract($rsa->createKey(2048));
$publickey->setHash('sha512');
$publickey->setMGFHash('sha512');

$privatekey->setHash('sha512');
$privatekey->setMGFHash('sha512');

$password = substr(base64_encode(openssl_random_pseudo_bytes(45)),0,32);

$privatekey->setPassword($password);

//phpseclib\Crypt\RSA\PKCS1::setEncryptionAlgorithm('AES-256-CBC');

$fileprivate = fopen('private.pem', 'w');
fwrite($fileprivate, $privatekey->getPrivateKey('PKCS1'));
fclose($fileprivate);

$filepublic = fopen('public.pem', 'w');
fwrite($filepublic, $publickey->getPublicKey('PKCS1'));
fclose($filepublic);

echo 'Keys has been generated'."\r\n";
echo 'Password is: '.$password;