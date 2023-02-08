<?php

include '../phpseclib/vendor/autoload.php';

$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

$plaintext = 'This is something secret';

$ivSize = 16;

$randomIV = phpseclib\Crypt\Random::string($ivSize);

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new AES Object
$aes_encrypt = new \phpseclib\Crypt\AES(\phpseclib\Crypt\AES::MODE_CTR);
//Use OPENSSL as Default engine
$aes_encrypt->setPreferredEngine(phpseclib\Crypt\AES::ENGINE_OPENSSL);
//set key length to 256
$aes_encrypt->setKeyLength(256);
//set password
$aes_encrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$aes_encrypt->setIV($randomIV);

//Encrypt
$raw_ciphertext = $aes_encrypt->encrypt($plaintext);
$ciphertext = base64_encode($randomIV . $raw_ciphertext);

echo 'Random IV: ' . $randomIV . "\r\n";
echo 'RAW Ciphertext: ' . $raw_ciphertext . "\r\n";
echo 'Ciphertext: ' . $ciphertext . "\r\n";

//Create new AES Object for decryption
$aes_decrypt = new \phpseclib\Crypt\AES(\phpseclib\Crypt\AES::MODE_CTR);
//Set OPENSSL as default engine
$aes_decrypt->setPreferredEngine(phpseclib\Crypt\AES::ENGINE_OPENSSL);
//set key length to 256
$aes_decrypt->setKeyLength(256);
//set password
$aes_decrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$decoded_ciphertext = base64_decode($ciphertext);

$aes_decrypt->setIV(substr($decoded_ciphertext, 0, $ivSize));

//Decode from base64 and decrypts
$decrypted = $aes_decrypt->decrypt(substr($decoded_ciphertext, $ivSize));

echo 'Decrypted: ' . $decrypted . "\r\n";

//is everything ok?
var_dump($plaintext == $decrypted);
