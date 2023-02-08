<?php

include '../phpseclib/vendor/autoload.php';

$plaintext = 'Something very secret.';
$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new RC4 object for encrypting
$rc4_encrypt = new \phpseclib\Crypt\RC4();
//set OPENSSL as preferred engine
$rc4_encrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$rc4_encrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$ciphertext_raw = $rc4_encrypt->encrypt($plaintext);

echo 'Ciphertext(RAW): ' . $ciphertext_raw . "\r\n";

$ciphertext = base64_encode($ciphertext_raw);

echo 'Ciphertext(base64): ' . $ciphertext . "\r\n";

//Create new RC4 object for decryption
$rc4_decrypt = new phpseclib\Crypt\RC4();
//set OPENSSL as preferred engine
$rc4_decrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$rc4_decrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);
//Decode from base64 and decrypt
$decrypted = $rc4_decrypt->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";

//Is everything ok?
var_dump($plaintext == $decrypted);
