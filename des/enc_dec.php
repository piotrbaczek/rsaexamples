<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
$des = new \phpseclib\Crypt\DES(\phpseclib\Crypt\DES::MODE_OFB);
$des->setPassword('#$2123Bsa#3Qzfk231');
echo '<pre>';
$size = 8 * 512;

$plaintext = str_repeat('fasada',$size);
$ciphertext = $des->encrypt($plaintext);
echo chunk_split(base64_encode($ciphertext),1024,'<br/>');
echo '<br/>';
$decrypted = $des->decrypt($ciphertext);

echo substr($decrypted,0,strlen($decrypted) / $size);
echo '<br/>';
