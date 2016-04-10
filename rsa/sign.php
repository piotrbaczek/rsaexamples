<?php

include '../phpseclib/vendor/autoload.php';

$rsa = new \phpseclib\Crypt\RSA();

$private = file_get_contents('private.pem');
$rsa->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$rsa->load($private);

$rsa->setMGFHash('sha512');

$message = 'Litwo Ojczyzno moja, ty jesteś jak zdrowie';

$signature = base64_encode($rsa->sign($message, phpseclib\Crypt\RSA::PADDING_OAEP));
echo $message;
echo PHP_EOL;
echo $signature;
