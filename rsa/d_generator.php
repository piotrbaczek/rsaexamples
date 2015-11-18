<?php

//d=(k*phi(n)+1)/e
$e = 7;
$phi = 8;
for($k = 1; $k < 100; $k++)
{
	echo '[' . $k . ']: ';
	echo ($phi * $k + 1) / $e;
	echo '<br/>';
}
