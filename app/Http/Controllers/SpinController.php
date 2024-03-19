<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpinController extends Controller
{
    public function spinWheel(Request $request)
    {
        $user = $request->user();
        $cooldownSetting = Setting::where('key', 'wheel_spin_cooldown_hours')->first();
        $cooldownHours = $cooldownSetting ? $cooldownSetting->value : 24;
        $now = now();

        if (!is_null($user->last_spin_time) && $user->last_spin_time->diffInHours($now) < $cooldownHours) {
            return response()->json(['message' => 'Please wait before spinning again.'], Response::HTTP_TOO_MANY_REQUESTS);
        }

        // Update last spin time
        $user->last_spin_time = $now;
        $user->save();

        return response()->json([
            'message' => 'Wheel spun successfully!',
        ], Response::HTTP_OK);
    }
}
