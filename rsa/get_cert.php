<?php

include '../phpseclib/phpseclib/File/ASN1.php';
include '../phpseclib/phpseclib/File/X509.php';
include '../phpseclib/phpseclib/Crypt/RSA/MSBLOB.php';
include '../phpseclib/phpseclib/Crypt/RSA/OpenSSH.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS1.php';
include '../phpseclib/phpseclib/Crypt/RSA/PKCS8.php';
include '../phpseclib/phpseclib/Crypt/RSA/PuTTY.php';
include '../phpseclib/phpseclib/Crypt/RSA/Raw.php';
include '../phpseclib/phpseclib/Crypt/RSA/XML.php';
include '../phpseclib/phpseclib/Crypt/RSA.php';
include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/Rijndael.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/TripleDES.php';
include '../phpseclib/phpseclib/Crypt/AES.php';
include '../phpseclib/phpseclib/Math/BigInteger.php';
include '../phpseclib/phpseclib/Crypt/Hash.php';
include '../phpseclib/phpseclib/Crypt/Random.php';

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

