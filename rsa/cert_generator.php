<?php

include '../phpseclib/vendor/autoload.php';

$privKey = new \phpseclib\Crypt\RSA();
$private = file_get_contents('private.pem');
$privKey->setPassword('VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg');
$privKey->load($private);

$pubKey = new \phpseclib\Crypt\RSA();
$public = file_get_contents('public.pem');
$pubKey->load($public);

$subject = new \phpseclib\File\X509();
$subject->setDNProp('id-at-organizationName', 'www.test.com');
$subject->setDNProp('name', 'Name Inc.');
$subject->setDNProp('emailaddress', 'test@test.com');
$subject->setDNProp('postalcode', '90210');
$subject->setDNProp('state', 'California');
$subject->setDNProp('streetaddress', 'Infinite Loop 1');

$subject->setPublicKey($pubKey);

$issuer = new \phpseclib\File\X509();
$issuer->setPrivateKey($privKey);
$issuer->setDN($subject->getDN());

$x509 = new \phpseclib\File\X509();
$x509->setStartDate(date('Y-m-d H:i:s'));
$x509->setEndDate(date('Y-m-d H:i:s', strtotime('+1 year')));
$result = $x509->sign($issuer, $subject, 'sha512WithRSAEncryption');
$certificate = $x509->saveX509($result);

$filepublic = fopen('cert.crt', 'w');
fwrite($filepublic, $certificate);
fclose($filepublic);

echo 'Cert has been generated' . PHP_EOL;
echo $certificate . PHP_EOL;
echo 'Valid from= ' . $x509->startDate . PHP_EOL;
echo 'Valid to= ' . $x509->endDate . PHP_EOL;
