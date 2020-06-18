<?php
	include "fun.php";
	include "studentManage.php";
	$StudentName = @$_POST['xm'];					//姓名
	$Sex = @$_POST['xb'];							//性别
	$Birthday = @$_POST['cssj'];					//生日
	$tmp_file = @$_FILES["photo"]["tmp_name"];		//文件被上传后在服务端储存的临时文件
	$handle = @fopen($tmp_file,'rb');				//打开文件
	$Picture = @base64_encode(fread($handle, filesize($tmp_file)));	//读取上传的照片变量并编码
	//$XF = @$_POST['xf'];
	$s_sql = "select XM, KCS from XS where XM ='$StudentName'";		//查找姓名、已修课程数信息
	$s_result = $db->query(iconv('GB2312', 'UTF-8', $s_sql));

	/**以下为各学生管理操作按钮的代码*/
	//录入功能
	if(@$_POST["btn"] == '录入') {					//单击"录入"按钮
		if($s_result->rowCount() != 0)				//要录入的学生姓名已经存在时提示
			echo "<script>alert('该学生已经存在！');location.href='studentManage.php';</script>";
		else {
			if(!$tmp_file) {						//没有上传照片的情况
				$insert_sql = "insert into XS values('$StudentName', $Sex, '$Birthday', 0, NULL, NULL, NULL)";//1
			}else {
				$insert_sql = "insert into XS values('$StudentName', $Sex, '$Birthday', 0, NULL, '$Picture', NULL)";//2
			}
			$insert_result = $db->query(iconv('GB2312', 'UTF-8', $insert_sql));
			if($insert_result->rowCount() != 0) {
				$_SESSION['StuName'] = $StudentName;
				echo "<script>alert('添加成功！');location.href='studentManage.php';</script>";
			}else
				echo "<script>alert('添加失败，请检查输入信息！');location.href='studentManage.php';</script>";
		}
	}
	
	//删除功能
	if(@$_POST["btn"] == '删除') {					//单击"删除"按钮
		if($s_result->rowCount() == 0)				//要删除的学生姓名不存在时提示
			echo "<script>alert('该学生不存在！');location.href='studentManage.php';</script>";
		else {										//处理姓名存在的情况
			#list($XM, $KCS) = $s_result->fetch(PDO::FETCH_NUM);
			#if($KCS != 0)							//学生有修课记录时提示
			#	echo "<script>alert('该生有修课记录，不能删！');location.href='studentManage.php';</script>";
										//删除操作
				$del_sql = "delete from XS where XM ='$StudentName'";
				$del_affected = $db->exec(iconv('GB2312', 'UTF-8', $del_sql));
				if($del_affected) {
					$_SESSION['StuName'] = 0;
					echo "<script>alert('删除成功！');location.href='studentManage.php';</script>";
			
			}
		}
	}
	
	//更新功能
	if(@$_POST["btn"] == '更新'){						//单击"更新"按钮
		$_SESSION['StuName'] = $StudentName;		//将用户输入的姓名用SESSION保存
		if(!$tmp_file)								//若没有上传文件则不更新照片列
			$update_sql = "update XS set XB =$Sex, CSSJ ='$Birthday' where XM ='$StudentName'";
		else
			$update_sql = "update XS set XB =$Sex, CSSJ ='$Birthday', ZP='$Picture' where XM ='$StudentName'";
		$update_affected = $db->exec(iconv('GB2312', 'UTF-8', $update_sql));
		if($update_affected)
			echo "<script>alert('更新成功！');location.href='studentManage.php';</script>";
		else
			echo "<script>alert('更新失败，请检查输入信息！');location.href='studentManage.php';</script>";
	}
	
	//查询功能
	if(@$_POST["btn"] == '查询') {					//单击"查询"按钮
		$_SESSION['StuName'] = $StudentName;		//将姓名传给其他页面
		$sql = "select XM, XB, CSSJ, KCS, XF from XS where XM ='$StudentName'";	//查找姓名对应的学生信息  //3
		$result = $db->query(iconv('GB2312', 'UTF-8', $sql));
		if($result->rowCount() == 0)																		//判断该学生是否存在
			echo "<script>alert('该学生不存在！');location.href='studentManage.php';</script>";
		else {
			list($XM, $XB, $CSSJ, $KCS , $XF) = $result->fetch(PDO::FETCH_NUM);
			$_SESSION['XM'] = iconv('UTF-8', 'GB2312', $XM);
			$_SESSION['XB'] = $XB;
			$_SESSION['CSSJ'] = $CSSJ;
			$_SESSION['KCS'] = $KCS;
            $_SESSION['XF'] = $XF;
			echo "<script>location.href='studentManage.php';</script>";
		}
	}
?>