<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignPrizeToCategoryRequest;
use App\Http\Requests\PrizeRequest;
use App\Models\Category;
use App\Models\Prize;
use App\Models\PrizeLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrizeController extends Controller
{
    public function store(PrizeRequest $request)
    {
        $prize = Prize::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return response()->json(['message' => 'Prize created successfully', 'prize' => $prize], 201);
    }

    public function assignToCategory(AssignPrizeToCategoryRequest $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->prizes()->attach($request->prize_id, [
            'amount' => $request->amount,
            'odds' => $request->odds,
        ]);
        return response()->json(['message' => 'Prize assigned successfully'], Response::HTTP_OK);
    }

    public function spin(Request $request)
    {
        $user = $request->user();
        $rank = $user->rank;

        $prizes = $rank->prizes()->where('count', '>', 0)->get();

        foreach ($prizes as $prize) {
            if ($this->attemptWin($prize->probability)) {
                $prize->count -= 1;
                $prize->save();

                PrizeLog::create([
                    'user_id' => $user->id,
                    'prize_id' => $prize->id,
                    'won_at' => now(),
                ]);

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
