<?php
	header('Content-type: image/jpg');				//���HTTPͷ��Ϣ
	require "fun.php";
	//��GET������studentManage.phpҳ��img�ؼ���src�����л�ȡѧ������ֵ
	$StuXm = $_GET['studentname'];
	$sql = "select ZP from XS where XM ='$StuXm'";	//��������������Ƭ
	$result = $db->query(iconv('GB2312', 'UTF-8', $sql));
	//$result = mysql_query($sql);
	list($ZP) = $result->fetch(PDO::FETCH_NUM);
	//$row = mysql_fetch_array($result);
	$image = base64_decode($ZP);					//ʹ��base64_decode()��������
	//$image = base64_decode($row['ZP']);			//ʹ��base64_decode()��������
	echo $image;									//�����Ƭ
?>