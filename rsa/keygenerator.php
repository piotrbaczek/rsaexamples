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
include '../phpseclib/phpseclib/Math/BigInteger.php';
include '../phpseclib/phpseclib/Crypt/Hash.php';
include '../phpseclib/phpseclib/Crypt/Random.php';
include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';


$rsa = new \phpseclib\Crypt\RSA();

echo '<pre>';

$rsa->setPassword('JjeTGN0PAYE0eyGuspmg');
$rsa->setSignatureMode(\phpseclib\Crypt\RSA::SIGNATURE_PKCS1);
$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_OAEP);

extract($rsa->createKey(2048));


echo $publickey->getPublicKey('PKCS8');

echo '<br/><br/>';

print_r($privatekey);

echo '<br/>';

echo $privatekey->getPrivateKey('PKCS8');
