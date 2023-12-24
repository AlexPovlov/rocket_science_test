<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __invoke(Request $request)
    {
        $products = Product::filterProperties($request->get('properties', []))
            ->with(['properties'])
            ->paginate(40);

        return response()->success(ProductResource::collection($products));
    }
}
