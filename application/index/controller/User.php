<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class User extends Controller
{
    public function _initialize()
    {
        $id         =   session('user');

        if(!$id)
        {
            $this->redirect('login/login/index');
        }
    }
    public function log()
    {
        $id     =   input('id');
        $list   =   db('moneylog')->where('cid',$id)->order('ctime','desc')->select();
        return view('log',[
            'list'=>$list
        ]);
    }




    public function zlog()
    {

        $where  =   'ctime>0';
        if(input('user'))
        {
            $user   =   db('user')->where('username like "%'.input('user').'%"')->column('id');
            if($user)
            {
                $where .=   ' and uid in ('.implode(',',$user).')';
            }

        }
        if(input('vip'))
        {
            $vip    =   db('user')->where('username like "%'.input('vip').'%"')->column('id');
            if($vip)
            {

                $where .=   ' and cid in ('.implode(',',$vip).')';
            }
        }

        if(input('start'))
        {
            $where          .=  ' and ctime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and ctime <'.strtotime(input('end').' 00:00:00');
        }

        if(input('day'))
        {
            if(input('day')=='终生')
            {
                $where          .=  ' and day ="all"';
            }else{
                $where          .=  ' and day ='.input('day');
            }

        }

        if(input('money'))
        {
            $where          .=  ' and money ='.input('money');
        }


        if(input('dstart'))
        {
            $where          .=  ' and lasttime >'.strtotime(input('dstart').' 00:00:00');
        }

        if(input('dend'))
        {
            $where          .=  ' and lasttime <'.strtotime(input('dend').' 00:00:00');
        }


        $list   =   db('timelog')->where($where)->order('ctime','desc')->paginate(10, false, [
            'query' => input()
        ]);
        return view('zlog',[
            'list'=>$list
        ]);
    }

    public function xlog()
    {
        if(session('power')=='0')
        {

            $where  =   'ctime>0';
        }else{

            $where  =   'uid='.session('user');
        }

        if(input('user'))
        {
            $user   =   db('user')->where('username like "%'.input('user').'%"')->column('id');
            if($user)
            {
                $where .=   ' and uid in ('.implode(',',$user).')';
            }

        }
        if(input('vip'))
        {
            $vip    =   db('user')->where('username like "%'.input('vip').'%"')->column('id');
            if($vip)
            {

                $where .=   ' and cid in ('.implode(',',$vip).')';
            }
        }

        if(input('start'))
        {
            $where          .=  ' and ctime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and ctime <'.strtotime(input('end').' 00:00:00');
        }

        if(input('day'))
        {
            switch (input('day'))
            {
                case 0.5;
                    $where          .=  ' and day ="7"';
                    break;

                case 1;
                    $where          .=  ' and day ="30"';
                    break;

                case 2;
                    $where          .=  ' and day ="90"';
                    break;

                case 8;
                    $where          .=  ' and day ="365"';
                    break;

                case 10;
                    $where          .=  ' and day ="all"';
                    break;
            }
        }

        if(input('money'))
        {
            $where          .=  ' and money ='.input('money');
        }


        if(input('dstart'))
        {
            $where          .=  ' and lasttime >'.strtotime(input('dstart').' 00:00:00');
        }

        if(input('dend'))
        {
            $where          .=  ' and lasttime <'.strtotime(input('dend').' 00:00:00');
        }


        $list   =   db('timelog')->where($where)->order('ctime','desc')->paginate(10, false, [
            'query' => input()
        ]);
        return view('xlog',[
            'list'=>$list
        ]);
    }


    public function mlog()
    {


        $where      =   'uid>0 ';
        if(input('user'))
        {
            $user   =   db('user')->where('username like "%'.input('user').'%"')->column('id');
            if($user)
            {
                $where .=   ' and uid in ('.implode(',',$user).')';
            }

        }
        if(input('vip'))
        {
            $vip    =   db('user')->where('username like "%'.input('vip').'%"')->column('id');
            if($vip)
            {

                $where .=   ' and cid in ('.implode(',',$vip).')';
            }
        }

        if(input('start'))
        {
            $where          .=  ' and ctime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and ctime <'.strtotime(input('end').' 00:00:00');
        }





        $list   =   db('kai')->where($where)->order('ctime','desc')->paginate(10, false, [
            'query' => input()
        ]);
        return view('mlog',[
            'list'=>$list
        ]);
    }
  
  	 public function paylog()
    {


        $where      =   'id>0 ';
       
        if(input('vip'))
        {
            $vip    =   db('user')->where('username like "%'.input('vip').'%"')->column('id');
            if(!empty($vip))
            {
                $where .=   ' and cid in ('.implode(',',$vip).')';
            }
        }

        $list   =   db('pay')->where($where)->order('time','desc')->paginate(10, false, [
            'query' => input()
        ]);
        return view('paylog',[
            'list'=>$list
        ]);
    }
  
  

    public function clog()
    {

        $where  =   'ctime>0';
        if(input('user'))
        {
            $user   =   db('user')->where('username like "%'.input('user').'%"')->column('id');
            if(!empty($user))
            {
                $where .=   ' and uid in ('.implode(',',$user).')';
            }

        }
        if(input('vip'))
        {
            $vip    =   db('user')->where('username like "%'.input('vip').'%"')->column('id');
            if(!empty($vip))
            {
                $where .=   ' and cid in ('.implode(',',$vip).')';
            }
        }

        if(input('start'))
        {
            $where          .=  ' and ctime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and ctime <'.strtotime(input('end').' 00:00:00');
        }
        if(session('power')=='1')
        {
            $where          .=  ' and uid='.session('user');
        }


        $list   =   db('moneylog')->where($where)->order('ctime','desc')->paginate(10, false, [
            'query' => input()
        ]);
        return view('clog',[
            'list'=>$list
        ]);
    }


    public function daoqi()
    {
        $code               =   session('code','');
        $time               =   time(); //当前时间
        $xtime              =   time()-5*60*60*24;



        $list       =   db('user')->where('(power=1 or power=2) and lasttime <'.$time)->order('id desc')->paginate(10, false, [
            'query' => input()
        ]);

        return view('daoqi',[
            'list'  =>  $list,
        ]);
    }
    public function index()
    {

        $code               =   session('code','');


        $where              =   'power = 1';
        if(input('start'))
        {
            $where          .=  ' and lasttime >'.strtotime(input('start').' 00:00:00');
        }

        if(input('end'))
        {
            $where          .=  ' and lasttime <'.strtotime(input('end').' 00:00:00');
        }
        if(input('key'))
        {
            $where          .=  ' and (username like  "%'.input('key').'%" or share_ma like "%'.input('key').'%")';
        }

        if(session('power')=='1')
        {
            $where          .=  ' and parentid = '.session('user');
        }else{
            if(input('parentid'))
            {
                $where          .=  ' and parentid = '.input('parentid');
            }
        }


        $list       =   db('user')->where($where)->order('id desc')->paginate(10, false, [
            'query' => input()
        ]);

        return view('index',[
            'parentid'=>input('parentid'),
            'list'  =>  $list,
            'code'  =>  $code
        ]);
    }

    public function pass()
    {
        if(request()->isPost())
        {
			if(input('password'))
			{
                $old_pass   =   db('user')->where('id',session('user'))->value('password');
                if($old_pass!=md5(sha1(input('password'))))
                {
                    db('pass_log')->insert([
                        'ip'    =>  getIP(),
                        'ctime' =>  time(),
                        'uid'   =>  session('user'),
                        'aid'   =>  session('user'),
                        'old_pass'    =>  $old_pass,
                        'pass'  =>  md5(sha1(input('password'))),
                        'web'   =>  0
                    ]);
                }

				if(db('user')->where('id',session('user'))->update(['password'=>md5(sha1(input('password')))])==false  )
				{
	
					Session::flash('code','2');
					$this->redirect('user/pass');
				}
			}


		
			if(db('user')->where('id',session('user'))->update([
			'weichat'=>input('weichat'),
			'url'=>input('url'),
			'url1'=>input('url1'),
			'url2'=>input('url2'),
			'url3'=>input('url3'),
			'url4'=>input('url4')
				])!==false  )
			{
				Session::flash('code','1');
				$this->redirect('user/pass');
			}else{
				Session::flash('code','2');
				$this->redirect('user/pass');
			}
			
          
        }else{
            $code                    =   session('code');
            return view('user/pass',[
                'code'=>$code,
				'weichat'=>db('user')->where('id',session('user'))->value('weichat')
            ]);
        }
    }



    public function add()
    {
        if(request()->isPost()) {
            $data = input();

            if (session('power') == '1') {
                $money = db('user')->where('id=' . session('user'))->value('money');
                if ($money < 20) {
                    Session::flash('code', 'err3');
                    $this->redirect('user/add');

                } else {
                    $insert['parentid'] = session('user');
                }
            } else {
                $insert['parentid'] = '0';
            }

            $insert['username'] = $data['name'];
            $insert['password'] = md5(sha1($data['password']));
            $insert['power'] = '1';
            $insert['status'] = '1';
            $insert['phone'] = $data['phone'];
            if (session('power') == '1')
            {

                $insert['share_ma']     =  rand('100000','999999');
            }else{
                if(empty($data['share_ma']))
                {
                    $insert['share_ma']     =  rand('100000','999999');
                }else{
                    $insert['share_ma']     =   $data['share_ma'];
                }
            }
            $insert['ctime']        =   time();
            $insert['logintime']    =   '0';
            $insert['lasttime']     =   '0';
            $insert['money']        =   '0.00';
            $sha_count                  =   db('user')->where('share_ma',$insert['share_ma'])->count();
            if($sha_count>0)
            {
                Session::flash('code','err4');
                $this->redirect('user/add');
            }
            $count                  =   db('user')->where('username',$data['name'])->count();
            if($count>0)
            {
                Session::flash('code','err1');
                $this->redirect('user/add');
            }


            unset($data);
            if($id=db('user')->insertGetId($insert))
            {
                if(session('power')=='1')
                {
                    $money              =   db('user')->where('id='.session('user'))->value('money');
                    if($money>=20)
                    {
                        db('user')->where('id', session('user'))->setDec('money','20');
                        $data['uid']    =   session('user');
                        $data['ctime']  =   time();
                        $data['cid']    =   $id;
                        $data['money']  =   '20';

                        db('moneylog')->insert($data);
                    }
                }
                db('user')->where('id='.$id)->update(['money'=>20]);
                db('kai')->insert(['uid'=>session('user'),'cid'=>$id,'ctime'=>time()]);
                Session::flash('code','1');
                $this->redirect('user/index');
            }else{
                Session::flash('code','err2');
                $this->redirect('user/add' );
            };
        }else{
            $code                    =   session('code');
            $msg                     =   input('msg','0');
            return view('add',[
                'code'  =>  $code,
                'msg'   =>  $msg
            ]);
        }
    }


    public function pass_log()
    {
        $id =   input('id');
        $list   =   db('pass_log')->where('uid',$id)->select();
        return view('pass_log',
            [
                'list'=> $list
            ]);
    }
    public function update()
    {
        if(request()->isPost())
        {
            $data                   =   input();
            $page                   =   input('page','');

            $insert['username']     =   $data['name'];
            if($data['password'])
            {
                $insert['password'] =   md5(sha1($data['password']));
                $old_pass   =   db('user')->where('id',session('user'))->value('password');
                if($old_pass!=md5(sha1(input('password'))))
                {
                    db('pass_log')->insert([
                        'ip'    =>  getIP(),
                        'ctime' =>  time(),
                        'uid'   =>  input('id'),
                        'aid'   =>  session('user'),
                        'old_pass'    =>  $old_pass,
                        'pass'  =>  md5(sha1(input('password'))),
                        'web'   =>  0
                    ]);
                }
            }


            $insert['power']        =   $data['power'];
            $insert['phone']        =   $data['phone'];
            $insert['ctime']        =   time();

            $share_ma       =   db('user')->where('id',$data['id'])->value('share_ma');
            if(empty($data['share_ma']) && !$share_ma)
            {
                $insert['share_ma']   =   rand('100000','999999');
            }else{
                if(empty($data['share_ma']))
                {
                    if(!$share_ma)
                    {
                        $insert['share_ma'] =rand('100000','999999');
                    }
                }else{
                    $insert['share_ma']   =   $data['share_ma'];
                }
            }
            $sha_count                  =   db('user')->where('id!='.$data['id'].' and share_ma="'.$data['share_ma'].'"')->count();
            if($sha_count>0)
            {
                Session::flash('code','err4');
                echo "<script>window.location='/index/user/update/id/".$data['id']."'</script>";
                exit();
            }
            $insert['weichat']   =   $data['weichat'];
            $count                  =   db('user')->where('username="'.$data['name'].'" and id!='.$data['id'])->count();
            if($count>0)
            {
                Session::flash('code','err1');
                echo "<script>window.location='/index/user/index/id/".$data['id']."?page=".$page."'</script>";
            }
            if(db('user')->where('id',$data['id'])->update($insert))
            {
                Session::flash('code','2');
                echo "<script>window.location='/index/user/index?page=".$page."'</script>";
            }else{
                Session::flash('code','err2');
                $this->redirect('user/update', ['id'=>$data['id']]);
            };
        }else{
            $code   =   session('code');
            $msg    =   input('msg','0');

            $data   =   db('user')->where('id',input('id'))->find();

            return view('update',[
                'page'  =>  input('page','0'),
                'data'  =>  $data,
                'code'  =>  $code,
                'msg'   =>  $msg
            ]);
        }
    }

    public function delete()
    {
        $id     =   input('id');
        $arr    =   implode(',',array_filter(explode(',',$id)));
        if(db('user')->where('id in ('.$arr.')')->delete())
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0']);
        }
    }


    public function status()
    {
        $id     =   input('id');

        $arr    =   implode(',',array_filter(explode(',',$id)));

        if(db('user')->where('id in ('.$arr.')')->update(['status'=>input('status')]))
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0']);
        }
    }

    public function ctime()
    {
        $last   =   input('day')*60*60*24;

        $data   =   time()-$last;

        $list   =   db('user')->where('power='.input('type').' and lasttime>'.$data)->column('id');


        $id     =   implode(',',$list);

        db('user')->where('id in ('.$id.')')->setInc('lasttime',$last);

        return json(1);

    }
    public function money()
    {
        $id = input('id');

        if(input('money')<0)
        {
            return json(['code'=>'0','msg'=>'充值失败,充值数额违规']);
        }
        $arr = implode(',', array_filter(explode(',', $id)));

        if ($id == 'all') {

            if (db('user')->where('id>0 and power=' . input('type'))->setInc('money', input('money'))) {
                return json(['code' => '1']);
            } else {
                return json(['code' => '0']);
            }

        }else{
            if (session('power') == '1')
            {
                $money = db('user')->where('id=' . session('user'))->value('money');
                if($money<input('money')*count(array_filter(explode(',', $id))))
                {
                    return json(['code'=>'0','msg'=>'余额不足，请联系管理员充值']);
                }
            }


            if(db('user')->where('id in ('.$arr.')')->setInc('money',input('money')))
            {
                if (session('power') == '1')
                {
                    $money = db('user')->where('id=' . session('user'))->setDec('money',input('money')*count(array_filter(explode(',', $id))));
                    db('user')->where('id in ('.$arr.')')->update(['parentid'=> session('user')]);

                }


                if (session('power') == '0')
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

                }
                $idarr  =    array_filter(explode(',', input('id')));

                $data       =   [];
                foreach ($idarr as $key=>$value)
                {
                    $data['uid']    =   session('user');
                    $data['ctime']  =   time();
                    $data['cid']    =   $value;
                    $data['money']  =   input('money');

                    db('moneylog')->insert($data);
                }
                return json(['code'=>'1']);
            }else{
                return json(['code'=>'0','msg'=>'充值失败']);
            }
        }

    }



    public function omoney()
    {
        $id = input('id');

        $arr = implode(',', array_filter(explode(',', $id)));
        $data   =   db('user')->where('id',$arr)->value('money');

        if($data<input('money'))
        {
            return json(['code'=>'0','msg'=>'扣款失败,扣款数额大于用户余额']);
        }
        if(db('user')->where('id in ('.$arr.')')->setDec('money',input('money')))
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0','msg'=>'扣款失败']);
        }


    }



    public function chong()
    {
        $id     =   input('id');

        $arr    =   implode(',',array_filter(explode('-',$id)));
        $money  =   input('money');
        $ctime  =   input('ctime');



        if($money)
        {
            $zmoney =   $money;
        }else{
            $zmoney =   $ctime;
        }

        if(session('power')=='1')
        {
            $data   =   db('user')->where('id',session('user'))->value('money');
            if($data<$zmoney)
            {

                return json(['code'=>'0','msg'=>'开通失败,您的余额不足']);
            }
        }

        if($money)
        {
            $type   =   '0';
            $time   =   $money/0.5*7*24*60*60;
        }else{
            $type   =   '0';
            switch ($ctime)
            {
                case 0.5;
                    $time  =   7*60*60*24;
                    break;
                case 1;
                    $time  =   30*60*60*24;
                    break;
                case 2;
                    $time  =   90*60*60*24;
                    break;
                case 8;
                    $time  =   365*60*60*24;
                    break;
                case 10;
                    $type   =   1;
                    break;
            }
        }
        if($type=='1')
        {
            db('user')->where('id in ('.$arr.')')->update(['type'=>'1']);
            $shengmoney     =   db('user')->where('id',$arr)->value('money');
            if(session('power')=='1')
            {
                $shengmoney     =   db('user')->where('id',session('user'))->value('money');
                $xiumoney       =   $shengmoney-$zmoney;
                db('user')->where('id='.session('user'))->update(['money'=>$xiumoney]);
                db('user')->where('id in ('.$arr.')')->update(['parentid'=> session('user')]);

            }else{

                $xiumoney       =   $shengmoney-10;
                db('user')->where('id='.$arr)->update(['money'=>$xiumoney]);
            }

            $insert['uid']      =   session('user');
            $insert['cid']      =   $id;
            $insert['ctime']    =   time();
            $insert['day']      =   'all';
            $insert['money']    =   $zmoney;
            $insert['lasttime'] =   'all';

            db('timelog')->insert($insert);
        }else{
            $list   =   array_filter(explode('-',$id));
            foreach ($list as $value)
            {
                $data   =   db('user')->where('id='.$value)->value('lasttime');
                if($data<time())
                {
                    db('user')->where('id='.$value)->update(['lasttime'=>time()+$time]);
                    $lasttime   =   time()+$time;
                }else{
                    db('user')->where('id='.$value)->setInc('lasttime',$time);
                    $ltime      =    db('user')->where('id='.$value)->value('lasttime');

                    $lasttime   =   $ltime+$time;
                }

                $shengmoney     =   db('user')->where('id',session('user'))->value('money');
                $xiumoney       =   $shengmoney-$zmoney;

                if(session('power')=='1')
                {
                    db('user')->where('id='.session('user'))->update(['money'=>$xiumoney]);
                    db('user')->where('id in ('.$arr.')')->update(['parentid'=> session('user')]);
                }

                $time               =   $this->timediff($time);
                $insert['uid']      =   session('user');
                $insert['cid']      =   $id;
                $insert['ctime']    =   time();
                $insert['day']      =   $time['day'];
                $insert['money']    =   $zmoney;
                $insert['lasttime'] =   $lasttime;

                db('timelog')->insert($insert);
            }
        }
        return json(['code'=>'1']);



    }

    function timediff($timediff)
    {

        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        return $res;
    }
}
