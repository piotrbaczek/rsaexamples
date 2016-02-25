<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';

$plaintext = 'Something very secret.';
$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new TripleDES object
$tripledes_encode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_ECB);
//Set keylength to 256
$tripledes_encode->setKeyLength(256);
//Set OPENSSL as preferred engine
$tripledes_encode->setPreferredEngine(phpseclib\Crypt\TripleDES::ENGINE_OPENSSL);
//set password with pbkdf2 and sha512 as hashing method
$tripledes_encode->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

//Encrypt the plaintext
$ciphertext_raw = $tripledes_encode->encrypt($plaintext);

echo 'Ciphertext (RAW): ' . $ciphertext_raw . "\r\n";

$ciphertext = base64_encode($ciphertext_raw);

echo 'Ciphertext (base64): ' . $ciphertext . "\r\n";

//Create new TripleDES Object
$tripledes_decode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_ECB);
//Set keylength to 256
$tripledes_decode->setKeyLength(256);
//Set OPENSSL as preferred engine
$tripledes_decode->setPreferredEngine(phpseclib\Crypt\TripleDES::ENGINE_OPENSSL);
//set password with pbkdf2 and sha512 as hashing method
$tripledes_decode->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

//Decode from base64 and decrypt
$decrypted = $tripledes_decode->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";

//is everything ok?
var_dump($plaintext == $decrypted);
