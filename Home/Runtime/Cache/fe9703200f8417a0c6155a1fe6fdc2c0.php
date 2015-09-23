<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支点科技-微信墙</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/basic.css" />
</head>
<body id="dlym">
<div class="login_tit"></div>
<div id="login">
	<div class="login_con">
    <span style="font-size:28px; font-family:'微软雅黑';">用户登陆</span>
	<form action="__URL__/login" name="Land" method="post">
	用户名：<input class="log_inpu" type="text" name="username" value=""/><br/>
	密　码：<input class="log_inpu" type="password" name="password" value=""/><br/>
	验证码：<input class="code_inpu" type="text" name="code" value="" size="4" />
	<img src='__APP__/Public/code?w=30&h=25' onclick='this.src=this.src+"?"+Math.random()'/><br/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input class="submit" type="submit" value="提交" name="Submit"/>&nbsp;
	<input class="reset" type="reset" value="重置" name="reset"/>
	</form>
    </div>
</div>
<div class="login_footer">
<a href="http://w.zd3.cn" target="_blank">【支点科技】 ,微信公众平台营销 支点微营销</a>(c)2013 cms版权所有 更新通知：支点微信墙
</div>
</body>
</html>