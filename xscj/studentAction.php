<?php
	include "fun.php";
	include "studentManage.php";
	$StudentName = @$_POST['xm'];					//����
	$Sex = @$_POST['xb'];							//�Ա�
	$Birthday = @$_POST['cssj'];					//����
	$tmp_file = @$_FILES["photo"]["tmp_name"];		//�ļ����ϴ����ڷ���˴������ʱ�ļ�
	$handle = @fopen($tmp_file,'rb');				//���ļ�
	$Picture = @base64_encode(fread($handle, filesize($tmp_file)));	//��ȡ�ϴ�����Ƭ����������
	//$XF = @$_POST['xf'];
	$s_sql = "select XM, KCS from XS where XM ='$StudentName'";		//�������������޿γ�����Ϣ
	$s_result = $db->query(iconv('GB2312', 'UTF-8', $s_sql));

	/**����Ϊ��ѧ�����������ť�Ĵ���*/
	//¼�빦��
	if(@$_POST["btn"] == '¼��') {					//����"¼��"��ť
		if($s_result->rowCount() != 0)				//Ҫ¼���ѧ�������Ѿ�����ʱ��ʾ
			echo "<script>alert('��ѧ���Ѿ����ڣ�');location.href='studentManage.php';</script>";
		else {
			if(!$tmp_file) {						//û���ϴ���Ƭ�����
				$insert_sql = "insert into XS values('$StudentName', $Sex, '$Birthday', 0, NULL, NULL, NULL)";//1
			}else {
				$insert_sql = "insert into XS values('$StudentName', $Sex, '$Birthday', 0, NULL, '$Picture', NULL)";//2
			}
			$insert_result = $db->query(iconv('GB2312', 'UTF-8', $insert_sql));
			if($insert_result->rowCount() != 0) {
				$_SESSION['StuName'] = $StudentName;
				echo "<script>alert('��ӳɹ���');location.href='studentManage.php';</script>";
			}else
				echo "<script>alert('���ʧ�ܣ�����������Ϣ��');location.href='studentManage.php';</script>";
		}
	}
	
	//ɾ������
	if(@$_POST["btn"] == 'ɾ��') {					//����"ɾ��"��ť
		if($s_result->rowCount() == 0)				//Ҫɾ����ѧ������������ʱ��ʾ
			echo "<script>alert('��ѧ�������ڣ�');location.href='studentManage.php';</script>";
		else {										//�����������ڵ����
			#list($XM, $KCS) = $s_result->fetch(PDO::FETCH_NUM);
			#if($KCS != 0)							//ѧ�����޿μ�¼ʱ��ʾ
			#	echo "<script>alert('�������޿μ�¼������ɾ��');location.href='studentManage.php';</script>";
										//ɾ������
				$del_sql = "delete from XS where XM ='$StudentName'";
				$del_affected = $db->exec(iconv('GB2312', 'UTF-8', $del_sql));
				if($del_affected) {
					$_SESSION['StuName'] = 0;
					echo "<script>alert('ɾ���ɹ���');location.href='studentManage.php';</script>";
			
			}
		}
	}
	
	//���¹���
	if(@$_POST["btn"] == '����'){						//����"����"��ť
		$_SESSION['StuName'] = $StudentName;		//���û������������SESSION����
		if(!$tmp_file)								//��û���ϴ��ļ��򲻸�����Ƭ��
			$update_sql = "update XS set XB =$Sex, CSSJ ='$Birthday' where XM ='$StudentName'";
		else
			$update_sql = "update XS set XB =$Sex, CSSJ ='$Birthday', ZP='$Picture' where XM ='$StudentName'";
		$update_affected = $db->exec(iconv('GB2312', 'UTF-8', $update_sql));
		if($update_affected)
			echo "<script>alert('���³ɹ���');location.href='studentManage.php';</script>";
		else
			echo "<script>alert('����ʧ�ܣ�����������Ϣ��');location.href='studentManage.php';</script>";
	}
	
	//��ѯ����
	if(@$_POST["btn"] == '��ѯ') {					//����"��ѯ"��ť
		$_SESSION['StuName'] = $StudentName;		//��������������ҳ��
		$sql = "select XM, XB, CSSJ, KCS, XF from XS where XM ='$StudentName'";	//����������Ӧ��ѧ����Ϣ  //3
		$result = $db->query(iconv('GB2312', 'UTF-8', $sql));
		if($result->rowCount() == 0)																		//�жϸ�ѧ���Ƿ����
			echo "<script>alert('��ѧ�������ڣ�');location.href='studentManage.php';</script>";
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