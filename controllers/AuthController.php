<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\models\RegisterModel;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->method() == 'post') {


            $registerModel->loadData($request->getBody());



            if ($registerModel->validate() && $registerModel->addAccount()) {

                return "Successfully registered";
            }



            return $this->render('register', [
                "model" => $registerModel
            ]);
        }


        return $this->render('register', [
            "model" => $registerModel,
        ]);
    }
}
