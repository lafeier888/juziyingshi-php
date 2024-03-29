<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Video extends Controller
{
    public function _initialize()
    {
        $id = session('user');

        if (!$id) {
            $this->redirect('login/login/index');
        }
    }
    public function videoiframe()
    {
        return $this->view("videoiframe");
    }
    public function index()
    {
        $code       =   input('code');
        $msg        =   input('msg');

        $list       =   db('video')->order('id desc')->paginate(10);
        return view('index',[
            'msg'   =>  $msg,
            'list'  =>  $list,
            'code'  =>  $code
        ]);
    }

    public function add()
    {
        $code   =   input('msg');
        return view('add',
            [
                'code'  =>  $code
            ]);
    }

    public function update()
    {
        $code   =   input('msg');
        $data   =   db('video')->where('id',input('id'))->find();
        return view('update',
            [
                'data'  =>  $data,
                'code'  =>  $code
            ]);
    }
 public function delete()
    {
        $id     =   input('id');
        $arr    =   implode(',',array_filter(explode(',',$id)));
        if(db('video')->where('id in ('.$arr.')')->delete())
        {
            return json(['code'=>'1']);
        }else{
            return json(['code'=>'0']);
        }
    }

    public function create()
    {
        $file = request()->file('picurl');
        if($file) {

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if ($info) {
                $type = ['gif', 'jpeg', 'png', 'bmp', 'jpg'];
                $types = $info->getExtension();
                $url = '/public/uploads/' . $info->getSaveName();
                if(!in_array($types,$type))
                {
                    unlink($url);
                    return redirect('video/add',['code'=>0,'msg'=>'请上传图片']);
                }

            }

            $picurl =   str_replace('\\','/',str_replace('\\\\','/',$url));
        }

        $insert['picurl']   =!empty($picurl)?$picurl:input('picurl1');
        $insert['name']  =   input('name');
        $insert['video']  =   input('video');
        if(db('video')->insert($insert)!==false)
        {
            return redirect('video/index',['code'=>1,'msg'=>'添加成功']);
        }else{
            if(!empty($url))
            {
                unlink($url);
            }

            return redirect('video/add',['code'=>0,'msg'=>'添加失败']);
        }

    }

    public function edit()
    {
        $file = request()->file('picurl');
        if($file) {

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if ($info) {
                $type = ['gif', 'jpeg', 'png', 'bmp', 'jpg'];
                $types = $info->getExtension();
                $url = '/public/uploads/' . $info->getSaveName();
                if(!in_array($types,$type))
                {
                    unlink($url);
                    return redirect('video/add',['code'=>0,'msg'=>'请上传图片']);
                }

            }

            $picurl =   str_replace('\\','/',str_replace('\\\\','/',$url));
        }

        $insert['picurl']   =!empty($picurl)?$picurl:input('picurl1');
        $insert['name']  =   input('name');
        $insert['video']  =   input('video');
        if(db('video')->where('id',input('id'))->update($insert)!==false)
        {
            return redirect('video/index',['code'=>1,'msg'=>'修改成功']);
        }else{
            if(!empty($url))
            {
                unlink($url);
            }

            return redirect('video/update',['code'=>0,'msg'=>'修改失败']);
        }



    }
}