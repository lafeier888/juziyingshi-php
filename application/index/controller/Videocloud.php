<?php

namespace app\index\controller;

use think\Controller;

use think\Session;

class Videocloud extends Controller
{
//    public function _initialize()
//    {
//        $id = session('user');
//
//        if (!$id) {
//            $this->redirect('login/login/index');
//        }
//    }

    public function search()
    {

        $data = db('videocloud')->where('name', 'LIKE', '%' . input('word') . '%')->select();
        $newdata = array();
//        return json_decode($data[0]['playlist'],true);
        foreach ($data as $item) {
            $jsondata = json_decode($item['playlist'], true);
            if (array_key_exists('hkzy',$jsondata)) {
                $item['playlist'] = $jsondata['hkzy'];
                array_push($newdata, $item);
            }



        }
        return json($newdata);
    }
}
