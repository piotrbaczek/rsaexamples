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

$rsa = new \phpseclib\Crypt\RSA();

$private = file_get_contents('private.pem');
$rsa->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$rsa->load($private);

$rsa->setMGFHash('sha512');
$rsa->setSignatureMode(\phpseclib\Crypt\RSA::SIGNATURE_PKCS1);

$message = 'Litwo Ojczyzno moja, ty jesteś jak zdrowie';

$signature = base64_encode($rsa->sign($message));
echo $message;
echo PHP_EOL;
echo $signature;
