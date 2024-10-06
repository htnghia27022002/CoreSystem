<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Attributes\Validate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class AuthenticationController extends Controller implements HasMiddleware
{   

    public static function middleware() {
        
        return [
            "validate"
        ];
    }

    // func: login 
    #[Validate(
        rules:[
            "user" => "required",
            "password" => "required",
        ],
        messages: [
            "user.required" => "The :attribute is required",
            "password.required" => "The :attribute is required"
        ]
    )]
    public function login(Request $request) {
        
        $params = $request->all();
    }

    // register account
    #[Validate(
        rules: [],
        messages: []
    )] 
    public function register(Request $request) {
        
        $params = $request->all();
    }
}
