<?php

namespace app\index\controller;

use think\Controller;
use think\Session;

class Admin extends Controller
{
    public function _initialize()
    {
        $id = session('user');
        if (session('power') != 0) {
            $this->redirect('login/login/index');
        }
        if (!$id) {
            $this->redirect('login/login/index');
        }
    }

    public function index()
    {
        $code = session('code', '');

        $where = 'power = 0';


        $list = db('user')->where($where)->order('id desc')->paginate(10);

        return view('index', [

            'list' => $list,
            'code' => $code
        ]);
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input();

            $insert['username'] = $data['name'];
            $insert['password'] = md5(sha1($data['password']));
            $insert['power'] = '0';
            $insert['status'] = '1';
            $insert['parentid'] = '0';
            $insert['ctime'] = time();
            $insert['logintime'] = '0';
            $insert['lasttime'] = '0';
            $insert['money'] = '0.00';

            $count = db('user')->where('username', $data['name'])->count();
            if ($count > 0) {
                Session::flash('code', 'err1');
                $this->redirect('admin/add');
            }


            if (db('user')->insert($insert)) {
                Session::flash('code', '1');
                $this->redirect('admin/index');
            } else {
                Session::flash('code', 'err2');
                $this->redirect('admin/add');
            };
        } else {
            $code = session('user');
            $msg = input('msg', '0');
            return view('add', [
                'code' => $code,
                'msg' => $msg
            ]);
        }
    }


    public function update()
    {
        if (request()->isPost()) {
            $data = input();
            $page = input('page', '');

            $insert['username'] = $data['name'];
            if ($data['password']) {
                $insert['password'] = md5(sha1($data['password']));
                $old_pass = db('user')->where('id', session('user'))->value('password');
                if ($old_pass != md5(sha1(input('password')))) {
                    db('pass_log')->insert([
                        'ip' => getIP(),
                        'ctime' => time(),
                        'uid' => input('id'),
                        'aid' => session('user'),
                        'old_pass' => $old_pass,
                        'pass' => md5(sha1(input('password'))),
                        'web' => 0
                    ]);
                }
            }

            $insert['ctime'] = time();

            $count = db('user')->where('username="' . $data['name'] . '" and id!=' . $data['id'])->count();
            if ($count > 0) {
                Session::flash('code', 'err1');
                echo "<script>window.location='/index/admin/index/id/" . $data['id'] . "?page=" . $page . "'</script>";
            }


            if (db('user')->where('id', $data['id'])->update($insert)) {
                Session::flash('code', '2');
                echo "<script>window.location='/index/admin/index?page=" . $page . "'</script>";
            } else {
                Session::flash('code', 'err2');
                $this->redirect('admin/update', ['id' => $data['id']]);
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

    public function delete()
    {
        $id = input('id');
        $arr = implode(',', array_filter(explode(',', $id)));
        if (db('user')->where('id in (' . $arr . ')')->delete()) {
            return json(['code' => '1']);
        } else {
            return json(['code' => '0']);
        }
    }

    //app设置
    public function appconfig()
    {
        $code = 0;
        if (request()->isGet()) {
            //查询数据
            $data = db('config')->where('scope', '=', 'APP')->column('id,title,content', 'type');
            return view(
                'admin/appconfig',
                [
                    'code' => 1,
                    'data' => $data
                ]
            );
        } else {
            //修改数据
//            return json(input());
            db('config')->where('type', '=', 'weichat')->update(['content' => input('weichat')]);
            db('config')->where('type', '=', 'day_7')->update(['content' => input('day_7')]);
            db('config')->where('type', '=', 'day_30')->update(['content' => input('day_30')]);
            db('config')->where('type', '=', 'month_1')->update(['content' => input('month_1')]);
            db('config')->where('type', '=', 'month_3')->update(['content' => input('month_3')]);
            db('config')->where('type', '=', 'month_6')->update(['content' => input('month_6')]);
            db('config')->where('type', '=', 'year_1')->update(['content' => input('year_1')]);
            db('config')->where('type', '=', 'year_all')->update(['content' => input('year_all')]);
            return view(
                'user/appconfig',
                [
                    'code' => 1,
                    'data' => db('config')->where('scope', '=', 'APP')->column('id,title,content', 'type')
                ]
            );

        }
    }

    public function sysconfig()
    {
        //查询系统配置
        if (request()->isGet()) {
            return view(
                'admin/sysconfig',
                [
                    'code' => 1,
                    'data' => db('config')->where('scope', 'System')->column('id,title,content', 'type')
                ]
            );
        } else {
        //修改系统配置
            db('config')->where('type', '=', 'app_name')->update(['content' => input('app_name')]);
            db('config')->where('type', '=', 'app_index_ad')->update(['content' => input('app_index_ad')]);
            db('config')->where('type', '=', 'proxy_ad')->update(['content' => input('proxy_ad')]);
            db('config')->where('type', '=', 'scoreExchange')->update(['content' => input('scoreExchange')]);
            db('config')->where('type', '=', 'trialTime')->update(['content' => input('trialTime')]);
            db('config')->where('type', '=', 'resolveInterface_1')->update(['content' => input('resolveInterface_1')]);
            db('config')->where('type', '=', 'resolveInterface_2')->update(['content' => input('resolveInterface_2')]);
            db('config')->where('type', '=', 'resolveInterface_3')->update(['content' => input('resolveInterface_3')]);
            db('config')->where('type', '=', 'resolveInterface_4')->update(['content' => input('resolveInterface_4')]);
            db('config')->where('type', '=', 'resolveInterface_5')->update(['content' => input('resolveInterface_5')]);
            db('config')->where('type', '=', 'resolveInterface_6')->update(['content' => input('resolveInterface_6')]);
            db('config')->where('type', '=', 'resolveInterface_7')->update(['content' => input('resolveInterface_7')]);
            db('config')->where('type', '=', 'resolveInterface_8')->update(['content' => input('resolveInterface_8')]);
            db('config')->where('type', '=', 'resolveInterface_9')->update(['content' => input('resolveInterface_9')]);
            return view(
                'admin/sysconfig',
                [
                    'code' => 1,
                    'data' => db('config')->where('scope', 'System')->column('id,title,content', 'type')
                ]
            );
        }
    }
}
