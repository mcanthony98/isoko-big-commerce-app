<?php

define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'xjEN2T9eQx');
define('DB_PASSWORD', 'c7MM0MP2mlll');
define('DB_DATABASE', 'xjEN2T9eQx');

$pdo = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

//verify connection
	 if ($pdo->connect_error){
		 die("Connection Failed: <br />" .$pdo->connect_error);
	  }
?>