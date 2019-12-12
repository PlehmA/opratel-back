<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function addUser(Request $request)
{

    $request->validate([
        'username' => 'string|required|unique:users',
        'name' => 'string|required',
        'last_name' => 'string|required',
        'email' => 'email|required|unique:users',
        'password' => 'string|required'
    ]);

try {
    $user = User::create([
            "username" => $request->username, 
            "name" => $request->name, 
            "last_name" => $request->last_name, 
            "email" => $request->email, 
            "password" => bcrypt($request->password),
        ]);
    } catch (\Throwable $th) {
        return response()->json($th->getMessage(), 500);
    }

    return response()->json($user, 200);
}

    /**
     * Show all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        try {
            $users = User::all();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }

        return response()->json($users, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::find($id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
            $user->username = $request->username;
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            
        try {
            $user->save();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }

        return response()->json(['message' => 'User updated successfully.', $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delUser($id)
    {
        try {
            $user = User::find($id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
            $user->delete();

        return response()->json($user, 200);
    }

    public function findUser($id)
    {
        try {
            $user = User::find($id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }

        return response()->json($user, 200);
    }
}
