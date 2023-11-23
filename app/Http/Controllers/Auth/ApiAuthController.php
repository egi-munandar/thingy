<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
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
