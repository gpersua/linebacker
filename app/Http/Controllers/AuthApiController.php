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
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use linebacker\Http\Requests;
use linebacker\Http\Controllers\Controller;
class AuthApiController extends Auth\AuthController {  
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
