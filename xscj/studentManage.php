<?php
	session_start();			//启动SESSION
?>
<html>
<head>
	<title>学生管理</title>
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
						<td>姓名：</td><td><input type="text" name="xm" value="<?php echo @$XM;?>"/></td>
					</tr>
					<tr>
						<td>性别：</td>
						<?php
							if(@$XB == 1) {
						?>
						<td>
							<input type="radio" name="xb" value="1" checked="checked">男
							<input type="radio" name="xb" value="0">女
						</td>
						<?php
							}else {
						?>
						<td>
							<input type="radio" name="xb" value="1">男
							<input type="radio" name="xb" value="0" checked="checked">女
						</td>
						<?php
							}
						?>
					</tr>
					<tr>
						<td>出生年月：</td><td><input type="text" name="cssj" value="<?php echo @$CSSJ;?>"/></td>
					</tr>
					<tr>
						<td>照片：</td><td><input name="photo" type="file"></td>						
					</tr>
					<tr>
						<td></td>
						<td>
						<!-- 使用img控件调用showpicture.php页面用于显示照片，studentname用于保存当前学生姓名值，time()函数用于产生一个时间戳，防止服务器读取缓存中的内容-->
						<?php
							//echo "<img src='showpicture.php?time=".time()."'>";
							//if($row['ZP'])
								echo "<img src='showpicture.php?studentname=$StuName&time=".time()."' width=90 height=120 />";
								//echo "<img src='showpicture.php?time=".time()."' width=90 height=120 />";
							//else
								//echo "<div class=STYLE1>暂无照片</div>";
						?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input name="btn" type="submit" value="录入">
							<input name="btn" type="submit" value="删除">
							<input name="btn" type="submit" value="更新">
							<input name="btn" type="submit" value="查询">
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
                    	<td>学分<input type="text" name="xf" size="6" value="<?php echo @$XF;?>" disabled/></td>
						<td>已修课程<input type="text" name="kcs" size="6" value="<?php echo @$KCS;?>" disabled/></td>
					</tr>
					<tr>
						<td align="left">
						<?php
							include "fun.php";
							$cj_sql = "call CJ_PROC('$StuName')";		//执行存储过程
							$result = $db->query(iconv('GB2312', 'UTF-8', $cj_sql));
							$xmcj_sql = "select * from XMCJ_VIEW";		//从XMCJ_VIEW表中查询出学生成绩信息
							$cj_rs = $db->query($xmcj_sql);
							//输出表格
							echo "<table border=1>";
							echo "<tr bgcolor=#CCCCC0>";
							echo "<td>课程名</td><td align=center>成绩</td></tr>";
							while(list($KCM, $CJ) = $cj_rs->fetch(PDO::FETCH_NUM)) {			//获取成绩结果集
								$KC = iconv('UTF-8', 'GB2312', $KCM);
								echo "<tr><td>$KC&nbsp;</td><td align=center>$CJ</td></tr>";	//在表格中显示输出"课程名-成绩"信息
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