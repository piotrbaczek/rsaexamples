<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/RC4.php';

$plaintext = 'Something very secret.';
$password = '#$2123Bsa#3Qzfk231';

echo 'Plaintext: ' . $plaintext . "\r\n";

$des_encrypt = new \phpseclib\Crypt\RC4(\phpseclib\Crypt\RC4::MODE_ECB);
$des_encrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
$des_encrypt->setKeyLength(256);
$des_encrypt->setPassword($password, 'pbkdf2', 'sha512');

$ciphertext = base64_encode($des_encrypt->encrypt($plaintext));

echo 'Ciphertext: ' . $ciphertext . "\r\n";

$des_decrypt = new phpseclib\Crypt\RC4(phpseclib\Crypt\RC4::MODE_ECB);
$des_decrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
$des_decrypt->setKeyLength(256);
$des_decrypt->setPassword($password, 'pbkdf2', 'sha512');
$decrypted = $des_decrypt->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";