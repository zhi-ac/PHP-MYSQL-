<html>
<head>
	<title>成绩管理</title>
</head>
<body bgcolor="D9DFAA">
<form method="post">
	<table>
		<tr>
			<td>
				课程名：
				<!-- 以下JS代码是为了保证在页面刷新后，下拉列表中仍然保持着之前的选中项 -->
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
					echo "<option>请选择</option>";
					require "fun.php";
					$kcm_sql = "select distinct KCM from KC";						//查找所有的课程名
					$kcm_result = $db->query($kcm_sql);
					while(list($KCM) = $kcm_result->fetch(PDO::FETCH_NUM)) {		//输出课程名到下拉框中
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
			<td><input name="btn" type="submit" value="查询"></td>
		</tr>
		<tr>
			<td>
				姓名：
				<input type="text" name="xm" size="5">&nbsp;
				成绩：
				<input type="text" name="cj" size="2">
			</td>
			<td>
				<input name="btn" type="submit" value="录入">
				<input name="btn" type="submit" value="删除">
			</td>
		</tr>
		<tr>
			<td align="left">
				<table border=1 width="285">
					<tr bgcolor=#CCCCC0>
						<td align="center">姓名</td>
						<td align="center">成绩</td>
                        <td align="center">平均成绩</td>
					</tr>
					<?php		
						include "fun.php";
						//单击【查询】按钮
						if(@$_POST["btn"] == '查询') {			//单击"查询"按钮
							$CourseName = $_POST['kcm'];
							$cj_sql = "select XM, CJ  from CJ where KCM ='$CourseName'";	//查找该课程对应的成绩单
							$cj_result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
							while(list($XM, $CJ) = $cj_result->fetch(PDO::FETCH_NUM)) {	//获取查询结果集
								$Name = iconv('UTF-8', 'GB2312', $XM);
								//在表格中显示输出"姓名-成绩"信息
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
	$CourseName = $_POST['kcm'];		//获取提交的课程名
	$StudentName = $_POST['xm'];		//获取提交的姓名
	$Score = $_POST['cj'];				//获取提交的成绩
	$cj_sql = "select * from CJ where KCM ='$CourseName' and XM ='$StudentName'";	//先从数据库中查询该生该门课的成绩
	$result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
	//单击【录入】按钮
	if(@$_POST["btn"] == '录入') {
		if($result->rowCount() != 0)	//查询结果不为空，表示该成绩记录已经存在
			echo "<script>alert('该记录已经存在！');location.href='scoreManage.php';</script>";
		else {							//不存在才可以添加
			$insert_sql = "insert into CJ(XM, KCM, CJ) values('$StudentName', '$CourseName', '$Score')";	//添加新记录
			$insert_result = $db->query(iconv('GB2312', 'UTF-8', $insert_sql));								//执行操作
			if($insert_result->rowCount() != 0)
				echo "<script>alert('添加成功！');location.href='scoreManage.php';</script>";
			else
				echo "<script>alert('添加失败，请确保有此学生！');location.href='scoreManage.php';</script>";
		}
	}
	
	//单击【删除】按钮
	if(@$_POST["btn"] == '删除') {
		if($result->rowCount() != 0) {	//查询结果不为空，该成绩记录存在可删除
			$delete_sql = "delete from CJ where XM ='$StudentName' and KCM ='$CourseName'";					//删除该记录
			$del_affected = $db->exec(iconv('GB2312', 'UTF-8', $delete_sql));								//执行操作
			if($del_affected)
				echo "<script>alert('删除成功！');location.href='scoreManage.php';</script>";
			else
				echo "<script>alert('删除失败，请检查操作权限！');location.href='scoreManage.php';</script>";
		}else			//不存在该记录，无法删
			echo "<script>alert('该记录不存在！');location.href='scoreManage.php';</script>";
	}
	
?>