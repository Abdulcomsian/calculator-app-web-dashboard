<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::latest()->get();
            return response()->json([
                "status" => "success",
                "message" => "Categories fetched successfully",
                "categories" => $categories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Failed to fetch categories",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
