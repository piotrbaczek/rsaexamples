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
include '../phpseclib/phpseclib/File/ASN1.php';
include '../phpseclib/phpseclib/File/X509.php';

$privKey = new \phpseclib\Crypt\RSA();
$private = file_get_contents('private.pem','PKCS8');
$privKey->load($private);

$pubKey = new \phpseclib\Crypt\RSA();
$public = file_get_contents('public.pem','PKCS8');
$pubKey->load($public);
$pubKey->setPublicKey();

$subject = new \phpseclib\File\X509();
$subject->setDNProp('id-at-organizationName','www.nukeify2.com');
$subject->setPublicKey($pubKey);

$issuer = new \phpseclib\File\X509();
$issuer->setPrivateKey($privKey);
$issuer->setDN($subject->getDN());

$x509 = new \phpseclib\File\X509();

$result = $x509->sign($issuer,$subject);
echo "the stunnel.pem contents are as follows:<br/><br/>";
echo $privKey->getPrivateKey();
echo "<br/><br/>";
echo $x509->saveX509($result);
echo "<br/><br/>";
