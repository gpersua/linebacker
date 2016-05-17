<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthApiController
 *
 * @author MariaSquid
 */
namespace linebacker\Http\Controllers;

use linebacker\lb_users;
use Validator;
use linebacker\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class AuthApiController extends AuthController {  
    public function login() {  
        $username = Request::get('username');  
        $password = Request::get('password');  
   
        $userdata = array(  
            'username' => $username,  
            'password' => $password  
        );  
   
        $error = true;  
        $user = array();  
   
        if (Auth::attemp($userdata)) {  
            $error = false;  
            $user = array(  
                'id' => Auth::user()->id,  
                'username' => Auth::user()->username  
            );  
        }  
   
        return Response::json(array(  
            'error' => $error,  
            'user' => $user  
        ), 200);  
    }  
}  
