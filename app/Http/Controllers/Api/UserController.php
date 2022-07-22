<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'string|required',
    //         // 'role' => 'nullable|in:moderator,admin',
    //         'password' => 'required',
    //         'email' =>'required|email'
    //         // 'status' => 'required|in:0,1,2,3'
    //     ]);

    //     $user = User::create([
    //         'nick_name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'role_id'=> $request->role_id
    //     ]);

    //     // $user->role()->create([
    //     //     'user_id' => $user->id,
    //     //     'role' => $request->role
    //     // ]);

    //     return $user;
    // }

    public function login(Request $request)
	{
		$request->validate([
            'email' => 'required|email',
    		'password' => 'required',
        ]);
        
        $credentials = $request->only(['email', 'password']);

		if (Auth::attempt($credentials)) {	
			$user = Auth::user();
            $success['token'] = $user->createToken('authToken', [
                $user->role->name
            ])->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully.');
        }else {
            return $this->sendError('Unauthorised', ['error'=>'Unauthorised']);
		}
	}   

    public function logout()
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update([
                'revoked' => true
            ]);
            return $this->sendResponse('', 'Successfully logged out');    
    }
    

}
