<?php

include '../phpseclib/phpseclib/Crypt/RSA/MSBLOB.php';
include '../phpseclib/phpseclib/Crypt/RSA/OpenSSH.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS1.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS8.php';
include '../phpseclib/phpseclib/Crypt/RSA/PuTTY.php';
include '../phpseclib/phpseclib/Crypt/RSA/Raw.php';
include '../phpseclib/phpseclib/Crypt/RSA/XML.php';
include '../phpseclib/phpseclib/Crypt/RSA.php';
include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/Rijndael.php';
include '../phpseclib/phpseclib/Crypt/AES.php';
include '../phpseclib/phpseclib/Math/BigInteger.php';
include '../phpseclib/phpseclib/Crypt/Hash.php';
include '../phpseclib/phpseclib/Crypt/Random.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';
$rsa = new \phpseclib\Crypt\RSA();

extract($rsa->createKey(2048));
$publickey->setHash('sha512');
$publickey->setMGFHash('sha512');

$privatekey->setHash('sha512');
$privatekey->setMGFHash('sha512');

$password = substr(base64_encode(openssl_random_pseudo_bytes(45)),0,32);

$privatekey->setPassword($password);

phpseclib\Crypt\RSA\PKCS1::setEncryptionAlgorithm('AES-256-CBC');

$fileprivate = fopen('private.pem', 'w');
fwrite($fileprivate, $privatekey->getPrivateKey('PKCS1'));
fclose($fileprivate);

$filepublic = fopen('public.pem', 'w');
fwrite($filepublic, $publickey->getPublicKey('PKCS1'));
fclose($filepublic);

echo 'Keys has been generated'."\r\n";
echo 'Password is: '.$password;