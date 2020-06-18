<?php
	header('Content-type: image/jpg');				//输出HTTP头信息
	require "fun.php";
	//以GET方法从studentManage.php页面img控件的src属性中获取学生姓名值
	$StuXm = $_GET['studentname'];
	$sql = "select ZP from XS where XM ='$StuXm'";	//根据姓名查找照片
	$result = $db->query(iconv('GB2312', 'UTF-8', $sql));
	//$result = mysql_query($sql);
	list($ZP) = $result->fetch(PDO::FETCH_NUM);
	//$row = mysql_fetch_array($result);
	$image = base64_decode($ZP);					//使用base64_decode()函数解码
	//$image = base64_decode($row['ZP']);			//使用base64_decode()函数解码
	echo $image;									//输出照片
?>