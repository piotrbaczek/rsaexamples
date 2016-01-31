<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/Rijndael.php';
include '../phpseclib/phpseclib/Crypt/AES.php';

$password = '#$2123Bsa#3Qzfk231';

$plaintext = 'This is something secret';

$aes_encrypt = new \phpseclib\Crypt\AES(\phpseclib\Crypt\AES::MODE_CBC);
$aes_encrypt->setPreferredEngine(phpseclib\Crypt\AES::ENGINE_OPENSSL);
$aes_encrypt->setKeyLength(256);
$aes_encrypt->setPassword($password, 'pbkdf2', 'sha512');

$ciphertext = base64_encode($aes_encrypt->encrypt($plaintext));

echo 'Ciphertext: ' . $ciphertext . "\r\n";

$aes_decrypt = new \phpseclib\Crypt\AES(\phpseclib\Crypt\AES::MODE_CBC);
$aes_decrypt->setPreferredEngine(phpseclib\Crypt\AES::ENGINE_OPENSSL);
$aes_decrypt->setKeyLength(256);
$aes_decrypt->setPassword($password, 'pbkdf2', 'sha512');

$decrypted = $aes_decrypt->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";
