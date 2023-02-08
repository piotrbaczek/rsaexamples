<?php

include '../phpseclib/vendor/autoload.php';
$rsa = new \phpseclib\Crypt\RSA();

extract($rsa->createKey(2048));

$privatekey2 = new \phpseclib\Crypt\RSA();
$privatekey2->loadKey($privatekey);
$privatekey2->setHash('sha512');
$privatekey2->setMGFHash('sha512');

$password = 'test123randomPassword';

$privatekey2->setPassword($password);

$fileprivate = fopen('private.pem', 'w');
fwrite($fileprivate, $privatekey2->getPrivateKey());
fclose($fileprivate);

$filepublic = fopen('public.pem', 'w');
fwrite($filepublic, $privatekey2->getPublicKey());
fclose($filepublic);

echo 'Keys has been generated'."\r\n";
echo 'Password is: '.$password;