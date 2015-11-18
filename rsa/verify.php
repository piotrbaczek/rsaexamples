<?php

include '../phpseclib/phpseclib/Crypt/RSA/MSBLOB.php';
include '../phpseclib/phpseclib/Crypt/RSA/OpenSSH.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS1.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS8.php';
include '../phpseclib/phpseclib/Crypt/RSA/PuTTY.php';
include '../phpseclib/phpseclib/Crypt/RSA/Raw.php';
include '../phpseclib/phpseclib/Crypt/RSA/XML.php';
include '../phpseclib/phpseclib/Crypt/RSA.php';
include '../phpseclib/phpseclib/Math/BigInteger.php';
include '../phpseclib/phpseclib/Crypt/Hash.php';
include '../phpseclib/phpseclib/Crypt/Random.php';

$rsa = new \phpseclib\Crypt\RSA();

$public = file_get_contents('public.pem','PKCS8');

$rsa->load($public);

$message = 'Litwo Ojczyzno moja, ty jesteś jak zdrowie';

$signature = base64_decode('Z5yCUNUmla4t7Wx3BJM1jyqqj0sNQzVHMi+dZrp/Mg+yojNlNjr8jJ8dhyEF5mjjrG5yva7i0Dra9IWWv7W8Cpnvw/CTFLZNp38YPgUNzn+EKNM8etzHEnFK3nljFQBSZdEJLM5V+UV14MavE0iD6VsWucEJSKrOMBlpN8UZLXJBrT5kdTUhM5vLUEcR0z9B02O16IS8bFrtDUJMREkmBm5b6eafEOurljvCpIotJmUipTU05xqLToN0UFedjkMXsDb9yg/gUMMz3otpxtzjRhUSin+a5Jdf2x58wg60eRGLE4DtwREfgi6B9MEmYJWKECNacQdw3GHXOGXqHkaj6Q==');

$verify = $rsa->verify($message,$signature);
var_dump($verify);
