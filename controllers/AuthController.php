<?php


namespace app\controllers;
use app\core\Request;
use app\core\Controller;

class AuthController extends Controller{

    public function login(Request $request){

    }
    public function register(Request $request){
        $request->getBody();
    }

}