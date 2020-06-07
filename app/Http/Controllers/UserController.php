<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    //

    /*
     *  Login API
     * @return \Illuminate\Http\Response
     **/
    public function login(Request $request) {
        try {

        }catch (\Exception $exception) {
            return response()->json([
                "exception"=>$exception->getMessage()
            ],500);
        }
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            //after successful authentication, notice how I return json parameters
            return response()->json([
                'success'=>true,
                'token'=>$success,
                'user'=>$user
            ]);
        } else {
            //if authentication is unsuccessful, notice how I return json parameters
            return response()->json([
               'success'=>false,
                'message'=>'Invalid Email or Password',
                'params'=>$request['email']." ".$request['password']
            ], 401);
        }
    }

    /*
     * Register API
     *
     */

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success'=> false,
                'message'=>$validator->errors()
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('appToken')->accessToken;
        return response()->json([
            'success'=> true,
            'token' => $success,
            'user' => $user
        ]);
    }

    /**
     * LogOut API
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'LogOut successful'
            ]);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'Unable to logout'
            ]);
        }
    }
}
