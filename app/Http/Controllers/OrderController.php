<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    
    public function INdex()
    {
         $order = order::all();
        $data = 
        [
              "status"=>200,
              "order"=>$order
        ];
        return response()->json($data,200);
 
    }
    

    
    public function Store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'number'=>'required',
            'city'=>'required',
            'postal_code'=>'required',
            'address'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'user_id'=>'required',
            'product_id'=>'required',
            
        ]);
        if($validator->fails())
        {
            $data= 
            [
                "status"=>400,
                "message"=>$validator->messages()
                
            ];
            return response()->json($data,400);
        }
        
        else
        {
            $order = new order;
            $order->name=$request->name;
            $order->last_name=$request->last_name;
            $order->email=$request->email;
            $order->number=$request->number;
            $order->city=$request->city;
            $order->postal_code=$request->postal_code;
            $order->address=$request->address;
            $order->price=$request->price;
            $order->quantity=$request->quantity;
            $order->user_id=$request->user_id;
            $order->product_id=$request->product_id;
            $order->save();
            
            
            $data=
            [

                "status"=>200,
                "message"=>"Prodeut Uploaded Successfully!"
            ];
            return response()->json($data,200);
        }
    }

      
    public function Edit(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'number'=>'required',
            'city'=>'required',
            'postal_code'=>'required',
            'address'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'user_id'=>'required',
            'product_id'=>'required',
            
        ]);
        if($validator->fails())
        {
            $data= 
            [
                "status"=>400,
                "message"=>$validator->messages()
                
            ];
            return response()->json($data,400);
        }
        
        else
        {
            $order = order::find($id);
            $order->user_id=$request->user_id;
            $order->product_id=$request->product_id;
            $order->name=$request->name;
            $order->last_name=$request->last_name;
            $order->email=$request->email;
            $order->number=$request->number;
            $order->city=$request->city;
            $order->postal_code=$request->postal_code;
            $order->address=$request->address;
            $order->price=$request->price;
            $order->quantity=$request->quantity;
            $order->save();
            
        
            $data=
            [

                "status"=>200,
                "message"=>"Prodeut Update Successfully!"
            ];
            return response()->json($data,200);
        }
    }

    
    public function delete($id)
    
    {
        $order = order::find($id);
        $order->delete();

$data =
[
    "status"=>200,
    "message"=>"Data Deleted Successfull!"
];

        return response()->json($data,200);
    }
}
