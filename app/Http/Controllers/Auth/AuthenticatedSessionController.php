<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        $credentials = $request->only(['username', 'password']);
            $validation = Validator::make(
                $credentials,
                [
                    'username' => ['required', 'string'],
                    'password' => ['required', 'string'],],
                [
                    'username.required' => 'Username harus diisi',
                    'password.required' => 'Password harus diisi',
                ]
            );

            if ($validation->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validation->errors()
                ]);
            }

            try {
                if (!$token = auth()->attempt($credentials)) {
                    return response()->json([
                        'status' => 402,
                        'message' => auth()->user()
                    ]);
                }
                $user = User::where('username', $credentials['username'])->where('password', Hash::make($credentials['password']))->first();
                $t = auth()->login($user);
                return response()->json([
                    'status' => 200,
                    'message' => $t,
                ]);
            } catch (JWTException $e) {
                return response()->json([
                    'status' => '500',
                    'message' => $e
                ]);
            }

    }
}
