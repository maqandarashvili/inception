<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminAuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        $cachedUser = Redis::get('admin_login:' . $request->email);

        if ($cachedUser) {
            $user = unserialize($cachedUser);
        } else {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                Redis::setex('admin_login:' . $request->email, 3600, serialize($user));
            }
        }
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        if (!$user->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $user->createToken('auth_token')->plainTextToken;
    }
}
