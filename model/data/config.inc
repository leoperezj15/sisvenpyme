<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 * @version     1.0
 */

$key = "H@5H*20!8";
$sKey = sha1($key);
define("SecurityKey", $sKey);


?>