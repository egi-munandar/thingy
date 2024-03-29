<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function api_login(Request $r)
    {
        info($r->all());
        $r->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $u = User::where('email', $r->email)->first();
        if ($u) {
            if (password_verify($r->password, $u->password)) {
                $token_name = $r->tokenName ? $r->tokenName : \Str::random(10);
                $token = $u->createToken($token_name);
                $u->apiToken = $token->plainTextToken;
                $u->perms = $u->permissions()->pluck('name')->toArray();
                return $u;
            }
        }
    }
    public function api_logout(Request $r)
    {
        info($r->headers);
        $r->user()->currentAccessToken()->delete();
        return response()->json('success', 200);
    }
}
