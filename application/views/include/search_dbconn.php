<?php
session_start();

require('config.php');

@$mysqlConn = new mysqli($myServer, $myUser, $myPass, $myDB);

if($mysqlConn->connect_errno)  //check if database is configured in /include/config.php
{
	echo "Error: Please configure database in /include/config.php !";
}

$GLOBALS['db'] = $mysqlConn;
$db = $GLOBALS['db'];

$ds = DIRECTORY_SEPARATOR;
$GLOBALS['base_dir'] = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
header('content-type: text/html; charset=utf-8');
mysqli_query($db, "SET NAMES utf8");
