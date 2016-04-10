<?php

include '../phpseclib/vendor/autoload.php';

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

