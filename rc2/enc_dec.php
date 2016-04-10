<?php

include '../phpseclib/vendor/autoload.php';

$plaintext = 'Something very secret.';
$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

$ivSize = 8;

$randomIV = phpseclib\Crypt\Random::string($ivSize);

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new RC2 object for encrypting
$rc2_encrypt = new \phpseclib\Crypt\RC2(\phpseclib\Crypt\RC2::MODE_CBC);
//set OPENSSL as preferred engine
$rc2_encrypt->setPreferredEngine(phpseclib\Crypt\RC2::ENGINE_OPENSSL);
//set keylength to 256
$rc2_encrypt->setKeyLength(256);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$rc2_encrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$rc2_encrypt->setIV($randomIV);

$ciphertext_raw = $rc2_encrypt->encrypt($plaintext);

echo 'Ciphertext(RAW): ' . $ciphertext_raw . "\r\n";

$ciphertext = base64_encode($randomIV . $ciphertext_raw);

echo 'Ciphertext(base64): ' . $ciphertext . "\r\n";

//Create new RC2 object for decryption
$rc2_decrypt = new phpseclib\Crypt\RC2(\phpseclib\Crypt\RC2::MODE_CBC);
//set OPENSSL as preferred engine
$rc2_decrypt->setPreferredEngine(phpseclib\Crypt\RC2::ENGINE_OPENSSL);
//set key length to 256
$rc2_decrypt->setKeyLength(256);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$rc2_decrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$ciphertext_decoded = base64_decode($ciphertext);

$rc2_decrypt->setIV(substr($ciphertext_decoded, 0, $ivSize));

//Decode from base64 and decrypt
$decrypted = $rc2_decrypt->decrypt(substr($ciphertext_decoded, $ivSize));

echo 'Decrypted: ' . $decrypted . "\r\n";

//Is everything ok?
var_dump($plaintext == $decrypted);
