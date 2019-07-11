<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Dianka extends Controller
{

    public function _initialize()
    {
        $id = session('user');

        if (!$id) {
            $this->redirect('login/login/index');
        }
    }

    public function index()
    {

        $dian = input('dian');
        if (empty($dian)) {
            $dian = [];
        }
        return view('index', [
            'dian' => $dian
        ]);


    }

    public function ylog()
    {
        if (session('power') == '0') {
            $where['y'] = '0';
        } else {
            $where['uid'] = session('user');
            $where['y'] = '0';
        }
        if (input('user')) {
            $user = input('user');
            $where['dianka'] = ['like', "%$user%"];
        }

        if (input('start') && input('end')) {

            $where['ctime'] = ['between', strtotime(input('start') . ' 00:00:00') . ',' . strtotime(input('end') . ' 00:00:00')];
        } else {


            if (input('start')) {
                $where['ctime'] = ['>', strtotime(input('start') . ' 00:00:00')];
            }

            if (input('end')) {
                $where['ctime'] = ['<', strtotime(input('end') . ' 00:00:00')];
            }
        }


        if (input('day')) {
            $where['name'] = input('day');
        }

        $list = db('dianka')->where($where)->order("ctime desc")->paginate(20);
        return view('ylog', [
            'start' => input('start'),
            'day' => input('day'),
            'end' => input('end'),
            'user' => input('user'),
            'list' => $list
        ]);


    }
    public function card(){
        return view("cardlist");
    }

    public function ylog_json()
    {
        if (session('power') == '0') {
            $where['y'] = '0';
        } else {
            $where['uid'] = session('user');
            $where['y'] = '0';
        }
        if (input('user')) {
            $user = input('user');
            $where['dianka'] = ['like', "%$user%"];
        }

        if (input('start') && input('end')) {

            $where['ctime'] = ['between', strtotime(input('start') . ' 00:00:00') . ',' . strtotime(input('end') . ' 00:00:00')];
        } else {


            if (input('start')) {
                $where['ctime'] = ['>', strtotime(input('start') . ' 00:00:00')];
            }

            if (input('end')) {
                $where['ctime'] = ['<', strtotime(input('end') . ' 00:00:00')];
            }
        }


        if (input('day')) {
            $where['name'] = input('day');
        }

        $list = db('dianka')->where($where)->select();
        return json($list);


    }



    public function slog()
    {

        if (session('power') == '0') {
            $where['y'] = '1';
        } else {
            $where['uid'] = session('user');
            $where['y'] = '1';
        }
        if (input('user')) {
            $user = input('user');
            $where['dianka'] = ['like', "%$user%"];
        }
        //增加根据使用人手机号查询
        $whereor = null;
        if (input('user')){
            $whereor['username'] = ['like', "%$user%"];
        }
//        $list = db('dianka')->where($where)->order("stime desc")->paginate(20);//原始的 只查卡号
        $list = db('dianka')->alias('a')->join('user b','a.yid = b.id')->field('a.*,	b.username')->where($where)->whereOr($whereor)->order("stime desc")->paginate(20);

        return view('slog', [
            'list' => $list
        ]);


    }

    public function dangesheng()
    {
        if (input('fen') && input('ctime')) {
            $fen = input('fen');
            $ctime = input('ctime');
            $money = db('user')->where('id', session('user'))->value('money');
            if ($money < $fen * $ctime && session('power') != '0') {
                $arr = ['code' => 0, 'dian' => '余额不足'];
                return json($arr);
            }
            $type = '0';
            switch ($ctime) {
                case 1;
                    $time = 7 * 60 * 60 * 24;
                    $name = '体验';
                    break;
                case 3;
                    $time = 30 * 60 * 60 * 24;
                    $name = '月卡';
                    break;
                case 7;
                    $time = 90 * 60 * 60 * 24;
                    $name = '季卡';
                    break;
                case 12;
                    $time = 180 * 60 * 60 * 24;
                    $name = '半年卡';
                    break;
                case 20;
                    $time = 365 * 60 * 60 * 24;
                    $name = '年卡';
                    break;
                case 60;
                    $type = 1;
                    $time = 0;
                    $name = '永久';
                    break;
            }

            $dian = '';
            for ($i = 0; $i < $fen; $i++) {
                $data = randstring(20);
                $insert['uid'] = session('user');
                $insert['dianka'] = $data;
                $insert['ctime'] = time();
                $insert['y'] = 0;
                $insert['yid'] = '';
                $insert['time'] = $time;
                $insert['type'] = $type;
                $insert['name'] = $name;
                $insert['comment'] = input('comment');
                db('dianka')->insert($insert);
                $dian .= $data . "<br><hr>";
            }
            db('user')->where('id', session('user'))->update(['money' => $money - $fen * $ctime]);
            return json(['code' => 1, 'dian' => $dian]);
        }else{
            return json(['code' => 0, 'dian' => '参数错误']);
        }

    }

    public function sheng()
    {
        if (input('fen') && input('ctime')) {
            $fen = ceil(input('fen'));
            $ctime = input('ctime');
            $type = '0';
            switch ($ctime) {
                case 1;
                    $time = 7 * 60 * 60 * 24;
                    $name = '体验';
                    break;
                case 3;
                    $time = 30 * 60 * 60 * 24;
                    $name = '月卡';
                    break;
                case 7;
                    $time = 90 * 60 * 60 * 24;
                    $name = '季卡';
                    break;
                case 12;
                    $time = 180 * 60 * 60 * 24;
                    $name = '半年卡';
                    break;
                case 20;
                    $time = 365 * 60 * 60 * 24;
                    $name = '年卡';
                    break;
                case 60;
                    $type = 1;
                    $time = 0;
                    $name = '永久';
                    break;
            }
            $dian = '';
            if (session('power') == '0') {
                for ($i = 0; $i < $fen; $i++) {

                    $data = randstring(20);//随机一个激活码
                    $insert['uid'] = session('user');
                    $insert['dianka'] = $data;
                    $insert['ctime'] = time();
                    $insert['y'] = 0;
                    $insert['yid'] = '';
                    $insert['time'] = $time;
                    $insert['type'] = $type;
                    $insert['name'] = $name;
                    $insert['comment'] = input('comment');
                    db('dianka')->insert($insert);
                    $dian .= $data . "<br><hr>";
                }
            } else {
                $money = db('user')->where('id', session('user'))->value('money');
                if ($money < $fen * $ctime) {
                    $arr = ['code' => 0, 'dian' => '余额不足'];
                    return json($arr);
                }

                $dian = '';
                for ($i = 0; $i < $fen; $i++) {
                    $data = randstring(20);
                    $insert['uid'] = session('user');
                    $insert['dianka'] = $data;
                    $insert['ctime'] = time();
                    $insert['y'] = 0;
                    $insert['yid'] = '';
                    $insert['time'] = $time;
                    $insert['type'] = $type;
                    $insert['name'] = $name;
                    $insert['comment'] = input('comment');
                    db('dianka')->insert($insert);
                    $dian .= $data . "<br><hr>";
                }
                db('user')->where('id', session('user'))->update(['money' => $money - $fen * $ctime]);
            }
        } else {
            $dian = '';
        }
        if (empty($code)) {
            $arr = ['code' => 1, 'dian' => $dian];
        } else {
            $arr = ['code' => 0, 'dian' => $dian];
        }
        return json($arr);
    }


}
