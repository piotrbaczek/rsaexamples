<?php
include '../phpseclib/vendor/autoload.php';

$x509 = new \phpseclib\File\X509();
$cert = file_get_contents('cert.crt');
$x509->loadX509($cert);

echo '<pre>';

#INFORMATIONS
echo 'Certificate for website: ' . $x509->getDN('id-ce-subjectAltName')['rdnSequence']['0']['0']['value']['utf8String'] . "\r\n";
echo 'Valid from: ' . $x509->startDate . ' to: ' . $x509->endDate . "\r\n";
echo 'SignatureSubject: ' . $x509->signatureSubject . "\r\n";
echo '-------------------------------CERTIFICATE SIGNING KEY INFORMATION------------------------------------' . "\r\n";
echo 'Certificate version: ' . $x509->currentCert['tbsCertificate']['version'] . "\r\n";

echo 'Serial Number: ' . $x509->currentCert['tbsCertificate']['serialNumber']->toString() . "\r\n";

echo 'Algorithm: ' . $x509->currentCert['tbsCertificate']['signature']['algorithm'] . "\r\n";
echo 'Issuer Public Key: ' . $x509->currentCert['tbsCertificate']['subjectPublicKeyInfo']['subjectPublicKey'] . "\r\n";

echo 'Properties: ' . "\r\n";

foreach ($x509->currentCert['tbsCertificate']['issuer']['rdnSequence'] as $object)
{
	echo $object['0']['type'] . ':' . (isset($object['0']['value']['printableString']) ? $object['0']['value']['printableString'] : NULL) . "\r\n";
}

