<?php
namespace app\app\controller;
use app\XDeode;
use think\Controller;
class Banner extends Controller
{
    function index($cid){
        return json(db('banner')->where('cid',$cid)->order('sort asc')->select());
    }

}