<?php

include '../phpseclib/phpseclib/Crypt/Hash.php';
include 'Hash.php';

$text_to_hash = 'This is something secret';
$key = 'IVxSISQCUnFoEfPU';

echo 'Text to hash: ' . $text_to_hash . "\r\n";
echo 'MAC key: ' . $key . "\r\n";

$hashes_array = hash_algos();

foreach ($hashes_array as $hash_element)
{
	$hash = new Hash($hash_element);

	echo $hash_element . ': ' . $hash->hash($text_to_hash) . "\r\n";
	echo $hash_element . ' MAC: ';
	$hash->setKey($key);
	echo $hash->hash($text_to_hash) . "\r\n";
}