<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支点科技-微信墙</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/basic.css" />
</head> 
<link rel="stylesheet" href="__PUBLIC__/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="__PUBLIC__/kindeditor/plugins/code/prettify.css" />
<script src="__PUBLIC__/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="__PUBLIC__/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="__PUBLIC__/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<body>
	<div id="header">
<div class="menu_btn"></div><img src="__PUBLIC__/Images/logo-system02.png"/>
<ul>
	<li><a href="__APP__/Index/index">公共账号</a></li>
	<li><a href="__APP__/Index/password">修改密码</a></li>
	<li><a href="__APP__/Index/wall">微 信 墙</a></li>
	<li><a href="__APP__/Index/prize">微 抽 奖</a></li>
	<li><a href="__APP__/Index/vote">微 投 票</a></li>
	<li class="menu06"><a href="__APP__/Index/shake">摇 一 摇</a></li>
	<li class="menu07"><a href="__APP__/Index/ceremony">启动仪式</a></li>
</ul>
<div id="info">
管理员：<?php echo (session('username')); ?>
<a href="__APP__/Login/doLogout">退出</a>
</div>
</div>

	<table id="main" cellpadding="0" cellspacing="0" border="0">
		<tr>
        <td width="229" valign="top">
        <div id="left">
	<ul>
		<li class="menu01"><a href="__APP__/Index/index">公共账号</a></li>
		<li class="menu02"><a href="__APP__/Index/password">修改密码</a></li>
		<li class="menu03"><a href="__APP__/Index/wall">微 信 墙</a></li>
		<li class="menu04"><a href="__APP__/Index/prize">微 抽 奖</a></li>
		<li class="menu05"><a href="__APP__/Index/vote">微 投 票</a></li>
		<li class="menu06"><a href="__APP__/Index/shake">摇 一 摇</a></li>
		<li class="menu07"><a href="__APP__/Index/ceremony">启动仪式</a></li>
	</ul>
</div>
        </td>
		<td valign="top" id="right">
			<?php if($update != '' ): ?><div id="update">
	<div id="message">
	<MARQUEE class="gonggao" scrollAmount="2" onMouseOut="this.start()" onMouseOver="this.stop()"  direction="left"><?php echo ($update); ?></MARQUEE>
	</div>
	</div><?php endif; ?>
			<div id="column">
				<img src='__PUBLIC__/Images/getqrcode.jpg' width='200' height="200"/>	
<p>		
此功能仅限商业付费用户试用<br/>
购买咨询QQ：1668191774<br/>
演示：请关注微信公众账号 zhidianweixin <br/>
微信墙：http://w.zd3.cn/wall.php/Wap/wall/token/xgjfsu1384331181 关注：zhidianweixin 回复 微信墙<br/>
微抽奖：http://w.zd3.cn/wall.php/Wap/prize/token/xgjfsu1384331181 <br/>
微投票：http://w.zd3.cn/wall.php/Wap/vote/token/xgjfsu1384331181 关注：zhidianweixin 回复 投票<br/>
摇一摇：http://w.zd3.cn/wall.php/Wap/shake/token/xgjfsu1384331181 关注：zhidianweixin 回复 摇一摇<br/>
启动仪式：http://w.zd3.cn/wall.php/Wap/ceremonym/token/xgjfsu1384331181 关注：zhidianweixin 回复 启动仪式<br/>
2014-3-15 f2.0 更新细则 <br/>
微信商业版中<br/>
微信墙新增接收图片和表情的功能，和高级接口用户无头像时无默认图片替代<br/>
完善了<br/>
抽奖的BUG<br/>
微信公共平台有时接收信息不回<br/>
新增摇一摇的现场活动功能<br/>
和启动仪式的功能<br/>
</p>
			</div>
		</td>
        </tr>	
	</table>
	<div id="bottom">
	<div class="gray"></div>
    <?php echo ($footer); ?>
</div>
</body>
</html>