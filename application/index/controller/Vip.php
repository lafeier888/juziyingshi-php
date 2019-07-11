<?php

namespace app\index\controller;

use think\Controller;
use think\Session;

class Vip extends Controller
{

    public function _initialize()
    {
        $id = session('user');

        if (!$id) {
            $this->redirect('login/login/index');
        }
    }



    public function advert()
    {

        if (request()->Post()) {
            db('advert')->where('id', 1)->update(['content' => input('advert')]);
            db('advert')->where('id', 7)->update(['content' => input('advert1')]);
            db('advert')->where('id', 2)->update(['content' => input('down')]);
            db('advert')->where('id', 3)->update(['content' => input('pass')]);
            db('advert')->where('id', 4)->update(['content' => input('sign')]);
            db('advert')->where('id', 5)->update(['content' => intval(input('time'))]);
            db('advert')->where('id', 6)->update(['content' => input('ban')]);
            db('advert')->where('id', 8)->update(['content' => input('geng')]);
            db('advert')->where('id', 9)->update(['content' => input('geng2')]);
            db('advert')->where('id', 10)->update(['content' => input('geng3')]);
            db('advert')->where('id', 11)->update(['content' => input('geng4')]);
            db('advert')->where('id', 12)->update(['content' => input('geng5')]);
            db('advert')->where('id', 13)->update(['content' => input('hburl')]);
            db('advert')->where('id', 14)->update(['content' => input('fxpic1')]);
            db('advert')->where('id', 15)->update(['content' => input('fxurl1')]);
            db('advert')->where('id', 16)->update(['content' => input('fxpic2')]);
            db('advert')->where('id', 17)->update(['content' => input('fxurl2')]);

            db('advert')->where('id', 20)->update(['content' => input('le')]);
            db('advert')->where('id', 21)->update(['content' => input('iqiyi')]);
            db('advert')->where('id', 22)->update(['content' => input('txv')]);
            db('advert')->where('id', 23)->update(['content' => input('pptv')]);
            db('advert')->where('id', 24)->update(['content' => input('mgtv')]);
            db('advert')->where('id', 25)->update(['content' => input('mvip')]);
            db('advert')->where('id', 26)->update(['content' => input('sohu')]);
            db('advert')->where('id', 27)->update(['content' => input('migu')]);
            db('advert')->where('id', 28)->update(['content' => input('youku')]);
            db('advert')->where('id', 29)->update(['content' => input('huasu')]);
            db('advert')->where('id', 30)->update(['content' => input('li')]);
            db('advert')->where('id', 31)->update(['content' => input('meipai')]);
            Session::flash('code', '1');
            $this->redirect('vip/advert');
        }
        $code = session('code');
//        return json();
        return view('advert', [
            'code' => $code]);
    }


    function getRandomString($len, $chars = null)
    {
        srand((double)microtime() * 1000000);//create a random number feed.
        $ychar = "0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
        $list = explode(",", $ychar);
        $authnum = '';
        for ($i = 0; $i < 6; $i++) {
            $randnum = rand(0, 35); // 10+26;
            $authnum .= $list[$randnum];
        }
        return $authnum;

    }

    public function padd()
    {

        $num = input('num');
        $ctime = input('ctime');

        if (session('power') == '1') {
            $data = db('user')->where('id', session('user'))->value('money');
            if ($data < $ctime * $num) {

                return json(['code' => '0', 'msg' => '开通失败,您的余额不足']);
            }
        }
        $type = '0';
        $time = '0';
        switch ($ctime) {
            case 0.5;
                $time = 7 * 60 * 60 * 24;
                $day = '七天';
                break;
            case 1;
                $time = 30 * 60 * 60 * 24;
                $day = '一个月';
                break;
            case 2;
                $time = 90 * 60 * 60 * 24;
                $day = '三个月';
                break;
            case 8;
                $time = 365 * 60 * 60 * 24;
                $day = '一年';
                break;
            case 10;
                $type = 1;
                $day = '永久';
                break;
        }


        $user = [];
        for ($i = 0; $i < $num; $i++) {
            unset($data);
            $username = strtolower($this->getRandomString(6));


            $count = db('user')->where('username', $username)->count();
            if ($count == 0) {
                $user[$i]['username'] = $username;
                $user[$i]['day'] = $day;
                $user[$i]['lasttime'] = date('Y-m-d H:i:s', time() + $time);
                $data['username'] = $username;
                $data['password'] = md5(sha1('123456'));
                $data['power'] = '2';
                $data['status'] = '1';
                $data['parentid'] = session('user');
                $data['ctime'] = time();
                if ($type == '0') {
                    $data['lasttime'] = time() + $time;
                } else {
                    $data['type'] = '1';
                }

                $id = db('user')->insertGetId($data);
                if (session('power') == '1') {
                    $shengmoney = db('user')->where('id', session('user'))->value('money');
                    $xiumoney = $shengmoney - $ctime;
                    db('user')->where('id=' . session('user'))->update(['money' => $xiumoney]);
                    $insert['cid'] = $id;
                    $insert['uid'] = session('user');
                    $insert['time'] = $day;
                    $insert['lasttime'] = time() + $time;
                    $insert['ctime'] = time();
                    db('adduser')->insert($insert);
                }

            } else {
                $i = $i - 1;
            }
            unset($username);

        }
        $zi = '<table style="margin-left: 50px"><tr style="color: #00aa00 "><td style="width:80px ">账号</td><td style="width:80px ">密码</td><td style="width:80px ">开通时间</td><td style="width:200px ">到期时间</td></tr>';

        foreach ($user as $value) {
            $zi .= '<tr>';
            $zi .= '<td>' . $value['username'] . '</td><td>123456</td><td>' . $value['day'] . '</td><td>' . $value['lasttime'] . '</td>';
            $zi .= '</tr>';
        }
        $zi .= '</table>';
        return json(['code' => '1', 'msg' => $zi]);
    }


