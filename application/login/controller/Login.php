<?php
namespace app\login\controller; use app\XDeode; use think\Controller; class Login extends Controller 
{
  
  
  
	public function index() 
	{
		return view('index');
	}
	public function ping() 
	{
		$list = db('ping')->order('orderid asc')->select();
		$xcode = new XDeode(10,'6666.6666666');
		$zcode = new XDeode(10,'8888.8888888');
		$ccode = new XDeode(10,'9999.9999999');
		$arr['code'] = 1;
		$arr['key'] = $xcode->encode(time());
		$id = input('uid');
		if($id) 
		{
			$num = db('user')->where('id',$id)->count();
			if($num=='0') 
			{
				return json(['code'=>0,'msg'=>'用户不存在']);
			}
			db('user')->where('id',$id)->update(['key'=>$arr['key']]);
		}
		$arr['run'] = $id?$ccode->encode($id):'';
		foreach ($list as $key=>$value) 
		{
			unset($data);
			unset($file_path);
			unset($file_path);
			$list[$key]['id'] = $zcode->encode($value['id']);
			$file_path = iconv("UTF-8","gb2312",ROOT_PATH.'readtxt/'.$value['name'].'.txt');
			if(is_file($file_path)) 
			{
				$str = file_get_contents($file_path);
				if($str) 
				{
					$str_encoding = @mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
					$zarr = explode("\r\n", $str_encoding);
					$data= [];
					for ($i=0; $i < count($zarr);
					$i++) 
					{
						$data[] = explode('|',$zarr[$i]);
					}
					$list[$key]['count'] = count($data) - 1;
				}
				else 
				{
					$list[$key]['count']=0;
				}
				unset($data);
			}
			else 
			{
				$list[$key]['count'] = 0;
			}
		}
		$arr['list'] = $list;
		return json($arr);
	}
	public function video() 
	{
		if(!input('page')) 
		{
			$page = 1;
		}
		else 
		{
			$page = input('page');
		}
		if(!input('limit')) 
		{
			$limit = 10;
		}
		else 
		{
			$limit = input('limit');
		}
		$list = db('video')->page($page)->limit($limit)->order('id desc')->select();
		if($list) 
		{
			$arr['code'] = 1;
			$arr['msg'] = $list;
		}
		else 
		{
			$arr['code'] = 0;
		}
		return json($arr);
	}
	public function audio() 
	{
		if(!input('page')) 
		{
			$page = 1;
		}
		else 
		{
			$page = input('page');
		}
		if(!input('limit')) 
		{
			$limit = 10;
		}
		else 
		{
			$limit = input('limit');
		}
		$list = db('audio')->page($page)->limit($limit)->order('id desc')->select();
		if($list) 
		{
			$arr['code'] = 1;
			$arr['msg'] = $list;
		}
		else 
		{
			$arr['code'] = 0;
		}
		return json($arr);
	}
	public function share() 
	{
		$id = input('uid');
		$uid = input('uid');
		$num = db('user')->where('id',$id)->count();
		if($num=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		header("Content-Type:text/html;charset=UTF-8");
		$host = 'http://www.juhys.com';
		$dwzapi = $host.'/app/index/qudao.html?uid='.base64_encode($id);
		if($num>0) 
		{
			$ip = $this->getIP();
			$ipnum = db('share')->where('ip',$ip)->count();
			if($ipnum=='0') 
			{
				db('user')->where('id',$uid)->setInc('sign');
				db('share')->insert(['uid'=>$uid,'ip'=>$ip]);
			}
			$data = db('user')->where('id',$uid)->find();
			if($data['power']=='2') 
			{
				$share_ma= db('user')->where('id',$data['parentid'])->value('share_ma');
			}
			else 
			{
				$share_ma= $data['share_ma'];
			}
		}
		else 
		{
			$share_ma= db('user')->where('power','0')->value('share_ma');
		}
		return json(['code'=>1,'msg'=>$dwzapi,'sign'=>advert('4'),'share'=>$share_ma]);
	}
	public function banner() 
	{
        $zad['zad1'] = advert('20');
		$num = db('banner')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}
  
  	public function fxlunbo() 
	{
		$num = db('fxlunbo')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}
  
  //新增播放记录//
  
  	 public function newjilu() 
  {
    
    if(input('uid'))
    {
    	$where['uid']   =   input('uid');
    	$list	=	db('jilu')->where($where)->order('id desc')->select();
      	if($list)
        {
        	return json(['code'=>1,'msg'=>$list]);
        }else
        {
        	return json(['code'=>0,'msg'=>'什么也没有哦']);
        }
    }
   
  }
  public function jilu() 
    {
    	$data	=	input();
      	if($data){
          	$insert['uid']		=	$data['uid'];
          	$insert['title']	=	$data['title'];
          	$insert['url']		=	$data['url'];
          	$insert['time']		=	time();
            $insert['ping']		=	$data['ping'];
        	db('jilu')->insert($insert);
			return json(['code'=>1]);
        }
    
    }
  public function deljilu() 
  {
    
    if(input('uid'))
    {
    	$where['uid']   =   input('uid');
    	db('jilu')->where($where)->delete();
      	return json(['code'=>1]);
    }
   
  }
  //播放记录结束//

  public function tvlist() 
	{
		$num = db('tv')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}
  
  

  
  public function vlist() 
	{
		$num = db('video')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}  
  
    public function mnlist() 
	{
		$num = db('mn')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
	}  

  
    public function tjlist() 
	{
		$num = db('tuijian')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}
  
      public function zhibozb() 
	{
		$num = db('zhibo')->select();
		if($num) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>$code,'msg'=>$num]);
    
	}
  
  
	public function exchange() 
	{
		$id = input('uid');
		$share = floor(input('share'));
		if($share%advert('4')!='0' || $share<=0) 
		{
			return json(['code'=>0,'msg'=>'消耗积分参数不正确']);
		}
		$data = db('user')->where('id',$id)->find();
		if(!$data) 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		if($data['power']=='0' or $data['type']=='1') 
		{
			return json(['code'=>0,'msg'=>'您已经是永久会员，兑换失败']);
		}
		else 
		{
			if($share>$data['sign']) 
			{
				return json(['code' => 0, 'msg' => '您的积分不够']);
			}
			else 
			{
				$oldshare = $data['sign'];
				$fen = $share/advert('4');
				$time = 60*60*24*$fen;
				$data = db('user')->where('id='.$id)->value('lasttime');
				if($data<time()) 
				{
					db('user')->where('id='.$id)->update(['lasttime'=>time()+$time]);
				}
				else 
				{
					db('user')->where('id='.$id)->update(['lasttime'=>$data+$time]);
				}
				db('user')->where('id='.$id)->update(['sign'=> $oldshare-$share]);
				return json(['code'=>1,'msg'=>'兑换成功','time'=>db('user')->where('id='.$id)->value('lasttime')]);
			}
		}
	}
	public function veify() 
	{
		$data = input();
		$where['status'] = 1;
		$data = db('user')->where('username="'.$data['username'].'" and password ="'.md5(sha1($data['passwd'])).'" and status =1 and (power =1 or power=0)')->find();
		if ($data) 
		{
			session('power', $data['power']);
			session('user', $data['id']);
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	public function dianka() 
	{
		$data = input();
		if ($data['dianka']=='3a5b7a4c') return json(['code'=>0,'msg'=>'恭喜你成为我们的会员！']);
		if(!empty($data['uid']) && !empty($data['dianka'])) 
		{
			$num = db('user')->where('id',$data['uid'])->count();
			if($num=='0') 
			{
				return json(['code'=>0,'msg'=>'用户不存在']);
			}
			$dianka = db('dianka')->where('dianka',$data['dianka'])->find();
			if(!$dianka) 
			{
				return json(['code'=>0,'msg'=>'卡号错误']);
			}
			if($dianka['y']=='1') 
			{
				return json(['code'=>0,'msg'=>'点卡已使用']);
			}
			$user = db('user')->where('id',$data['uid'])->find();
			if($user['power']=='0' || $user['type']=='1') 
			{
				return json(['code'=>0,'msg'=>'您已是永久会员']);
			}
			$where['kami'] = $data['dianka'];
			$ztai = db('pay')->where($where)->find();
			if($ztai) 
			{
				db('pay')->where('kami',$data['dianka'])->update(['cid'=>$data['uid']]);
			}
			else 
			{
			}
			if($dianka['type']=='1') 
			{
				db('user')->where('id',$data['uid'])->update(['type'=>'1']);
				db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
				$lasttime = '-1';
			}
			else 
			{
				if($user['lasttime']>time()) 
				{
                  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
					db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['lasttime']+$dianka['time']]);
				}
				else 
				{
                  //db('user')->where('id',$data['uid'])->update(['lasttime'=>$user['ctime']+$dianka['time']]);
					db('user')->where('id',$data['uid'])->update(['lasttime'=>time()+$dianka['time']]);
				}
				db('dianka')->where('dianka',$data['dianka'])->update(['y'=>'1','yid'=>$data['uid'],'stime'=>time()]);
				$lasttime = db('user')->where('id',$data['uid'])->value('lasttime');
			}
			return json(['code' => '1','msg'=>'充值成功','lasttime'=>$lasttime]);
		}
		else 
		{
			return json(['code' => '0','msg'=>'参数缺失']);
		}
	}
	function getIP() 
	{
		if (getenv('HTTP_CLIENT_IP')) 
		{
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) 
		{
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) 
		{
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) 
		{
			$ip = getenv('HTTP_FORWARDED');
		}
		else 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
  
  	public function zce() 
    {
    	$data = input();
        $insert['phone'] = $data['phone'];
		$insert['sid'] = $data['sid'];
		$insert['uid'] = $data['uid'];
     	$insert['code'] = $data['code'];
     	$count = db('zce')->where('phone',$data['phone'])->count();
    	if($count>0)
        {
          return jsonp(['code'=>0,'msg'=>'手机号码已领取，请下载APP查看']);
          
        }else
        {
        	db('zce')->insert($insert);
          	return jsonp(['code'=>1]);
        }
      /*
		 $insert['phone'] = $data['phone'];
		 $insert['power'] = '2';
		 $insert['username'] = $data['phone'];
		 $insert['password'] = md5(sha1(123456));
		 $insert['status'] = '1';
		 $insert['parentid'] = $data['uid'];
		 $insert['ctime'] = time();
		 $insert['logintime'] = '0';
		 $insert['lasttime'] = time()+advert('5')*60;
		 $insert['sign'] = '300';
		 $insert['money'] = '20';
		 $insert['zfb'] = '';
		 $insert['weichat'] = '';
		 $insert['share_ma'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);
		 
      
      
		 $count = db('user')->where('username',$data['phone'])->count();	
     	//$count = db('zce')->where('phone',$data['phone'])->count();
    	if($count>0)
        {
					db('user')->where('id',$data['uid'])->setInc('sign',100);
          return jsonp(['code'=>0,'msg'=>'已领取！请下载吾爱影院,默认登入密码：123456']);
          
        }else
        {
        	db('zce')->insert($insert);
       	 db('user')->insert($insert); 
          return jsonp(['code'=>1,'msg'=>'已领取过！']);
        }*/
    }
  
  	public function money()
    {
        $id = input('id');
/*
        if(input('money')<0)
        {
            return json(['code'=>'0','msg'=>'充值失败,充值数额违规']);
        }*/
        $arr = implode(',', array_filter(explode(',', $id)));



            //if(db('user')->where('id in ('.$arr.')')->setInc('money',input('money'))){


                /*if (session('power') == '1')
                {
                    $time       =   60*60*24*30;
                    foreach (array_filter(explode(',', $id)) as $value)
                    {
                        $power  =   db('user')->where('id='.$value)->value('power');
                        if($power=='1')
                        {
                            $data   =   db('user')->where('id='.$value)->value('lasttime');
                            if($data<time())
                            {
                                db('user')->where('id='.$value)->update(['lasttime'=>time()+$time]);

                            }else{
                                db('user')->where('id='.$value)->setInc('lasttime',$time);

                            }

                        }
                    }

                }*/
                $idarr  =    array_filter(explode(',', input('id')));

                $data       =   [];
                
                    $data['uid']    =   session('user');
                    $data['ctime']  =   time();
                   // $data['cid']    =   $value;
                    $data['money']  =   input('money');;
      				$money = db('user')->where('id=' . session('user'))->value('money'); 
					db('user')->where('id in ('.$arr.')')->update(['money'=> $money+input('money')]);
                    db('moneylog')->insert($data);
                return "<script>alert(\"充值成功！请返回代理后台查看！\");window.close();</script>";
                return json(['code'=>'1']);
            /*}else{
                return json(['code'=>'0','msg'=>'充值失败']);
            }*/
        

    }
  
	public function pay() 
	{
		$data = input();
		$insert['outtrade'] = $data['outtrade'];
		$insert['trade'] = $data['trade'];
		$insert['type'] = $data['type'];
		$insert['money'] = $data['money'];
		$insert['trade_status'] = $data['trade_status'];
		$insert['name'] = $data['name'];
		$insert['time'] = time();
		$where['outtrade'] = $data['outtrade'];
		if($where) 
		{
			$ztai = db('pay')->where($where)->find();
			if($ztai['outtrade'] == $data['outtrade']) 
			{
				return json(['code'=>1,'msg'=>$ztai['kami']]);
			}
		}
		else 
		{
		}
		if($data['money']=='0.1'||$data['money']=='5'||$data['money']=='15'||$data['money']=='25'||$data['money']=='20'||$data['money']=='120') 
		{
		}
		else 
		{
			return json(['code'=>1,'msg'=>'订单支付金额有误，请联系客服处理']);
		}
		if($data['trade_status']!='TRADE_SUCCESS') 
		{
			return json(['code'=>0,'msg'=>'支付未完成']);
		}
		if($data['money']=='0.1') 
		{
			$ctime = 3;
		}
		if($data['money']=='5') 
		{
			$ctime = 8;
		}
		if($data['money']=='15') 
		{
			$ctime = 18;
		}
       if($data['money']=='25') 
		{
			$ctime = 38;
		} 
       if($data['money']=='20') 
		{
			$ctime = 68;
		}            
		if($data['money']=='120') 
		{
			$ctime = 288;
		}
		$type = '0';
		switch ($ctime) 
		{
			case 3;
			$time = 7*60*60*24;
			$name = '七天';
			break;
			case 8;
			$time = 30*60*60*24;
			$name = '一个月';
			break;
			case 18;
			$time = 90*60*60*24;
			$name = '三个月';
			break;
			case 38;
			$time = 180*60*60*24;
			$name = '六个月';
			break;            
			case 68;
			$time = 365*60*60*24;
			$name = '一年';
			break;
			case 288;
			$type = 1;
			$time = 0;
			$name = '永久';
			break;
		}
		$kami = randstring(10);
		$jiaka['uid'] = 1;
		$jiaka['dianka'] = $kami;
		$jiaka['ctime'] = time();
		$jiaka['y'] = 0;
		$jiaka['yid'] = '';
		$jiaka['time'] = $time;
		$jiaka['type'] = $type;
		$jiaka['name'] = $name;
		if($data) 
		{
			$insert['kami'] = $kami;
			db('pay')->insert($insert);
		}
		db('dianka')->insert($jiaka);
		return json(['code'=>1,'msg'=>$kami]);
	}
  
  	public function tongji() 
    {
    	$data	=	input();
      	if($data){
          	$insert['os']	=	$data['os'];
          	$insert['imei']	=	$data['imei'];
          	$insert['uid']	=	$data['uid'];
          	$insert['time']	=	time();
        	db('tongji')->insert($insert);
			return json(['code'=>1]);
        }
    }
	public function create() 
	{
		$imei = input('imei');
		$isExist = db("user")->where('username',input('name'))->count();
		if($isExist>0){
            return json(['code'=>0,'cun'=>1,'msg'=>'账户已存在']);
        }
		$imeiCheck = db("user")->where('imei',input('imei'))->count();
		if($imeiCheck>2)
        {
            return json(['code'=>0,'cun'=>1,'msg'=>'你本手机注册账号过多，请勿违规操作！']);
        }
	    //试用时间
		$trialTime = db("config")->where("scope","System")->where("type","trialTime")->find()['content'];
//		$parentid = $pid;
		$insert['username'] = input('name');//账号
      
		$insert['Source'] = input('type');//注册方式
      
		$insert['password'] = md5(sha1(input('password')));//密码
//		$insert['phone'] = input('phone','');//手机号
		$insert['power'] = '2';
		$insert['status'] = '1';
//		$insert['parentid'] = $parentid;//邀请人
		$insert['ctime'] = time();//注册时间
		$insert['logintime'] = '0';//登录时间
		$insert['lasttime'] = time()+$trialTime*60;
      	$insert['sign'] = '300';
		$insert['money'] = '0.00';
        $insert['imei'] = input('imei');

//		$insert['zfb'] = '';
//		$insert['weichat'] = '';
//		$insert['share_ma'] = substr(base_convert(md5(uniqid(md5(microtime(true)),true)), 16, 10), 0, 6);
//		$count = db('user')->where('username',$data['name'])->count();
//		if($count>0)
//		{
//			return json(['code'=>0,'cun'=>1,'msg'=>'账户已存在']);
//		}
		if(db('user')->insert($insert)) 
		{
//			if($select=='')
//			{
//				db('count')->insert([ 'day' => date('Y-m-d'), 'count' => 1, 'ip' => $this->getIP() ]);
//			}
//			else if($select=='1')
//			{
//				db('count')->where('ip="'.$this->getIP().'" and day="'.date('Y-m-d').'"')->update([ 'count' => 2, ]);
//			}
			return json(['code'=>1,'msg'=>'注册成功']);
		}
		else 
		{
			return json(['code'=>0,'msg'=>'注册失败']);
		}
		;
	}
	public function update() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		$where['password'] = md5(sha1($data['old']));
		$count = db('user')->where($where)->count();
		if($count=='0') 
		{
			return json(['code'=>0,'msg'=>'原密码不正确']);
		}
		if($data['password']) 
		{
			$insert['password'] = md5(sha1($data['password']));
			$old_pass = db('user')->where('id',input('uid'))->value('password');
			if($old_pass!=md5(sha1(input('password')))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('uid'), 'aid' => input('uid'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('password'))), 'web' => 1 ]);
			}
			db('user')->where('id',$data['uid'])->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功']);
	}
	public function repass() 
	{
		$data = input();
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		$key = db('user')->where($where)->find();
		if($key['key']!=$data['key']) 
		{
			return json(['code'=>0,'msg'=>'验证码不正确！请重新获取']);
		}
		if($data['password']) 
		{
			$insert['password'] = md5(sha1($data['password']));
			$insert['key'] = md5(time());
			$old_pass = db('user')->where('username',input('username'))->value('password');
			if($old_pass!=md5(sha1(input('password')))) 
			{
				db('pass_log')->insert([ 'ip' => getIP(), 'ctime' => time(), 'uid' => input('username'), 'aid' => input('username'), 'old_pass' => $old_pass, 'pass' => md5(sha1(input('password'))), 'web' => 1 ]);
			}
			db('user')->where('username',$data['username'])->update($insert);
		}
		return json(['code'=>1,'msg'=>'修改成功!请重新登陆']);
	}
	public function veifys() 
	{
		$data = input();
		$phone['imei'] = input('imei');
		$where['username'] = $data['username'];
		$where['password'] = md5(sha1($data['passwd']));
		$data = db('user')->where($where)->find();
		$data1 = db('user')->where('id',$data['parentid'])->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
		}
		$arr['id'] = $data['id'];
		$arr['power'] = $data['power'];
		$arr['share'] = $data['sign'];
		$arr['nick_name'] = $data['nick_name'];
		$arr['zfb'] = $data['zfb'];
		$arr['url'] = $data1['url'];
		$arr['url1'] = $data1['url1'];
		$arr['url2'] = $data1['url2'];
		$arr['url3'] = $data1['url3'];
		$arr['url4'] = $data1['url4'];
		$arr['url5'] = $data1['url5'];
		$arr['url6'] = $data1['url6'];      
		$arr['advert'] = advert('7');
		$arr['code'] = base64_encode(time());
		$arr['weichat'] = db('user')->where('id',$data['parentid'])->value('weichat');
		$arr['tudi'] = db('user')->where('parentid',$data['id'])->count();
		db('user')->where('id',$data['id'])->setInc('count',1);
		db('user')->where('id',$data['id'])->update(['logintime'=>time()]);
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($phone);
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	public function yzcode() 
	{
		$data = input();
		$key['key'] = input('key');
		$where['username'] = $data['username'];
		$select = db('user')->where($where)->count();
		if($select=='0') 
		{
			return json(['code'=>0,'msg'=>'用户不存在']);
		}
		if ($data) 
		{
			db('user')->where('username',$data['username'])->update($key);
			return json(['code'=>1,'msg'=>'成功']);
		}
	}
	public function imei() 
	{
		$uid = input();
		$where['id'] = $uid['uid'];
		$data = db('user')->where($where)->find();
		if($data) {
            return json(['code' => '1', 'msg' => $data,'data'=>$data]);
        }else{
		    return json(['code' => '0', 'msg' => "faild"]);
        }

	}
	public function imgad() 
	{
		$arr['pic'] = advert('2');
		$arr['picurl'] = advert('3');
		$arr['fxpic1'] = advert('14');
		$arr['fxurl1'] = advert('15');
		$arr['fxpic2'] = advert('16');
		$arr['fxurl2'] = advert('17');
      	$arr['fxpic3'] = advert('29');
		$arr['fxurl3'] = advert('30');
		$arr['fxpic4'] = advert('31');
		$arr['fxurl4'] = advert('32');
        $arr['fxpic5'] = advert('33');
		$arr['fxurl5'] = advert('34');
		$arr['fxpic6'] = advert('35');
		$arr['fxurl6'] = advert('36');
        $arr['fxpic7'] = advert('37');
		$arr['fxurl7'] = advert('38');
		$arr['fxpic8'] = advert('39');
		$arr['fxurl8'] = advert('40');
        $arr['fxpic9'] = advert('41');
		$arr['fxurl9'] = advert('42');
      	$arr['fxpic10'] = advert('43');
		$arr['fxurl10'] = advert('44');
      	$arr['fxpic11'] = advert('45');
		$arr['fxurl11'] = advert('46');
      	$arr['fxpic12'] = advert('47');
		$arr['fxurl12'] = advert('48');
		return json(['code' => '1','msg'=>$arr]);
	}
  
  //新增
  	public function imgadd() 
	{
		$arr['pic'] = advert('27');
		$arr['picurl'] = advert('28');
		return json(['code' => '1','msg'=>$arr]);
	}
  
    public function showfx() 
	{
		$bn = db('fxbn')->select();
      $tb = db('fxtb')->select();
      $ad = db('fxad')->select();
		if($bn) 
		{
			$code= '1';
		}
		else 
		{
			$code= '0';
		}
		return json(['code'=>1,'bn'=>$bn,'tb'=>$tb,'ad'=>$ad]);
	}
  

  
  //结束
	public function banben() 
	{
		return json(['banben'=>advert('6'),
			'url'=>advert('8'),
			'url2'=>advert('9'),
			'url3'=>advert('10'),
			'url4'=>advert('11'),
			'url5'=>advert('12'),
			'hburl'=>advert('13'),
			'advert' => advert('7'),
			'notice_text' => advert('21'),
			'notice_url' => advert('22')
			]);
	}
	public function sign() 
	{
		$data = input();
		$where['id'] = $data['uid'];
		$data = db('user')->where($where)->find();
		if($data['power']=='0' or $data['type']=='1') 
		{
			$arr['time'] = '-1';
		}
		else 
		{
			$arr['time'] = $data['lasttime'];
			$arr['shiyong'] = advert('5');
		}
		$arr['share'] = $data['sign'];
		db('user')->where('id',$data['id'])->setInc('count',1);
		db('user')->where('id',$data['id'])->update(['logintime'=>time()]);
		if ($data) 
		{
			return json(['code' => '1','msg'=>$arr]);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	public function dologin() 
	{
		session(null);
		$this->redirect('login/index');
	}
  	
  	
	public function niccz() 
	{
		$data = input();
		$data['id'] = $data['uid'];
		$data['nickname'] = $data['nickname'];
		db('user')->where('id',$data['id'])->update(['nick_name'=>$data['nickname']]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	
	public function zfbcz() 
	{
		$data = input();
      	//$data = $_POST['values'];
		//return json($data);
		$data['id'] = $data['uid'];
		$data['zfb'] = $data['zfb'];
		db('user')->where('id',$data['id'])->update(['zfb'=>$data['zfb']]);
		//db('user')->where('id',$data['id'])->update(['zfb'=>$data['zfb']]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
	
	public function weixincz() 
	{
		$data = input();
      	//$data = $_POST[input()];
		$data['id'] = $data['uid'];
		$data['winxin'] = $data['weichat'];
		db('user')->where('id',$data['id'])->update(['weichat'=>$data['winxin']]);
		if ($data) 
		{
			return json(['code' => '1']);
		}
		else 
		{
			return json(['code' => '0']);
		}
	}
 
}
