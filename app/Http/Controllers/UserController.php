<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new user.
     * 
     * @param Request $request
     * 
     * @return $response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]
        );
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        if ($user->save())
        {
            $response = response()->json(
                [
                    'response' => [
                        'created' => true,
                        'userId' => $user->id
                    ]
                ], 201
            );
        }
        return $response;
    }
}