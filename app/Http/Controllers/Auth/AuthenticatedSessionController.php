<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['create', 'login']]);
    }

    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $validation = $this->validation($request);
            if ($validation->fails()) {
                return response()->json(['status' => 400,'message' => 'Username dan Password Harus Diisi']);
            } else if (!$token = auth()->attempt($request->only(['username', 'password']))) {
                return response()->json(['status' => 401,'message' => 'Username atau Password Salah']);
            }
            return response()->json([
                'status' => 200,
                'message' => $token,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 500,
                'message' => $e
            ]);
        }

    }

    public function validation(Request $request)
    {
        $validation = Validator::make(
            $request->only(['username', 'password']),
            [
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],],
            [
                'username.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );

        return $validation;
    }
}
