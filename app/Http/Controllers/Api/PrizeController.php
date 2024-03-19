<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignPrizeToCategoryRequest;
use App\Http\Requests\PrizeRequest;
use App\Models\Category;
use App\Models\Prize;
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
}
