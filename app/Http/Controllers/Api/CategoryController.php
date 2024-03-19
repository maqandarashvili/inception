<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRanksRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function assignRanks(AssignRanksRequest $request, Category $category)
    {
        $category->ranks()->sync($request->rank_ids);

        return response()->json(['message' => 'Ranks assigned successfully'], Response::HTTP_OK);
    }
}
