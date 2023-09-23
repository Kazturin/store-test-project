<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        return ProductResource::collection(Product::paginate(10));
    }
}
