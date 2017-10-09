<?php

include '../phpseclib/vendor/autoload.php';
$rsa = new \phpseclib\Crypt\RSA();

extract($rsa->createKey(2048));

$publickey2 = new \phpseclib\Crypt\RSA();
$publickey2->loadKey($publickey);
$publickey2->setHash('sha512');
$publickey2->setMGFHash('sha512');

$privatekey2 = new \phpseclib\Crypt\RSA();
$privatekey2->loadKey($privatekey);
$privatekey2->setHash('sha512');
$privatekey2->setMGFHash('sha512');

$password = substr(base64_encode(openssl_random_pseudo_bytes(45)),0,32);

$privatekey2->setPassword($password);

$fileprivate = fopen('private.pem', 'w');
fwrite($fileprivate, $privatekey2->getPrivateKey('PKCS1'));
fclose($fileprivate);

$filepublic = fopen('public.pem', 'w');
fwrite($filepublic, $publickey2->getPublicKey('PKCS1'));
fclose($filepublic);

echo 'Keys has been generated'."\r\n";
echo 'Password is: '.$password;