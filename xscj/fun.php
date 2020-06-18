<?php
	try {
		$db = new PDO("mysql:host=localhost;dbname=pxscj", "root", "root");
		//$db = new PDO("mysql:host=localhost;dbname=PXSCJ", "root", "njnu123456");
		//
		//$conn=mysql_connect("localhost","root","njnu123456");
		//mysql_select_db("pxscj",$conn);
		//mysql_query("SET NAMES gb2312");
	}catch(PDOException $e) {
		echo "数据库连接失败：".$e->getMessage();
	}
?>