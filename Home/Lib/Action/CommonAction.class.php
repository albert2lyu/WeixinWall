<?php
	class CommonAction extends Action{
		Public function _initialize(){
   		// 初始化的时候检查用户权限
   			if(!isset($_SESSION['username']) || $_SESSION['username']==''){
				$this->redirect('Login/index');
			}
//			$footer=file_get_contents('http://w.zd3.cn/wxq/footer.txt');
//			$footer = iconv("gb2312", "utf-8//IGNORE",$footer); 
//			$update=file_get_contents('http://w.zd3.cn/wxq/update.txt');
//			$update = iconv("gb2312", "utf-8//IGNORE",$update); 
			$this->assign('footer','');
			$this->assign('update','');
		}
	}
?>
