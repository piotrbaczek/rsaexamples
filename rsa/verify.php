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
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';
include '../phpseclib/phpseclib/Crypt/AES.php';
include '../phpseclib/phpseclib/Math/BigInteger.php';
include '../phpseclib/phpseclib/Crypt/Hash.php';
include '../phpseclib/phpseclib/Crypt/Random.php';

$rsa_public = new \phpseclib\Crypt\RSA();

$public = file_get_contents('public.pem');

$rsa_public->load($public);

$rsa_private = new phpseclib\Crypt\RSA();

$private = file_get_contents('private.pem');
$rsa_private->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$rsa_private->load($private);

$message = 'message= ' . 'Litwo Ojczyzno moja, ty jesteś jak zdrowie';

echo $message . PHP_EOL;

$rsa_private->setMGFHash('sha512');

$signature = base64_encode($rsa_private->sign($message, phpseclib\Crypt\RSA::PADDING_OAEP));

echo 'signature= ' . $signature . PHP_EOL;

$rsa_public->setMGFHash('sha512');

$verify = $rsa_public->verify($message, base64_decode($signature));
echo 'verification= ' . ($verify ? 'TRUE' : 'FALSE') . PHP_EOL;
