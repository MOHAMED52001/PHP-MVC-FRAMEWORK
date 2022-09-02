<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller{


    public function home(){
        $params = [
            "name" => 'Mohamed Atef'
        ];
        return $this->render('home',$params);
    }

    public static function handleContact(Request $request){
       print_r($request->getBody());die;
    }


}