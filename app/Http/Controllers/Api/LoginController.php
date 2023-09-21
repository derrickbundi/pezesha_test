<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Validator,Log};
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()) {
            return _httpBadRequest($validator->errors()->first(),$validator->errors());
        }
        try {   
            $user = User::where('email',$request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)) {
                return _httpBadRequest('The provided credentials are incorrect.');
            }        
            $data['token'] = $user->createToken(\Request::ip())->plainTextToken;
            $data['profile'] = $user;
            return _httpOk('Login successful',$data);
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return _httpBadRequest('Oops, something went wrong', $e->getMessage());
        }
    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return _httpOk("Logout successful.");
    }
}
