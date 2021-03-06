<?php

class WeixinAction extends Action
{
    private $token;
    private $fun;
    private $functionw;
    private $functionv;
    private $username;
    private $password;
    private $time;
    private $appid;
    private $appsecret;
    private $data = array();
    public function index()
    {
		Vendor('weixin.Wechat#class');
        $this->token = $this->_get('token');
		$wall=M('wall')->find();
		$this->functionw=$wall['function'];
		$vote=M('vote')->find();
		$this->functionv=$vote['function'];
		$publicnum=M('publicnum')->find();
		$this->appid=$publicnum['appid'];
		$this->appsecret=$publicnum['appsecret'];
		$this->username=$publicnum['username'];
		$this->password=$publicnum['password'];
		$this->time=$publicnum['time'];
		
		if($this->token==md5($publicnum['original'])){
			$weixin      = new Wechat($this->token);
			$data        = $weixin->request();
			$this->data  = $weixin->request();
			$this->url    = $_SERVER['HTTP_HOST'];
			list($content, $type) = $this->reply($data);
			$weixin->response($content, $type);
		}
    }
    private function reply($data)
    {
        if ('subscribe' == $data['Event']) {
			$state=M('state');
			$statedata['fromusername']=$this->data['FromUserName'];
			$statedata['state']="0";
			$state->add($statedata);
            return array(
				array(
					array(
						'您好,欢迎使用微信墙功能',
					),
					array(
						'回复【1】获得此次抽奖资格',
						'',
						'',
						'',
					),
					 array(
						'回复【2】参与投票',
					),
					array(
						'回复【返回】或者【后退】返回主菜单',
					),
				),
				'news'
			);
        } elseif ('unsubscribe' == $data['Event']) {
			$state=M('state');
			$statedata['fromusername']=$this->data['FromUserName'];
			$state->where($statedata)->delete();
        }
		
			
        $key     = $data['Content'];
		if($key=='返回' || $key=='后退'){
			$state=M('state');
			$statewhere['fromusername']=$this->data['FromUserName'];
			$statedata['state']="0";
			$state->where($statewhere)->save($statedata);
		}
		$states=M('state');
		$statewhere['fromusername']=$this->data['FromUserName'];
		$stateinfo=$states->where($statewhere)->find();
		$statefansnow=$stateinfo['state'];
		
		$publicnumstate=M('publicnum')->find();
		if($publicnumstate['type']==2){

			if($statefansnow==1){
				if($this->functionw==1){
					$fans=M('fans');
					$where['fromusername']=$this->data['FromUserName'];
					$fansinfo=$fans->where($where)->find();
					if($fansinfo){
						$message['img']=$fansinfo['img'];
						$list=M('list');
						$message['nickname']=$fansinfo['nickname'];
						$message['content']=$this->data['Content'];
						$message['time']=$this->data['CreateTime'];
						$message['examine']="0";
						$message['choose']="0";
						$message['fromusername']=$this->data['FromUserName'];
						$message['fake_id']=$fansinfo['fake_id'];
						$message['newsid']=$this->data['MsgId'];
						$message['sex']=$fansinfo['sex'];
						$list->add($message);
					
						return array(
							array(
								array(
									'发送成功',
								),
								array(
									'您发送的祝福即将在大屏幕上滚动播出',
								),
								array(
									'回复【返回】或者【后退】返回主菜单',
								),
								
							),
							'news'
						);
					}else{
						////////////////////////////////////////////////////////////////////////////
						//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
						//https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
						$publicaccess=M('publicnum')->find();
						if($publicaccess['accesstoken']!=""){
							$difference=time()-$publicaccess['time'];
							if($difference > 7190){
								//_______根据appid和appsecret获取access_token
								$access_token       = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret);
								$access_tokendata   = json_decode($access_token,true);
								$access_tokennow=$access_tokendata['access_token'];
								$data['accesstoken']=$access_tokennow;
								$data['time']=time();
								$data['Id']=$publicaccess['Id'];
								$publicnuminfo=M('publicnum')->save($data);
							}else{
								$access_tokennow=$publicaccess['accesstoken'];
							}
						}else{
							//_______根据appid和appsecret获取access_token
							$access_token       = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret);
							$access_tokendata   = json_decode($access_token,true);
							$access_tokennow=$access_tokendata['access_token'];
							$data['accesstoken']=$access_tokennow;
							$data['time']=time();
							$data['Id']=$publicaccess['Id'];
							$publicnuminfo=M('publicnum')->save($data);
						} 
						//_______根据openid和access_token获取用户信息
						$userinfo     		= file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_tokennow.'&openid='.$this->data['FromUserName'].'&lang=zh_CN');
						$userinfodata       = json_decode($userinfo,true);
						
						$fansinfo['nickname']=$userinfodata['nickname'];
						$fansinfo['fromusername']=$this->data['FromUserName'];
						$fansinfo['fake_id']="";
						$fansinfo['sex']=$userinfodata['sex'];
						$fansinfo['country']=$userinfodata['country'];
						$fansinfo['province']=$userinfodata['province'];
						$fansinfo['city']=$userinfodata['city'];
						//下载图片
						if($userinfodata['headimgurl']!=""){
						$headimgurlarr=explode('/',$userinfodata['headimgurl'],-1);
						$headimgurl=implode('/',$headimgurlarr)."/96";
						$dataaa = file_get_contents($headimgurl); 
						$filename="upload/".time().rand(100000,999999).".jpg";
						$jpg = $dataaa;
						$file = fopen($filename,"w");
						fwrite($file,$jpg);
						fclose($file); 
						$fansinfo['img']="http://".$this->url."/".$filename;
						}else{
						$fansinfo['img']="http://wxq.08k.cn/Public/Images/default.jpg";
						}
						//下载图片
						
						
						$fansadd=M('fans')->add($fansinfo);
						
						$list=M('list');
						$message['nickname']=$userinfodata['nickname'];
						$message['content']=$this->data['Content'];
						$message['time']=$this->data['CreateTime'];
						$message['examine']="0";
						$message['choose']="0";
						$message['fromusername']=$this->data['FromUserName'];
						$message['fake_id']="";
						$message['newsid']=$this->data['MsgId'];
						$message['sex']=$userinfodata['sex'];
						$message['imgurl']=$userinfodata['headimgurl'];//96
						if($userinfodata['headimgurl']!=""){
						$message['img']="http://".$this->url."/".$filename;
						}else{
						$message['img']="http://wxq.08k.cn/Public/Images/default.jpg";
						}
						$list->add($message);
						////////////////////////////////////////////////////////////////////////////
						return array(
							array(
								array(
									'发送成功',
								),
								array(
									'您发送的祝福即将在大屏幕上滚动播出',
								),
								array(
									'回复【返回】或者【后退】返回主菜单',
								),
								
							),
							'news'
						);
					}  
				}else{
					return array(
						'微信墙功能以关闭',
						'text'
					);
				}

			}elseif($statefansnow==2){
				if($this->functionv==1){
					$fanvote=M('fanvote');
					$where['fromusername']=$this->data['FromUserName'];
					$state=$fanvote->where($where)->find();
					if($state){
						$project=M('project');
						$projectinfo=$project->find($state['pid']);
						return array(
							array(
								array(
									'您已投票，每人一票',
								),
								array(
									'您已把宝贵的一票投给了【'.$projectinfo['project'].'】TA目前有【'.$projectinfo['num'].'】票',
								),
								// array(
									// '发送【结果】查看最新数据',
								// ),
								array(
									'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
								),
								
							),
							'news'
						);
					}else{
						$project=M('project');
						$projectwhere['order']=$this->data['Content'];
						$projectinfo=$project->where($projectwhere)->find();
						if(count($projectinfo) != "" ){
							$project->where('Id='.$projectinfo['Id'])->setInc('num',1);
							$fanvote=M('fanvote');
							$fans['time']=$this->data['CreateTime'];
							$fans['fromusername']=$this->data['FromUserName'];
							$fans['pid']=$projectinfo['Id'];
							$fanvote->add($fans);
							
							$num=$projectinfo['num']+1;
							return array(
								array(
									array(
										'投票成功',
									),
									array(
										'您成功的把宝贵的一票投给了【'.$projectinfo['project'].'】TA目前有【'.$num.'】票',
									),
									// array(
										// '发送【结果】查看最新数据',
									// ),
									array(
										'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
									),
									
								),
								'news'
							);	
						}else{
							$tpxm1=M('project')->select();
							for($i=0;$i<count($tpxm1);$i++){
							$xmlist1[]="\n【".$i."】".$tpxm1[$i]['project']."                            票数".$tpxm1[$i]['num'];
							}
							$xmlist2=implode('',$xmlist1);
							
							$xmlist="请回复正确的序列号参与投票".$xmlist2;
							
							return array(
								array(
									array(
										'系统投票每人只能投一票',
									),
									array(
										$xmlist,
									),
									array(
										'请回复正确的序列号参与投票',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}
					} 
				}else{
					return array(
						'微投票功能以关闭',
						'text'
					);
				}	
			}else{
				switch ($key) {
					case '1':
						$statethree=M('state');
						$statewhere['fromusername']=$this->data['FromUserName'];
						$statedata['state']="1";
						$statethree->where($statewhere)->save($statedata);
						if($this->functionw==1){
							return array(
								array(
									array(
										'成功进入上墙模式回复消息既有机会上墙及参与抽奖',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}else{
							return array(
								'微信墙功能已关闭',
								'text'
							);
						}
						break;
					case '2':
						if($this->functionv==1){
							$statethree=M('state');
							$statewhere['fromusername']=$this->data['FromUserName'];
							$statedata['state']="2";
							$statethree->where($statewhere)->save($statedata); 
							
							$tpxm1=M('project')->select();
							for($i=0;$i<count($tpxm1);$i++){
							$xmlist1[]="\n【".$i."】".$tpxm1[$i]['project']."                            票数".$tpxm1[$i]['num'];
							}
							$xmlist2=implode('',$xmlist1);
							$xmlist="请回复序列号参与投票".$xmlist2;
							return array(
								array(
									array(
										'系统投票每人只能投一票',
									),
									array(
										$xmlist,
									),
									array(
										'请回复序列号参与投票',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}else{
							return array(
								'微投票功能已关闭',
								'text'
							);
						}
						break;
					default:
						$statesecond=M('state');
						$statewhere['fromusername']=$this->data['FromUserName'];
						$usernamenow=$statesecond->where($statewhere)->find();
						if(count($usernamenow)>0){
							$statedata['state']="0";
							$statesecond->where($statewhere)->save($statedata);
						}else{
							$statedata['fromusername']=$this->data['FromUserName'];
							$statedata['state']="0";
							$statesecond->add($statedata);
						}
						
						return array(
							array(
								array(
									'您好,欢迎使用微信墙功能',
								),
								array(
									'回复【1】参与微信墙活动',
									'',
									'',
									'',
								),
								array(
									'回复【2】参与投票',
								),
								array(
									'回复【返回】或者【后退】返回主菜单',
								),
							),
							'news'
						);
				}
			}
		}else{
			////////////////////////////////////plan///////////////////////////////////////////////
			if($statefansnow==1){
				if($this->functionw==1){
					$fans=M('fans');
					$where['fromusername']=$this->data['FromUserName'];
					$fansinfo=$fans->where($where)->find();
					if($fansinfo){
						$message['img']=$fansinfo['img'];
						$list=M('list');
						$message['nickname']=$fansinfo['nickname'];
						$message['content']=$this->data['Content'];
						$message['time']=$this->data['CreateTime'];
						$message['examine']="0";
						$message['choose']="0";
						$message['fromusername']=$this->data['FromUserName'];
						$message['fake_id']=$fansinfo['fake_id'];
						$message['newsid']=$this->data['MsgId'];
						$message['sex']=$fansinfo['sex'];
						$list->add($message);
					
						return array(
							array(
								array(
									'发送成功',
								),
								array(
									'您发送的祝福即将在大屏幕上滚动播出',
								),
								array(
									'回复【返回】或者【后退】返回主菜单',
								),
								
							),
							'news'
						);
					}else{
						///////////////////////////////plan/////////////////////////////////////////////
						vendor('mndl.wechatext#class');
						function logdebug($text){
								file_put_contents('log.txt',$text."\n",FILE_APPEND);                
						};
						$options = array(
							    'account'=>$this->username,
								'password'=>$this->password,
								'datapath'=>'ookie_', 
								'debug'=>true,
								'logcallback'=>'logdebug'        
						); 
						$wechat = new Wechatext($options);
						if ($wechat->checkValid()) {
							$userdata = $wechat->getTopMsg();
							$date_time_hf=$userdata['date_time'];
							$content_hf=$userdata['content'];
							/////////////////////////////////////
							if($date_time_hf==$this->data['CreateTime'] && $content_hf==$this->data['Content']){
								$whereinfo['fromusername']=$this->data['FromUserName'];
								$fansinfo=M('fans')->where($whereinfo)->find();
								if(count($fansinfo)>0){
									
									$data_wxq['nickname']=$userdata['nick_name'];
									$data_wxq['content']=$userdata['content'];
									$data_wxq['newsid']=$userdata['id'];
									$data_wxq['time']=$msglist[$i]['date_time'];
									$data_wxq['examine']="0";
									$data_wxq['choose']="0";
									$data_wxq['fake_id']=$userdata['fakeid'];
									$data_wxq['fromusername']=$this->data['FromUserName'];
									$data_wxq['img']=$fansinfo['img'];
									M('list')->add($data_wxq);
									
									return array(
									
										array(
											array(
												'发送成功',
											),
											array(
												'你已经成功发送等待审核即可上墙了',
											),
											/* array(
												'ps：点击查看大屏上墙',
												'',
												'',
												'',
											), */
											array(
												'回复【返回】或者【后退】返回主菜单',
											),
											
										),
										'news'
									);
									
								}else{
									$data_wxq['nickname']=$userdata['nick_name'];
									$data_wxq['fake_id']=$userdata['fakeid'];
									$data_wxq['fromusername']=$this->data['FromUserName'];
									$headingimg = $wechat->getInfo2($data_wxq['fake_id']);
									
									if (is_readable($filename) == false) {
									$dataaa=$headingimg['body'];
									$filename="upload/".$this->data['FromUserName'].".jpg";
									$jpg = $dataaa;
									$file = fopen($filename,"w");//打开文件准备写入
									fwrite($file,$jpg);//写入
									fclose($file);//关闭 
									}
									$data_wxq['img']="http://".$this->url."/".$filename; 
									M('fans')->add($data_wxq);
									
									$data_wxq1['nickname']=$userdata['nick_name'];
									$data_wxq1['content']=$userdata['content'];
									$data_wxq1['newsid']=$userdata['id'];
									$data_wxq1['time']=$userdata['date_time'];
									$data_wxq1['examine']="0";
									$data_wxq1['choose']="0";
									$data_wxq1['fake_id']=$userdata['fakeid'];
									$data_wxq1['fromusername']=$this->data['FromUserName'];
									$data_wxq1['img']="http://".$this->url."/".$filename;
									M('list')->add($data_wxq1);
									
									return array(
									
										array(
											array(
												'发送成功',
											),
											array(
												'你已经成功发送等待审核即可上墙了',
											),
											/* array(
												'ps：点击查看大屏上墙',
												'',
												'',
												'',
											), */
											array(
												'回复【返回】或者【后退】返回主菜单',
											),
											
										),
										'news'
									);
								} 
							}
							else{
							/////////////////////////////////////////////////////////////////////////////
								$wherefans['fromusername']=$this->data['FromUserName'];
								$wherefans['newsid']=array('neq','');
								$first=M('list')->where($wherefans)->order('id DESC')->find();
								if(!empty($first['newsid'])){
									$num = $wechat->getNewMsgNum($first['newsid']);
									$msglist = $wechat->getMsg($userdata['id'],0,$num,0,0,0);
									for($i=0;$i<$num;$i++){
										$wxq_time[$i]=$msglist[$i]['date_time'];
										$wxq_content[$i]=$msglist[$i]['content'];
											if($wxq_time[$i]==$this->data['CreateTime'] && $wxq_content[$i]==$this->data['Content']){
												$wherefansif['fromusername']=$this->data['FromUserName'];
												$fansinfo=M('fans')->where($wherefansif)->find();
												if(count($fansinfo)>0){
													
													$data_wxq['nickname']=$msglist[$i]['nick_name'];
													$data_wxq['content']=$msglist[$i]['content'];
													$data_wxq['newsid']=$msglist[$i]['id'];
													$data_wxq['time']=$msglist[$i]['date_time'];
													$data_wxq['examine']="0";
													$data_wxq['choose']="0";
													$data_wxq['fake_id']=$msglist[$i]['fakeid'];
													$data_wxq['fromusername']=$this->data['FromUserName'];
													$data_wxq['img']=$fansinfo['img'];
													M('list')->add($data_wxq);
													
												}else{
													$data_wxq['nickname']=$msglist[$i]['nick_name'];
													$data_wxq['fake_id']=$msglist[$i]['fakeid'];
													$data_wxq['fromusername']=$this->data['FromUserName'];
													
													$filename="upload/".$this->data['FromUserName'].".jpg";
													if (is_readable($filename) == false) {
													$headingimg = $wechat->getInfo2($data_wxq['fake_id']);
													$dataaa=$headingimg['body'];
													$jpg = $dataaa;
													$file = fopen($filename,"w");//打开文件准备写入
													fwrite($file,$jpg);//写入
													fclose($file);//关闭 
													}
													$data_wxq['img']="http://".$this->url."/".$filename;
													
													M('fans')->add($data_wxq);
													
													$data_wxq1['nickname']=$msglist[$i]['nick_name'];
													$data_wxq1['content']=$msglist[$i]['content'];
													$data_wxq1['newsid']=$msglist[$i]['id'];
													$data_wxq1['time']=$msglist[$i]['date_time'];
													$data_wxq1['examine']="0";
													$data_wxq1['choose']="0";
													$data_wxq1['fake_id']=$msglist[$i]['fakeid'];
													$data_wxq1['fromusername']=$this->data['FromUserName'];
													$data_wxq1['img']=$fansinfo['img'];
													M('list')->add($data_wxq1);
												}
													
												return array(
													
													array(
														array(
															'发送成功',
														),
														array(
															'你已经成功发送等待审核即可上墙了',
														),
														/* array(
															'ps：点击查看大屏上墙',
															'',
															'',
															'',
														), */
														array(
															'回复【返回】或者【后退】返回主菜单',
														),
														
													),
													'news'
												);
											}
										
									}
								}else{
									$msglistzt = $wechat->getMsg(0,0,1,1,0,0);
									
									$num = $wechat->getNewMsgNum($msglistzt[0]['date_time']);
									$msglist = $wechat->getMsg($userdata['id'],0,$num,0,0,0);
									for($i=0;$i<count($msglist);$i++){
										$wxq_time[$i]=$msglist[$i]['date_time'];
										$wxq_content[$i]=$msglist[$i]['content'];
										if($wxq_time[$i]==$this->data['CreateTime'] && $wxq_content[$i]==$this->data['Content']){
											$wherefansif['fromusername']=$this->data['FromUserName'];
											$fansinfo=M('fans')->where($wherefansif)->find();
											if(count($fansinfo)>0){ 
												
												$data_wxq['nickname']=$msglist[$i]['nick_name'];
												$data_wxq['content']=$msglist[$i]['content'];
												$data_wxq['newsid']=$msglist[$i]['id'];
												$data_wxq['time']=$msglist[$i]['date_time'];
												$data_wxq['examine']="0";
												$data_wxq['choose']="0";
												$data_wxq['fake_id']=$msglist[$i]['fakeid'];
												$data_wxq['fromusername']=$this->data['FromUserName'];
												$data_wxq['img']=$fansinfo['img'];
												M('list')->add($data_wxq);
												
											}else{
												$data_wxq['nickname']=$msglist[$i]['nick_name'];
												$data_wxq['fake_id']=$msglist[$i]['fakeid'];
												$data_wxq['fromusername']=$this->data['FromUserName'];
												
												
												$filename="upload/".$this->data['FromUserName'].".jpg";
												if (is_readable($filename) == false) {
												$headingimg = $wechat->getInfo2($data_wxq['fake_id']);
												$dataaa=$headingimg['body'];
												$jpg = $dataaa;
												$file = fopen($filename,"w");//打开文件准备写入
												fwrite($file,$jpg);//写入
												fclose($file);//关闭 
												}
												$data_wxq['img']="http://".$this->url."/".$filename;
												
												M('fans')->add($data_wxq);
												
												$data_wxq1['nickname']=$msglist[$i]['nick_name'];
												$data_wxq1['nickname']=$msglist[$i]['nick_name'];
												$data_wxq1['content']=$msglist[$i]['content'];
												$data_wxq1['newsid']=$msglist[$i]['id'];
												$data_wxq1['time']=$msglist[$i]['date_time'];
												$data_wxq1['examine']="0";
												$data_wxq1['choose']="0";
												$data_wxq1['fake_id']=$msglist[$i]['fakeid'];
												$data_wxq1['fromusername']=$this->data['FromUserName'];
												$data_wxq1['img']=$fansinfo['img'];
												M('list')->add($data_wxq1);
											}
											
											return array(
												
												array(
													array(
														'发送成功',
													),
													array(
														'你已经成功发送等待审核即可上墙了',
													),
													/* array(
														'ps：点击查看大屏上墙',
														'',
														'',
														'',
													), */
													array(
														'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
													),
													
												),
												'news'
											);
										}
										
									}

								}
							// //////////////////////////////////////////////////////////////////////////////////
							}
							////////////////////////////////////
						}else{
							return array(
								array(
									array(
										'发送失败请重新发送1',
									),
									array(
										'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
									),
									
								),
								'news'
							); 
						}
						///////////////////////////////plan/////////////////////////////////////////////
					} 
				}else{
					return array(
						'微信墙功能以关闭',
						'text'
					);
				}	
			}elseif($statefansnow==2){
				if($this->functionv==1){
					$fanvote=M('fanvote');
					$where['fromusername']=$this->data['FromUserName'];
					$state=$fanvote->where($where)->find();
					if($state){
						$project=M('project');
						$projectinfo=$project->find($state['pid']);
						return array(
							array(
								array(
									'您已投票，每人一票',
								),
								array(
									'您已把宝贵的一票投给了【'.$projectinfo['project'].'】TA目前有【'.$projectinfo['num'].'】票',
								),
								// array(
									// '发送【结果】查看最新数据',
								// ),
								array(
									'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
								),
								
							),
							'news'
						);
					}else{
						$project=M('project');
						$projectwhere['order']=$this->data['Content'];
						$projectinfo=$project->where($projectwhere)->find();
						if(count($projectinfo) != "" ){
							$project->where('Id='.$projectinfo['Id'])->setInc('num',1);
							$fanvote=M('fanvote');
							$fans['time']=$this->data['CreateTime'];
							$fans['fromusername']=$this->data['FromUserName'];
							$fans['pid']=$projectinfo['Id'];
							$fanvote->add($fans);
							
							$num=$projectinfo['num']+1;
							return array(
								array(
									array(
										'投票成功',
									),
									array(
										'您成功的把宝贵的一票投给了【'.$projectinfo['project'].'】TA目前有【'.$num.'】票',
									),
									// array(
										// '发送【结果】查看最新数据',
									// ),
									array(
										'回复【返回】或者【后退】返回主菜单，回复【退出】即可退出该微信墙模式',
									),
									
								),
								'news'
							);	
						}else{
							$tpxm1=M('project')->select();
							for($i=0;$i<count($tpxm1);$i++){
							$xmlist1[]="\n【".$i."】".$tpxm1[$i]['project']."                            票数".$tpxm1[$i]['num'];
							}
							$xmlist2=implode('',$xmlist1);
							
							$xmlist="请回复正确的序列号参与投票".$xmlist2;
							
							return array(
								array(
									array(
										'系统投票每人只能投一票',
									),
									array(
										$xmlist,
									),
									array(
										'请回复正确的序列号参与投票',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}
					} 
				}else{
					return array(
						'微投票功能以关闭',
						'text'
					);
				}	
			}else{
				switch ($key) {
					case '1':
						$state=M('state');
						$statewhere['fromusername']=$this->data['FromUserName'];
						$statedata['state']="1";
						$state->where($statewhere)->save($statedata);

						if($this->functionw==1){
							return array(
								array(
									array(
										'成功进入上墙模式回复消息既有机会上墙及参与抽奖',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}else{
							return array(
								'微信墙功能已关闭',
								'text'
							);
						}
						break;
					case '2':
						if($this->functionv==1){
							$state=M('state');
							$statewhere['fromusername']=$this->data['FromUserName'];
							$statedata['state']="2";
							$state->where($statewhere)->save($statedata); 
							
							$tpxm1=M('project')->select();
							for($i=0;$i<count($tpxm1);$i++){
							$xmlist1[]="\n【".$i."】".$tpxm1[$i]['project']."                            票数".$tpxm1[$i]['num'];
							}
							$xmlist2=implode('',$xmlist1);
							$xmlist="请回复序列号参与投票".$xmlist2;
							return array(
								array(
									array(
										'系统投票每人只能投一票',
									),
									array(
										$xmlist,
									),
									array(
										'请回复序列号参与投票',
									),
									array(
										'回复【返回】或者【后退】返回主菜单',
									),
								),
								'news'
							);
						}else{
							return array(
								'微投票功能已关闭',
								'text'
							);
						}
						break;
					default:
						$statesecond=M('state');
						$statewhere['fromusername']=$this->data['FromUserName'];
						$usernamenow=$statesecond->where($statewhere)->find();
						if(count($usernamenow)>0){
							$statedata['state']="0";
							$statesecond->where($statewhere)->save($statedata);
						}else{
							$statedata['fromusername']=$this->data['FromUserName'];
							$statedata['state']="0";
							$statesecond->add($statedata);
						}
						return array(
							array(
								array(
									'您好,欢迎使用微信墙功能',
								),
								array(
									'回复【1】参与微信墙活动',
									'',
									'',
									'',
								),
								array(
									'回复【2】参与投票',
								),
								array(
									'回复【返回】或者【后退】返回主菜单',
								),
							),
							'news'
						);
				}
			}
			////////////////////////////////////plan///////////////////////////////////////////////
		}
    }
}
?>