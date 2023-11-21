<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
$product = Product::all();
        $data = 
        [
              "status"=>200,
              "product"=>$product
        ];
        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required',
            'availability'=>'required',
            'cat_id'=>'required'

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
            $product = new Product;
            $product->cat_id=$request->cat_id;
            $product->name=$request->name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->naquantityme=$request->quantity;
            $product->availability=$request->availability;
            $product->save();
            
            
            
            $data=
            [

                "status"=>200,
                "message"=>"Prodeut Uploaded Successfully!"
            ];
            return response()->json($data,200);
        }
    }

    public function edit(Request $request,$id)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required',
            'availability'=>'required',

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
            $product = Product::find($id);
            $product->name=$request->name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->naquantityme=$request->quantity;
            $product->availability=$request->availability;
            $product->save();
            
            
            
            $data=
            [

                "status"=>200,
                "message"=>"Prodeut Updated Successfully!"
            ];
            return response()->json($data,200);
        }

    }

    public function delete($id)
    
    {
        $product = Product::find($id);
        $product->delete();

$data =
[
    "status"=>200,
    "message"=>"Data Deleted Successfull!"
];

        return response()->json($data,200);
    }
}
