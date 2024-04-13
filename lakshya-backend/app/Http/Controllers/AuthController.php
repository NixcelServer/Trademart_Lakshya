<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\EncDecHelper;
use Illuminate\Support\Facades\Date;


class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        //find the user from email id
        $user = User::where('u_email',$request->email)->where('u_designation','admin')->first();
        
        //check email is invalid return invalid error msg
        if (!$user) {
            return response()->json(['error' => 'Invalid email. Please enter a valid email.'], 400);
        }
       //return response()->json($request);
        //enc the pass recived from the request
        $encPass = EncDecHelper::encryptData($request->password);
       
        //if user exists validate password and redirect to respective page
        if (strcmp($user->u_password, $encPass) === 0) {
            return response()->json(['message' => 'Admin logged in successfully'], 200);
        }else {
            // Password does not match, return error response
            return response()->json(['error' => 'Invalid password. Please enter a valid password.'], 400);
        }

    }



    public function register(Request $request)
    {
       // return response()->json($request);
        $encPass = EncDecHelper::encryptData($request->password);

        $user = new User;
        $user->u_name = $request->name;
        $user->u_email = $request->email;
        //$user->u_mobile = $request->mobile;
        $user->u_designation = 'Buyer';
        $user->u_password = $encPass;
        $user->add_date = Date::now()->toDateString();
        $user->add_time = Date::now()->toTimeString();
        $user->save();

        return response()->json(['message' => 'Registration Successfull'], 200);
    }

    public function uLogin(Request $request)
    {
        
        $encPass = EncDecHelper::encryptData($request->password);

        //find the user from email id
        $user = User::where('u_email', $request->email)
            ->whereNotIn('u_designation', ['admin'])
            ->first();

        
        
        //check email is invalid return invalid error msg
        if (!$user) {
            return response()->json(['error' => 'Invalid email. Please enter a valid email.'], 400);
        }

        //if user exists validate password and redirect to respective page
        if (strcmp($user->u_password, $encPass) === 0) {
            return response()->json(['message' => 'User logged in successfully'], 200);
        }else {
            // Password does not match, return error response
            return response()->json(['error' => 'Invalid password. Please enter a valid password.'], 400);
        }

    }
}
