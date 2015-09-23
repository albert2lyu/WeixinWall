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
			<div class="gongao">
            	<?php if($update != '' ): ?><div id="update">
	<div id="message">
	<MARQUEE class="gonggao" scrollAmount="2" onMouseOut="this.start()" onMouseOver="this.stop()"  direction="left"><?php echo ($update); ?></MARQUEE>
	</div>
	</div><?php endif; ?>
            </div>
            <div class="smallnav" >
				<a class="active" href="__APP__/Wap/prize" target="_blank">活动地址</a>
			</div>
			<div id="column">
				<form name="publicprize" action="" method="post" >
					<table cellpadding="0" cellspacing="0" border="0" class="gzzh">
                    <tr class="dark_blue">
                    <td width="18"></td><td>抽奖标题　　　　：<input class="inpu" name="title" type="text" value="<?php echo ($draw['title']); ?>" /><br/>
									    <input name="Id" type="hidden" value="<?php echo ($draw['Id']); ?>" /></td>
					</tr>
                    <tr class="blue">
                    <td></td><td>抽奖模式　　　　：
					<?php if($draw['type'] == '0' || $draw['type'] == ''): ?><input type="radio" name="type" checked = "checked" value="1" />按微信墙上墙数量来抽奖，每个参与者的中奖率由参与者审核后的上墙信息量来决定<br/>
					　　　　　　　　：<input type="radio" name="type" value="2" />按参与者来决定，每个参与者中奖率相等<br/>
					<?php else: ?>
					<input type="radio" name="type" value="1" <?php if($draw['type'] == '1' ): ?>checked = "checked"<?php endif; ?>/>按微信墙上墙数量来抽奖，每个参与者的中奖率由参与者审核后的上墙信息量来决定<br/>
					　　　　　　　　：<input type="radio" name="type" value="2" <?php if($draw['type'] == '2' ): ?>checked = "checked"<?php endif; ?>/>按参与者来决定，每个参与者中奖率相等<br/><?php endif; ?></td>
					</tr>
                    <tr class="dark_blue">
                    <td></td><td>是否开启　　　　：
					<?php if($draw['function'] == '0' || $draw['function'] == ''): ?><input type="radio" name="function" checked = "checked" value="1" />是
					<input type="radio" name="function" value="2" />否<br/>
					<?php else: ?>
					<input type="radio" name="function" value="1" <?php if($draw['function'] == '1' ): ?>checked = "checked"<?php endif; ?>/>是
					<input type="radio" name="function" value="2" <?php if($draw['function'] == '2' ): ?>checked = "checked"<?php endif; ?>/>否<br/><?php endif; ?></td>
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