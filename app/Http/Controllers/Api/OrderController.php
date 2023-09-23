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
        return OrderResource::collection(Order::where('created_by',$request->created_by));
    }

    public function store(Request $request){

       // dd($request->all());
      //  DB::table('orders')->insert($request->toArray());
      //  return response("", 201);

   /*  $validator = Validator::make($request->all(), [
            'number' => 'required',
            'product_id' => 'required',
            'created_by' => 'required'
        ]);*/

//$data = $request->all();

        foreach ($request->all() as $item) {
            Order::create([
                'number' => $item['number'],
                'product_id' => $item['product_id'],
                'created_by' => $item['created_by'],
            ]);
        }

        return response("0",200);
      //  return gettype($validator->validated());
      //  return Order::create($validator->validated());
    }
}
