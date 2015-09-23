<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支点科技-微信墙</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/basic.css" />
</head> 
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
		<td valign="top" width="229">
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
				<form name="paccout" action="" method="post" >
					<table cellpadding="0" cellspacing="0" border="0" class="gzzh">
                    <tr class="dark_blue">
                    <td width="18"><span class="red">*</span></td><td>用户名　：<input class="inpu" name="Username" type="text" /><br/></td>
					</tr>
                    <tr class="blue">
                    <td><span class="red">*</span></td><td>密　码　：<input class="inpu" name="Password" type="password" size="22" /><br/></td>
					</tr>
                    <tr class="dark_blue">
                    <td><span class="red">*</span></td><td>重复密码：<input class="inpu" name="repassword" type="password" size="22" /><br/>
					<input name="Id" type="hidden" value="1" /></td>
					</tr>
                    <tr>
                    <td colspan="2"><input class="submit" type="submit" name="submit" value="提交"/>　<input class="reset" type="reset" name="reset" value="重置" /><br/></td>
                    </tr>
                    </table>
                </form>	
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