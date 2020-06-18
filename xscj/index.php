<?php
header('Content-Type: text/html; charset=utf-8');	
?>
<html>
<head>
	<title>学生成绩管理系统</title>
    <style type="text/css">
#fk{
		background-image:url(images/1_1_2.jpg);
		background-repeat:no-repeat;
		background-position:center center;
		background-size:100% 100%;
		background-attachment:fixed;
        z-index:1;
        width:100px;
        height:100px;
        position:absolute;
        font-size:15px;
        color:red;
}
.dh{
            animation:dh1 20s infinite;
           -moz-animation: dh1 20s infinite;
           -webkit-animation: dh1 20s infinite;
           -o-animation: dh1 20s infinite ;
}
.dh:hover{
            animation-play-state: paused;
           -moz-animation-play-state: paused;
           -webkit-animation-play-state: paused;
           -o-animation-play-state: paused;      
}
@keyframes dh1{
       0%{

            left:0vw;
           top: 0vh;
             }
       20%{

            left:0vw;
           top: 65vh;
             }
       40%{
     
            left:75vw;
           top: 0vh;
             }
       60%{
  
            left:75vw;
           top: 65vh;
             }
      100%{

            left: 0vw;
             top: 0vh;
           }
}
</style>
    <link href="style.css" type="text/css" rel="stylesheet">  
</head>
<body topMargin="0" leftMargin="0" bottomMargin="0" rightMargin="0">
	<div id="fk" class="dh">学生成绩管理系统</div>
	<table width="675" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 778px; ">
		<tr>
			<td><img src="images/学生成绩管理系统.gif" width="790" height="97"></td>
		</tr>
		<tr>
			<td><iframe src="main_frame.html" width="790" height="313"></iframe></td>
		</tr>
		<tr>
			<td><img src="images/底端图片.gif" width="790" height="32"></td>
		</tr>
	</table>
</body>
</html>
