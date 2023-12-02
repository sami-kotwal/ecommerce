<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    



    public function Index()
    {
$category = category::all();
        $data = 
        [
              "status"=>200,
              "category"=>$category
        ];
        return response()->json($data,200);
    }

    public function Store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
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
            $category = new category;
            $category->name=$request->name;
            $category->save();

            
            $data=
            [

                "status"=>200,
                "message"=>"Category Uploaded Successfully!"
            ];
            return response()->json($data,200);
        }
    }

    public function edit(Request $request,$id)
    {
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            
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
            $category = category::find($id);
            $category->name=$request->name;
            $category->save();
        
            $data=
            [

                "status"=>200,
                "message"=>"Category Updated Successfully!"
            ];
            return response()->json($data,200);
        }

    }

    public function delete($id)
    
    {
        $category = category::find($id);
        $category->delete();

$data =
[
    "status"=>200,
    "message"=>"Data Deleted Successfull!"
];

        return response()->json($data,200);
    }
}
