<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$php_errormsg = 1;
echo 'yyy';
echo $php_errormsg;

// make it error again
$number++;
echo $number;

if ($pass) {
    echo 'yes';
} else {
    echo 'no';
}
