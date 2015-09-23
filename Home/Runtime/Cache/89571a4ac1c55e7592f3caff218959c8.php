<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支点科技-微信墙</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/basic.css" />
</head> 
<script type="text/javascript">
	function insertRow(){
		var rowindex = document.all("addordel").length;
		if(rowindex>=8){
			alert("一次只能上传8个文件！");
			return false;
		}
		var obj = document.getElementsByName("addordel")[0].cloneNode(true);
		document.all("change").appendChild(obj);
		//document.getElementsByName("change").appendChild(obj);
	}
	function delRow(){
		var allrows = document.all("addordel");
		var rowindex = document.all("addordel").length;
		if(rowindex>=2){
	       event.srcElement.parentNode.removeNode(true);   这是在IE下的方式
	        event.target.parentNode.removeChild(true);
		document.getElementById("change").removeChild(allrows[allrows.length-1]);
		}else{
			alert("警告：最后一个不能删除！！");
		}
	}
	function chkfile(){
		var obj = document.getElementsByName("upfile[]");
		num = obj.length;
		for (i=0;i<num ;i++ )
		{
			if(obj[i].value == 0){
				alert("请添加上传文件！");
				return false;
			}
		}
	}
</script>
<script src="__PUBLIC__/common.js"></script>
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
				<a class="active" href="__APP__/Wap/vote" target="_blank">活动地址</a>
				<a href="__APP__/Index/votereset">重新投票</a>
			</div>
			<div id="column">
				<form name="publicvote" action="" method="post" >
					<table cellpadding="0" cellspacing="0" border="0" class="gzzh">
                    <tr class="dark_blue">
                    <td width="18"></td><td>投票标题　　　　：<input class="inpu" name="title" type="text" value="<?php echo ($vote['title']); ?>" /><br/>
									    <input name="Id" type="hidden" value="<?php echo ($vote['Id']); ?>" /></td>
					
					</tr>
                    <tr class="blue">
                    <td></td>
                    <td>

						<ul id="change">
						<table class="ListProduct" border="0" cellspacing="0" cellpadding="0" >
						<?php if($tp == '1'): if(is_array($projectnum)): $i = 0; $__LIST__ = $projectnum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectnum): $mod = ($i % 2 );++$i;?><tbody id="div_add_del<?php echo ($projectnum['order']); ?>" width="900">
						<tr>
						<td width="500">
						
							投票项目<?php echo ($num++); ?>：
							<input class="inpu" type="text" id="project[]" name="project[]" value="<?php echo ($projectnum['project']); ?>" style="width:200px;"/>
							票数：<input class="inpu" type="text" id="num[]" name="num[]" value="<?php echo ($projectnum["num"]); ?>" style="width:40px;"/>
							<button class="del"  type="button" <?php if($projectnum['order'] != '0'): ?>onclick="delrow(this, 'div_add_del<?php echo ($projectnum['order']); ?>');"<?php endif; ?>  >删除</button>&nbsp;
							<button class="add" id="vtype" onclick="addrow('div_add_del<?php echo ($projectnum['order']); ?>');" type="button">添加</button>&nbsp;
							
						</td>
						</tr>
						</tbody><?php endforeach; endif; else: echo "" ;endif; ?>	
						<?php else: ?>
						<tbody id="div_add_del" name="div_add_del">
						<tr>
						<td>
							投票项目：<input class="inpu" type="text" id="project[]" name="project[]" value="" style="width:200px;"/>
							票数：<input class="inpu" type="text" id="num[]" name="num[]" value="" style="width:40px;"/>
							<button type="button" onclick="delrow(this, 'div_add_del');">删除</button>&nbsp;
							<button id="vtype" onclick="addrow('div_add_del');" type="button">添加</button>&nbsp;
							<br/>
						</td>
						</tr>
						</tbody><?php endif; ?>
						
						<!--<tbody>
						<tr>
							<td>
							<button type="button" id="vtype" onclick="addrow('div_add_del');" class="btnGrayS vm" value="true"><strong>添加选项</strong></button>至少2项,最多15项,已经添加[<span id='aditem'></span>]项
							</td>
						</tr>
						</tbody>
						-->
						</table>
						</ul>
					
					</td>
					</tr>
                    <tr class="dark_blue">
                    <td></td><td>是否开启　　　　：
					<?php if($vote['function'] == '0' || $vote['function'] == ''): ?><input type="radio" name="function" checked = "checked" value="1" />是
					<input type="radio" name="function" value="2" />否<br/>
					<?php else: ?>
					<input type="radio" name="function" value="1" <?php if($vote['function'] == '1' ): ?>checked = "checked"<?php endif; ?>/>是
					<input type="radio" name="function" value="2" <?php if($vote['function'] == '2' ): ?>checked = "checked"<?php endif; ?>/>否<br/><?php endif; ?>
					</td>
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
<script>
var count = 1;
function addrow(tbody) {
var add = false;
var newnode;
if($$(tbody).rows.length == 1 && $$(tbody).rows[0].style.display == 'none') {
$$(tbody).rows[0].style.display = '';
newnode = $$(tbody).rows[0];
} else {
newnode = $$(tbody).rows[0].cloneNode(true);
add = true;
}
if(add) {
$$(tbody).appendChild(newnode);
}
var aditem = document.getElementById('aditem');
aditem.innerHTML=count;
if(count==1500){var vtype = document.getElementById('vtype');
vtype.disabled="disabled";vtype.value="disabled";}count++;
}
function delrow(obj, tbody) {
$$(tbody).removeChild(obj.parentNode.parentNode);
}
</script>
	<div id="bottom">
	<div class="gray"></div>
    <?php echo ($footer); ?>
</div>
</body>
</html>