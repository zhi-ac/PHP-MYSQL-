<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录</title>
<style type="text/css">
*{
	margin:0;
	padding:0;
}
#wrap {
	height:719px;
	width:100;
	background-image:url(images/7_8_3_wps%E5%9B%BE%E7%89%87.jpg);
	background-repeat:no-repeat;
	background-position:center center;
	position: relative;
}
#head {
	height:120px;
	width:100;
	background-image:url(images/7_8_3_wps%E5%9B%BE%E7%89%87.jpg);
	text-align:center;
	position:relative;
}
#foot {
	width:100;
	height:126px;
	background-color:gray;
	position:relative;
}
#wrap .logGet {
	height:408px;
	width:368px;
	position:absolute;
	background-color:#FFFFFF;
	top:20%;
	right:15%;
}
.logC a button{
	width:100%;
	height:45px;
	background-color:#ee7700;
	border:none;
	color:white;
	font-size:18px;
}
.logC input {
	width: 100%;
	height:45px;
	background-color:#ee7700;
	border:none;
	color:white;
	font-size:18px;
}
#wrap .logGet .logD.logDtip{
	width:86%;
	border-bottom:1px solid #ee7700;
	margin-bottom:60px;
	margin-top:0px;
	margin-right:auto;
	margin-left:auto;
}
.logGet .lgD img{
	position:absolute;
	top:12px;
	left:8px;
}
.logGet .lgD input{
	width:100%;
	height:42px;
	text-indent:2.5rem;
}
#wrap .logGet .lgD{
	width:86%;
	position:relative;
	margin-bottom:30px;
	margin-top:30px;
	margin-right:auto;
	margin-left:auto;
}
#wrap .logGet .logC{
	width:86%;
	margin-top:0px;
	margin-right:auto;
	margin-bottom:0px;
	margin-left:auto;
}
.title {
	font-family:"宋体";
	color:#FFFFFF;
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%,-50%);
	font-size:36px;
	height:40px;
	width:30%;
}
.copyright{
	font-family:"宋体";
	color:#FFFFFF;
	position:absolute;
	top: 50%;
	left:50%;
	transform:translate(-50%,-50%);
	height:60px;
	width:40%;
	text-align:center;
}

#foot .copyright .img{
	width: 100%;
	height:24px;
	position: relative;
}
.copyright .img .icon{
	display:inline-block;
	width:24px;
	height:24px;
	margin-left:22px;
	vertical-align:middle;
	background-image:url(images/1_1_2.jpg);
	background-repeat:no-repeat;
	vertical-align:middle;
	margin-right:5px;
}
.copyright .img .icon1{
	display:inline-block;
	width:24px;
	height:24px;
	margin-left:22px;
	vertical-align:middle;
	background-image:url(images/1_1_2.jpg);
	background-repeat:no-repeat;
	vertical-align:middle;
	margin-right:5px;
}
.copyright .img .icon2{
	display:inline-block;
	width:24px;
	height:24px;
	margin-left:22px;
	vertical-align:middle;
	background-image:url(images/1_1_2.jpg);
	background-repeat:no-repeat;
	vertical-align:middle;
	margin-right:5px;
}
#foot .copyright p{
	height:24px;
	width:100%;
}
</style>
</head>

<body>
<?php

include "fun.php";
$username=@$_POST['username'];
$password=@$_POST['password'];
if(!empty($username))
{
	$s_sql= "select * from user where username='$username' and password='$password'";
	$s_result=$db->query( $s_sql);
	if($s_result && $s_result->rowCount()!=0)
	{
		echo "<script>url=\"index.php\";window.location.href=url;</script>";
	}
	else
	{
		echo "<script language=\"javascript\">alert(\"用户名，密码错误\");</script>";
	}
}
?>

<div class="header" id="head">
	<div class="title">学生成绩管理系统</div>
</div>

<div class="wrap" id="wrap">
	<form name="login" action="login1.php" method="post">
    	<div class="logGet">
    		<div class="logD logDtip">
        		<p class="p1">登录</p>
        	</div>
        	<div class="lgD">
        		<img src="images/1_1_2.jpg" width="20" height="20" alt=""/>
            	<input name="username" type="text"
            		placeholder="输入用户名" />
        	</div>
        	<div class="lgD">
        		<img src="images/1_1_2.jpg" width="20" height="20" alt=""/>
            	<input name="password" type="password"
            		placeholder="输入用户密码" />
        	</div>
        	<div class="logC" >
        		<input type="submit" value="登录"><br>
        	</div>
    	</div>
</form>
</div>
<div class="footer" id="foot">
	<div class="copyright">
    	<p>Copyright @ 2020 hzu.All Rights Reserved.</p>
        <div class="img">
        	<i class="icon"></i><span>联系邮箱：wangxiaoye@hzu.edu.cn</span>
        </div>
        <div class="img">
        	<i class="icon1"></i><span>联系地址：惠州学院</span>
        </div>
        <div class="img">
        	<i class="icon2"></i><span>联系电话：**********</span>
        </div>
    </div>
</div>
</body>
</html>