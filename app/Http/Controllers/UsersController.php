<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
$data=[
'token'=>$token,
'user'=>$user,
'message'=>'Login SuccessFully',
'status'=>200
];
            return response()->json($data,200);
        }
        else{
            $data=[
                'message' => 'The email and password is incorrect',
                'status'=>400
            ];
            return response()->json($data,400);
        }

    }
    
    public function register(Request $request)
    {
       $validate= Validator::make( $request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'number'=>'required'
        ]);
        if($validate->fails())
        {
            $data= 
            [
                "status"=>400,
                "message"=>$validate->messages()
            ];
            return response()->json($data,400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number'=>$request->number
        ]);

        $token = $user->createToken('authToken')->plainTextToken;
        $data=[
            'token'=>$token,
            'user'=>$user,
            'message'=>'Register SuccessFully',
            'status'=>200
            ];
        return response()->json($data,200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $data=[
          
            'message'=>'Logout SuccessFully',
            'status'=>200
            ];
        return response()->json($data,200);
    }
}
