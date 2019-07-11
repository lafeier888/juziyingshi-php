<?php
namespace app\app\controller;
use app\XDeode;
use think\Controller;
class Config extends Controller
{
    public function appconfig(){
        return json(db("config")->where('scope','APP')->column('id,title,content','type'));
    }
    public function sysconfig(){
        return json(db("config")->where('scope','System')->column('id,title,content','type'));
    }

}