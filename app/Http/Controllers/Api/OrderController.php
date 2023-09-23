<?php


namespace App\Http\Controllers\Api;


use App\Http\Resources\OrderResource;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    public function index(Request $request){

      //  dd($request['created_at']);
        return OrderResource::collection(Order::where(['created_by'=>$request['created_by']])->get());
    }

    public function store(Request $request){

        foreach ($request->all() as $item) {
            Order::create([
                'number' => $item['number'],
                'product_id' => $item['product_id'],
                'created_by' => $item['created_by'],
            ]);
        }
        return response("0",200);
    }
}
