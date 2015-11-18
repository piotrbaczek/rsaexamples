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

$rsa = new \phpseclib\Crypt\RSA();

$public = file_get_contents('public.pem','PKCS8');
$private = file_get_contents('private.pem','PKCS8');

$plaintext = 'Partyzant dupa hassjfodfglds';
//Zaszyfruj
$rsa->load($public);
$ciphertext = base64_encode($rsa->encrypt($plaintext));
echo $ciphertext;
echo '<br/>';

//Odszyfruj
$rsa->load($private);
echo $rsa->decrypt(base64_decode($ciphertext));
