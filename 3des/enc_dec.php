<?php

include '../phpseclib/vendor/autoload.php';

$plaintext = 'Something very secret.';
$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

$ivSize = 8;

$randomIV = openssl_random_pseudo_bytes($ivSize);

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new TripleDES object
$tripledes_encode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_CBC);
//Set keylength to 256
$tripledes_encode->setKeyLength(192);
//Set OPENSSL as preferred engine
$tripledes_encode->setPreferredEngine(phpseclib\Crypt\TripleDES::ENGINE_OPENSSL);
//set password with pbkdf2 and sha512 as hashing method
$tripledes_encode->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$tripledes_encode->setIV($randomIV);

echo 'Random IV: ' . $randomIV . "\r\n";

//Encrypt the plaintext
$ciphertext_raw = $tripledes_encode->encrypt($plaintext);

echo 'Ciphertext (RAW): ' . $ciphertext_raw . "\r\n";

$ciphertext = base64_encode($randomIV . $ciphertext_raw);

echo 'Ciphertext (base64): ' . $ciphertext . "\r\n";

//Create new TripleDES Object
$tripledes_decode = new phpseclib\Crypt\TripleDES(phpseclib\Crypt\TripleDES::MODE_CBC);
//Set keylength to 256
$tripledes_decode->setKeyLength(192);
//Set OPENSSL as preferred engine
$tripledes_decode->setPreferredEngine(phpseclib\Crypt\TripleDES::ENGINE_OPENSSL);
//set password with pbkdf2 and sha512 as hashing method
$tripledes_decode->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$ciphertext_decoded = base64_decode($ciphertext);

$tripledes_decode->setIV(substr($ciphertext_decoded, 0, $ivSize));

//Decode from base64 and decrypt
$decrypted = $tripledes_decode->decrypt(substr($ciphertext_decoded, $ivSize));

echo 'Decrypted: ' . $decrypted . "\r\n";

//is everything ok?
var_dump($plaintext == $decrypted);
