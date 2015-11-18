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
$rsa->setPassword('apassword');
$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_OAEP);
$rsa->load(file_get_contents('private.pem'));
echo base64_encode($rsa->encrypt('witaj'));
echo '<br/><br/>';
$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_NONE);
echo base64_encode($rsa->encrypt('witaj'));
echo '<br/><br/>';
echo base64_encode($rsa->encrypt('witaj'));
echo '<br/><br/>';
echo $rsa->getPrivateKey('PKCS1');
