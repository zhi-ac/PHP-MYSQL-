<html>
<head>
	<title>�ɼ�����</title>
</head>
<body bgcolor="D9DFAA">
<form method="post">
	<table>
		<tr>
			<td>
				�γ�����
				<!-- ����JS������Ϊ�˱�֤��ҳ��ˢ�º������б�����Ȼ������֮ǰ��ѡ���� -->
				<script type="text/javascript">
				function setCookie(name, value) {
					var exp = new Date();
					exp.setTime(exp.getTime() + 24 * 60 * 60 * 1000);
					document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
				}
				function getCookie(name) {
					var regExp = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
					var arr = document.cookie.match(regExp);
					if(arr == null) {
						return null;
					}
					return unescape(arr[2]);
				}
				</script>
				<select name="kcm" id="select_1" onclick="setCookie('select_1',this.selectedIndex)">
				<?php
					echo "<option>��ѡ��</option>";
					require "fun.php";
					$kcm_sql = "select distinct KCM from KC";						//�������еĿγ���
					$kcm_result = $db->query($kcm_sql);
					while(list($KCM) = $kcm_result->fetch(PDO::FETCH_NUM)) {		//����γ�������������
						$KC = iconv('UTF-8', 'GB2312', $KCM);
						echo "<option value=$KC>$KC</option>";
					}
				?>
				</select>
				<script type="text/javascript">
					var selectedIndex = getCookie("select_1");
					if(selectedIndex != null) {
						document.getElementById("select_1").selectedIndex = selectedIndex;
					}
				</script>
			</td>
			<td><input name="btn" type="submit" value="��ѯ"></td>
		</tr>
		<tr>
			<td>
				������
				<input type="text" name="xm" size="5">&nbsp;
				�ɼ���
				<input type="text" name="cj" size="2">
			</td>
			<td>
				<input name="btn" type="submit" value="¼��">
				<input name="btn" type="submit" value="ɾ��">
			</td>
		</tr>
		<tr>
			<td align="left">
				<table border=1 width="285">
					<tr bgcolor=#CCCCC0>
						<td align="center">����</td>
						<td align="center">�ɼ�</td>
                        <td align="center">ƽ���ɼ�</td>
					</tr>
					<?php		
						include "fun.php";
						//��������ѯ����ť
						if(@$_POST["btn"] == '��ѯ') {			//����"��ѯ"��ť
							$CourseName = $_POST['kcm'];
							$cj_sql = "select XM, CJ  from CJ where KCM ='$CourseName'";	//���Ҹÿγ̶�Ӧ�ĳɼ���
							$cj_result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
							while(list($XM, $CJ) = $cj_result->fetch(PDO::FETCH_NUM)) {	//��ȡ��ѯ�����
								$Name = iconv('UTF-8', 'GB2312', $XM);
								//�ڱ������ʾ���"����-�ɼ�"��Ϣ
								$pjcj_sql = "select avg(cj) from cj where xm='$Name'";#333333333333333333
								$pjcj_result = $db->query(iconv('GB2312', 'UTF-8', $pjcj_sql));		#44444444444444444444
								while(list($PJCJ) = $pjcj_result->fetch(PDO::FETCH_NUM)){
									$Name1 = iconv('UTF-8', 'GB2312', $XM);
									#echo "<tr><td align=center>$Name1&nbsp;</td><td align=center>$PJCJ</td></tr>";	
								
								echo "<tr><td align=center>$Name&nbsp;</td><td align=center>$CJ&nbsp;</td><td align=center>$PJCJ</td></tr>";
								}
							}
						}
					?>
				</table>
			</td>
			<td></td>
		</tr>
	</table>
</form>
</body>
</html>
<?php
	$CourseName = $_POST['kcm'];		//��ȡ�ύ�Ŀγ���
	$StudentName = $_POST['xm'];		//��ȡ�ύ������
	$Score = $_POST['cj'];				//��ȡ�ύ�ĳɼ�
	$cj_sql = "select * from CJ where KCM ='$CourseName' and XM ='$StudentName'";	//�ȴ����ݿ��в�ѯ�������ſεĳɼ�
	$result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
	//������¼�롿��ť
	if(@$_POST["btn"] == '¼��') {
		if($result->rowCount() != 0)	//��ѯ�����Ϊ�գ���ʾ�óɼ���¼�Ѿ�����
			echo "<script>alert('�ü�¼�Ѿ����ڣ�');location.href='scoreManage.php';</script>";
		else {							//�����ڲſ������
			$insert_sql = "insert into CJ(XM, KCM, CJ) values('$StudentName', '$CourseName', '$Score')";	//����¼�¼
			$insert_result = $db->query(iconv('GB2312', 'UTF-8', $insert_sql));								//ִ�в���
			if($insert_result->rowCount() != 0)
				echo "<script>alert('��ӳɹ���');location.href='scoreManage.php';</script>";
			else
				echo "<script>alert('���ʧ�ܣ���ȷ���д�ѧ����');location.href='scoreManage.php';</script>";
		}
	}
	
	//������ɾ������ť
	if(@$_POST["btn"] == 'ɾ��') {
		if($result->rowCount() != 0) {	//��ѯ�����Ϊ�գ��óɼ���¼���ڿ�ɾ��
			$delete_sql = "delete from CJ where XM ='$StudentName' and KCM ='$CourseName'";					//ɾ���ü�¼
			$del_affected = $db->exec(iconv('GB2312', 'UTF-8', $delete_sql));								//ִ�в���
			if($del_affected)
				echo "<script>alert('ɾ���ɹ���');location.href='scoreManage.php';</script>";
			else
				echo "<script>alert('ɾ��ʧ�ܣ��������Ȩ�ޣ�');location.href='scoreManage.php';</script>";
		}else			//�����ڸü�¼���޷�ɾ
			echo "<script>alert('�ü�¼�����ڣ�');location.href='scoreManage.php';</script>";
	}
	
?>