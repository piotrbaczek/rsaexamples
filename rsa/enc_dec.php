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

$rsa_private = new \phpseclib\Crypt\RSA();
$private = file_get_contents('private.pem');
$rsa_private->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$rsa_private->load($private);

$rsa_public = new \phpseclib\Crypt\RSA();
$public = file_get_contents('public.pem');
$rsa_public->load($public);

$message = 'This is some random text ' . date('Y-m-d H:i:s');
echo 'message=' . $message . PHP_EOL;

$rsa_public->setHash('sha512');
$rsa_public->setMGFHash('sha512');

$ciphertext = $rsa_public->encrypt($message, phpseclib\Crypt\RSA::PADDING_OAEP);
echo 'ciphertext= ' . $ciphertext . PHP_EOL;

//base64
$ciphertext = base64_encode($ciphertext);
echo 'ciphertext in base64= ' . $ciphertext . PHP_EOL;

$rsa_private->setHash('sha512');
$rsa_private->setMGFHash('sha512');
$decrypted = $rsa_private->decrypt(base64_decode($ciphertext));

echo 'decrypted= ' . $decrypted . PHP_EOL;
