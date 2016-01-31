<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';

$plaintext = 'Something very secret.';
$password = '#$2123Bsa#3Qzfk231';

$tripledes_encode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_CBC);
$tripledes_encode->setKeyLength(256);
$tripledes_encode->setPassword($password, 'pbkdf2', 'sha512');

$ciphertext = base64_encode($tripledes_encode->encrypt($plaintext));

echo 'Ciphertext: ' . $ciphertext . "\r\n";

$tripledes_decode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_CBC);
$tripledes_decode->setKeyLength(256);
$tripledes_decode->setPassword($password, 'pbkdf2', 'sha512');

$decrypted = $tripledes_decode->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";
