<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';

$plaintext = 'Something very secret.';
$password = '#$2123Bsa#3Qzfk231';

$des_encrypt = new \phpseclib\Crypt\DES(\phpseclib\Crypt\DES::MODE_OFB);
$des_encrypt->setPreferredEngine(phpseclib\Crypt\DES::ENGINE_OPENSSL);
$des_encrypt->setKeyLength(256);
$des_encrypt->setPassword($password, 'pbkdf2', 'sha512');

$ciphertext = base64_encode($des_encrypt->encrypt($plaintext));

echo 'Ciphertext: ' . $ciphertext . "\r\n";

$des_decrypt = new phpseclib\Crypt\DES(phpseclib\Crypt\DES::MODE_OFB);
$des_decrypt->setPreferredEngine(phpseclib\Crypt\DES::ENGINE_OPENSSL);
$des_decrypt->setKeyLength(256);
$des_decrypt->setPassword($password, 'pbkdf2', 'sha512');
$decrypted = $des_decrypt->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";
