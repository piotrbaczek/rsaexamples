<?php

ini_set('max_execution_time', 300);
include '../phpseclib/vendor/autoload.php';

$plaintext = 'This is something secret';

$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

//Create new RSA Object - private key
$rsa_private = new \phpseclib\Crypt\RSA();
//Get private key (in this case content of file)
$private = file_get_contents('private.pem');
//This private key is password protected, so load key
$rsa_private->setPassword($password);
//load the private key
$rsa_private->loadKey($private);
//set hash (I chose sha512 because sha1 apparently has collisions)
$rsa_private->setHash('sha512');
//set MGF hash
$rsa_private->setMGFHash('sha512');

//Create new RSA Object - public key
$rsa_public = new \phpseclib\Crypt\RSA();
//Get public key (in this case content of file)
$public = file_get_contents('public.pem');
//load the public key
$rsa_public->loadKey($public);
//set hash
$rsa_public->setHash('sha512');
//set MGF hash
$rsa_public->setMGFHash('sha512');

echo 'Plaintext: ' . $plaintext . PHP_EOL;

//encrypt with public key and OAEP as padding
$rsa_public->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_OAEP);
$ciphertext_raw = $rsa_public->encrypt($plaintext);
echo 'Ciphertext (RAW): ' . $ciphertext_raw . PHP_EOL;

//Encode as base64 for better management
$ciphertext = base64_encode($ciphertext_raw);
echo 'Ciphertext (base64): ' . $ciphertext . PHP_EOL;

//Decode from base64 then decrypt with private key
$decrypted = $rsa_private->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . PHP_EOL;

//Is everything ok?
var_dump($plaintext == $decrypted);
