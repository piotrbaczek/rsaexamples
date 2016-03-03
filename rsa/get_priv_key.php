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

phpseclib\Crypt\RSA\PKCS1::setEncryptionAlgorithm('AES-256-CBC');

$rsa->setHash('sha512');
$rsa->setMGFHash('sha512');
$rsa->load($private);

foreach ($rsa->primes as $key => $prime)
{
	echo 'p' . ($key) . '= ' . $prime . '(' . strlen($prime) . ')' . PHP_EOL;
}

echo 'n= ' . $rsa->modulus . PHP_EOL;
echo 'e= ' . $rsa->publicExponent . '(binary: ' .decbin($rsa->publicExponent->value) . ')' . '(hexadecimal: ' . dechex($rsa->publicExponent->value) . ')' .PHP_EOL;

if ($rsa->password)
{
	echo 'password= ' . $rsa->password . PHP_EOL;
}

echo 'Bits: ' . $rsa->getSize() . ' bits.' . '(' . strlen($rsa->modulus) . ')(2^' . $rsa->getSize() . ')'. PHP_EOL;

echo PHP_EOL;

echo $rsa->getPrivateKey('PKCS1') . PHP_EOL;

