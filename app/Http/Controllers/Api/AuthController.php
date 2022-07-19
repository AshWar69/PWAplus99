<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $u = User::where('mobile',$request->mobile)->first();
            if($u==null)
            {
                $input = $request->all();
                $input['password'] = bcrypt($request->password);
                $user = User::create($input);
            }    
            if(Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password ])){
                $user = Auth::user();
                $success['token'] =  $user->createToken('thedevbros')->plainTextToken;
                return response()->json($success, 200);
            }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return['message' => 'Logged Out'];
    }
}
