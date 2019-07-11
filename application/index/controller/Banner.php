<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Banner extends Controller
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
//        return json(input());
        $code       =   input('code');
        $msg        =   input('msg');
        $id = input('id');
        $list       =   db('banner')->alias('a')->field('a.*,b.cname')->join('category b','a.cid = b.id')->where('cid',$id)->order('id desc')->paginate(10);
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
                'code'  =>  $code,
                'category'=>db('category')->select()
            ]);
    }

    public function update()
    {


        $code   =   input('msg');
        $data   =   db('banner')->where('id',input('id'))->find();
        $category = db('category')->where('id',$data['cid'])->find();
        $data['category'] = $category['cname'];
        return view('update',
            [
                'data'  =>  $data,
                'code'  =>  $code,
                'category'=>db('category')->select()
            ]);
    }

    public function del()
    {
        $data   =   db('banner')->where('id',input('id'))->delete();
        return redirect('banner/index',['id'=>1,'code'=>1,'msg'=>'删除成功']);
    }

    public function create()
    {
        $file = request()->file('picurl');
        if($file){

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                $type   =   ['gif','jpeg','png','bmp','jpg'];
                $types  =   $info->getExtension();
                $url    =   '/public/uploads/'. $info->getSaveName();
                if(in_array($types,$type))
                {
                    $insert['cid'] = input('cid');
                    $insert['name'] = input('name');
                    $insert['sort'] = input('sort');
                    $insert['picurl']   =   str_replace('\\','/',str_replace('\\\\','/',$url));
                    $insert['content']  =   input('content');
                    $insert['linkurl']  =   input('linkurl');
                    if(db('banner')->insert($insert)!==false)
                    {
                        return redirect('/index/banner/index/id/'.input('cid').'.html',['code'=>1,'msg'=>'添加成功']);
                    }else{
                        unlink($url);
                        return redirect('banner/add',['code'=>0,'msg'=>'添加失败']);
                    }
                }else{
                    unlink($url);
                    return redirect('banner/add',['code'=>0,'msg'=>'请上传图片']);
                }
            }else{

                return redirect('banner/add',['code'=>0,'msg'=>'上传失败'.$file->getError()]);
            }
        }else{
            return redirect('banner/add',['code'=>0,'msg'=>'图片未上传']);
        }

    }

    public function edit()
    {
        $file = request()->file('picurl');
        if($file){

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $type   =   ['gif','jpeg','png','bmp','jpg'];
                $types  =   $info->getExtension();
                $url    =   '/public/uploads/'. $info->getSaveName();
                if(in_array($types,$type))
                {
                    $insert['picurl']   =   str_replace('\\','/',str_replace('\\\\','/',$url));
                }else{
                    unlink($url);
                    return redirect('banner/add',['code'=>0,'msg'=>'请上传图片']);
                }
            }else{

                return redirect('banner/add',['code'=>0,'msg'=>'上传失败'.$file->getError()]);
            }
        }
        $insert['content']  =   input('content');
        $insert['linkurl']  =   input('linkurl');
        if(db('banner')->where('id',input('id'))->update($insert)!==false)
        {
            return redirect('banner/index',['code'=>1,'msg'=>'添加成功']);
        }else{
            unlink($url);
            return redirect('banner/add',['code'=>0,'msg'=>'添加失败']);
        }



    }
}