<?php
	session_start();			//����SESSION
?>
<html>
<head>
	<title>ѧ������</title>
</head>
<body bgcolor="D9DFAA">
<?php
	$XM = $_SESSION['XM'];
	$XB = $_SESSION['XB'];
	$CSSJ = $_SESSION['CSSJ'];
	$KCS = $_SESSION['KCS'];
	$StuName = $_SESSION['StuName'];
	$XF = $_SESSION['XF'];
?>
<form method="post" action="studentAction.php" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td>������</td><td><input type="text" name="xm" value="<?php echo @$XM;?>"/></td>
					</tr>
					<tr>
						<td>�Ա�</td>
						<?php
							if(@$XB == 1) {
						?>
						<td>
							<input type="radio" name="xb" value="1" checked="checked">��
							<input type="radio" name="xb" value="0">Ů
						</td>
						<?php
							}else {
						?>
						<td>
							<input type="radio" name="xb" value="1">��
							<input type="radio" name="xb" value="0" checked="checked">Ů
						</td>
						<?php
							}
						?>
					</tr>
					<tr>
						<td>�������£�</td><td><input type="text" name="cssj" value="<?php echo @$CSSJ;?>"/></td>
					</tr>
					<tr>
						<td>��Ƭ��</td><td><input name="photo" type="file"></td>						
					</tr>
					<tr>
						<td></td>
						<td>
						<!-- ʹ��img�ؼ�����showpicture.phpҳ��������ʾ��Ƭ��studentname���ڱ��浱ǰѧ������ֵ��time()�������ڲ���һ��ʱ�������ֹ��������ȡ�����е�����-->
						<?php
							//echo "<img src='showpicture.php?time=".time()."'>";
							//if($row['ZP'])
								echo "<img src='showpicture.php?studentname=$StuName&time=".time()."' width=90 height=120 />";
								//echo "<img src='showpicture.php?time=".time()."' width=90 height=120 />";
							//else
								//echo "<div class=STYLE1>������Ƭ</div>";
						?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input name="btn" type="submit" value="¼��">
							<input name="btn" type="submit" value="ɾ��">
							<input name="btn" type="submit" value="����">
							<input name="btn" type="submit" value="��ѯ">
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
                    	<td>ѧ��<input type="text" name="xf" size="6" value="<?php echo @$XF;?>" disabled/></td>
						<td>���޿γ�<input type="text" name="kcs" size="6" value="<?php echo @$KCS;?>" disabled/></td>
					</tr>
					<tr>
						<td align="left">
						<?php
							include "fun.php";
							$cj_sql = "call CJ_PROC('$StuName')";		//ִ�д洢����
							$result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
							$xmcj_sql = "select * from XMCJ_VIEW";		//��XMCJ_VIEW���в�ѯ��ѧ���ɼ���Ϣ
							$cj_rs = $db->query($xmcj_sql);
							//������
							echo "<table border=1>";
							echo "<tr bgcolor=#CCCCC0>";
							echo "<td>�γ���</td><td align=center>�ɼ�</td></tr>";
							while(list($KCM, $CJ) = $cj_rs->fetch(PDO::FETCH_NUM)) {			//��ȡ�ɼ������
								$KC = iconv('UTF-8', 'GB2312', $KCM);
								echo "<tr><td>$KC&nbsp;</td><td align=center>$CJ</td></tr>";	//�ڱ������ʾ���"�γ���-�ɼ�"��Ϣ
							}
							echo "</table>";
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</body>
</html>