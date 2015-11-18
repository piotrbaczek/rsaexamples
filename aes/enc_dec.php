<?php
include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/Rijndael.php';
include '../phpseclib/phpseclib/Crypt/AES.php';

$aes = new \phpseclib\Crypt\AES(\phpseclib\Crypt\AES::MODE_CBC);

$aes->setPassword('#$2123Bsa#3Qzfk231');

$size = 8 * 1024;

$plaintext = str_repeat('Witaj moja żono',$size);

$ciphertext = $aes->encrypt($plaintext);
echo chunk_split(base64_encode($ciphertext),1024,'<br/>');
echo '<br/>';
$decrypted = $aes->decrypt($ciphertext);

echo substr($decrypted,0,strlen($decrypted) / $size);
echo '<br/>';