    public function index()
    {
        $code = session('code', '');


        $where = 'power = 2';


        if (input('start')) {
            $where .= ' and lasttime >' . strtotime(input('start') . ' 00:00:00');
        }

        if (input('end')) {
            $where .= ' and lasttime <' . strtotime(input('end') . ' 00:00:00');
        }
        if (input('key')) {
            $where .= ' and (username like  "%' . input('key') . '%" or nick_name like "%' . input('key') . '%")';
        } else {
            if (session('power') == '1') {
                $where .= ' and parentid=' . session('user');
            }
        }

        $count = 'power=2';
        if (session('power') == '1') {
            $count .= ' and parentid=' . session('user');
        } else {
            if (input('parentid')) {
                $where .= ' and parentid = ' . input('parentid');
            }
        }


        $count = db('user')->where($count)->count();


        if (session('power') == '1') {
            $where .= ' and parentid = ' . session('user');
        }

        $list = db('user')->where($where)->order('id desc')->paginate(10, false, [
            'query' => input()
        ]);

        return view('index', [
            'parentid' => input('parentid'),
            'count' => $count,
            'list' => $list,
            'code' => $code
        ]);
    }

    function timediff($timediff)
    {

        $days = intval($timediff / 86400);
        //计算小时数
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);
        //计算分钟数
        $remain = $remain % 3600;
        $mins = intval($remain / 60);
        //计算秒数
        $secs = $remain % 60;
        $res = array("day" => $days, "hour" => $hours, "min" => $mins, "sec" => $secs);
        return $res;
    }


    public function add()
    {
        if (request()->isPost()) {


            $money = input('money');
            $ctime = input('ctime');
            if ($money) {
                $zmoney = $money;
            } else {
                $zmoney = $ctime;
            }
            if (session('power') == '1') {
                $data = db('user')->where('id', session('user'))->value('money');
                if ($data < $zmoney) {

                    Session::flash('code', 'err3');
                    $this->redirect('vip/add');
                }
            }


            if ($money) {
                $type = '0';
                $time = $money / 0.5 * 7 * 24 * 60 * 60;
            } else {
                $type = '0';
                switch ($ctime) {
                    case 0.5;
                        $time = 7 * 60 * 60 * 24;
                        break;
                    case 1;
                        $time = 30 * 60 * 60 * 24;
                        break;
                    case 2;
                        $time = 90 * 60 * 60 * 24;
                        break;
                    case 8;
                        $time = 365 * 60 * 60 * 24;
                        break;
                    case 10;
                        $type = 1;
                        break;
                }
            }
            $data = input();

            $insert['username'] = $data['name'];
            $insert['password'] = md5(sha1($data['password']));
            $insert['power'] = '2';
            $insert['status'] = '1';

            $insert['ctime'] = time();
            $insert['logintime'] = '0';
            $insert['lasttime'] = '0';
            $insert['money'] = '0.00';
            if (session('power') == '1') {
                $insert['parentid'] = session('user');
            } else {
                $insert['parentid'] = '0';
            }

            $count = db('user')->where('username', $data['name'])->count();
            if ($count > 0) {
                Session::flash('code', 'err1');
                $this->redirect('vip/add');
            }


            if ($id = db('user')->insertGetId($insert)) {

                unset($insert);
                if ($type == '1') {
                    db('user')->where('id =' . $id)->update(['type' => '1']);
                    $shengmoney = db('user')->where('id', $id)->value('money');
                    $xiumoney = $shengmoney - 10;
                    db('user')->where('id=' . $id)->update(['money' => $xiumoney]);
                    $insert['uid'] = session('user');
                    $insert['cid'] = $id;
                    $insert['ctime'] = time();
                    $insert['day'] = 'all';
                    $insert['money'] = $zmoney;
                    $insert['lasttime'] = 'all';

                    db('timelog')->insert($insert);
                } else {

                    $data = db('user')->where('id=' . $id)->value('lasttime');
                    if ($data < time()) {
                        db('user')->where('id=' . $id)->update(['lasttime' => time() + $time]);
                        $lasttime = time() + $time;
                    } else {
                        db('user')->where('id=' . $id)->setInc('lasttime', $time);
                        $ltime = db('user')->where('id=' . $id)->value('lasttime');

                        $lasttime = $ltime + $time;
                    }

                    $shengmoney = db('user')->where('id', session('user'))->value('money');
                    $xiumoney = $shengmoney - $zmoney;

                    if (session('power') == '1') {
                        db('user')->where('id=' . session('user'))->update(['money' => $xiumoney]);
                        db('user')->where('id=' . $id)->update(['parentid' => session('user')]);
                    }

                    $time = $this->timediff($time);
                    $insert['uid'] = session('user');
                    $insert['cid'] = $id;
                    $insert['ctime'] = time();
                    $insert['day'] = $time['day'];
                    $insert['money'] = $zmoney;
                    $insert['lasttime'] = $lasttime;

                    db('timelog')->insert($insert);

                }


                Session::flash('code', '1');
                $this->redirect('vip/index');
            } else {
                Session::flash('code', 'err2');
                $this->redirect('vip/add');
            };


        } else {
            $code = session('code');
            $msg = input('msg', '0');
            return view('add', [
                'code' => $code,
                'msg' => $msg
            ]);
        }
    }


    public function update()
    {
        header("Content-type: text/html; charset=utf-8");
        if (request()->isPost()) {
            $data = input();

            $id = $data['id'];
            $page = input('page', '');


            if ($data['password']) {
                $insert['password'] = md5(sha1($data['password']));
                $old_pass = db('user')->where('id', session('user'))->value('password');
                if ($old_pass != md5(sha1(input('password')))) {
                    db('pass_log')->insert([
                        'ip' => getIP(),
                        'ctime' => time(),
                        'uid' => $id,
                        'aid' => session('user'),
                        'old_pass' => $old_pass,
                        'pass' => md5(sha1(input('password'))),
                        'web' => 0
                    ]);
                }
            }

            if ($data['phone']) {
                $insert['phone'] = $data['phone'];
            }


            if (session('power') == '1' && $data['power'] == '1') {
                $money = db('user')->where('id=' . session('user'))->value('money');
                if ($money < 20) {
                    Session::flash('code', 'err3');
                    $this->redirect('vip/update', ['id' => $data['id']]);

                } else {
                    $insert['parentid'] = session('user');
                    $insert['power'] = 1;

                }
            }
            if (session('power') == '0' && $data['power'] == '1') {

                $insert['parentid'] = session('user');
                $insert['power'] = 1;


            }

            if ($data['power'] == '1') {
                if (empty($data['share_ma'])) {
                    $insert['share_ma'] = rand('100000', '999999');
                } else {
                    $insert['share_ma'] = $data['share_ma'];
                }
                $insert['weichat'] = $data['weichat'];

                $sha_count = db('user')->where('id!=' . $data['id'] . ' and share_ma="' . $insert['share_ma'] . '"')->count();

                if ($sha_count > 0) {
                    Session::flash('code', 'err4');
                    echo "<script>window.location='/index/vip/update/id/" . $data['id'] . "'</script>";
                    exit();
                }
            }

            $insert['ctime'] = time();


            $count = db('user')->where('username="' . $data['name'] . '" and id != ' . $data['id'])->count();
            if ($count > 0) {

                Session::flash('code', 'err1');
                echo "<script>window.location='/index/vip/update/id/" . $data['id'] . "?page=" . $page . "'</script>";
            }

            if (db('user')->where('id', $id)->update($insert)) {
                if ($data['power'] == '1') {
                    $money = db('user')->where('id=' . session('user'))->value('money');
                    if ($money >= 20) {
                        db('user')->where('id', session('user'))->setDec('money', '20');
                        unset($data);
                        $data['uid'] = session('user');
                        $data['ctime'] = time();
                        $data['cid'] = $id;
                        $data['money'] = 20;

                        db('moneylog')->insert($data);
                    }
                }
                db('user')->where('id=' . $id)->update(['money' => 20]);
                db('kai')->insert(['uid' => session('user'), 'cid' => $id, 'ctime' => time()]);
                Session::flash('code', '2');
                echo "<script>window.location='/index/vip/index?page=" . $page . "'</script>";
            } else {
                Session::flash('code', 'err2');
                $this->redirect('vip/update', ['id' => $id]);
            };
        } else {
            $code = session('code');
            $msg = input('msg', '0');

            $data = db('user')->where('id', input('id'))->find();

            return view('update', [
                'page' => input('page', '0'),
                'data' => $data,
                'code' => $code,
                'msg' => $msg
            ]);
        }
    }

}
