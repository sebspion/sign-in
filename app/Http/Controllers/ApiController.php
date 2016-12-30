<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
//use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function me()
    {
        $user = Auth::user();
        $data = [
            "id" => $user->id,
            "uuid" => $user->uuid,
            "name" => $user->username,
            "email" => $user->email
        ];

        return  $data;
    }
}
