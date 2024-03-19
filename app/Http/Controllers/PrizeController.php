<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class PrizeController extends Controller
{
    public function spin(Request $request)
    {
        $user = $request->user();
        $rank = $user->rank;

        $prizes = $rank->prizes()->where('count', '>', 0)->get();

        foreach ($prizes as $prize) {
            if ($this->attemptWin($prize->probability)) {
                $prize->count -= 1;
                $prize->save();

                return response()->json(['won' => true, 'prize' => $prize->name]);
            }
        }

        return response()->json(['won' => false, 'message' => 'Better luck next time!']);
    }

    protected function attemptWin($probability)
    {
        return mt_rand(1, 100) <= ($probability * 100);
    }
}
