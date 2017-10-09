<?php

include '../phpseclib/vendor/autoload.php';

$rsa_signer = new \phpseclib\Crypt\RSA();

$private = file_get_contents('private.pem');
$rsa_signer->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$rsa_signer->loadKey($private);

$rsa_signer->setHash('sha512');
$rsa_signer->setMGFHash('sha512');

$message = 'Litwo Ojczyzno moja, ty jesteś jak zdrowie';

$rsa_signer->setSignatureMode(\phpseclib\Crypt\RSA::SIGNATURE_PSS);
$signature = $rsa_signer->sign($message);

$signature_base64 = base64_encode($signature);
echo 'Message: ' . $message . "\r\n";
echo 'Signature (RAW): ' . $signature . "\r\n";
echo 'Signature (base64): ' . $signature_base64 . "\r\n";

echo '------------------------------------DECODING------------------------------------------' . "\r\n";


$rsa_verifier = new \phpseclib\Crypt\RSA();
$rsa_verifier->setHash('sha512');
$rsa_verifier->setMGFHash('sha512');

$public = file_get_contents('public.pem');
$rsa_verifier->loadKey($public);

$verification = $rsa_verifier->verify($message, $signature);

echo 'Verified: ' . ($verification ? 'TRUE' : 'FALSE');
