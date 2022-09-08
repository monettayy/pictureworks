<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'No such user',
                'id' => $id
            ], 404);
        }

        return view('user', compact('user'));
    }

    public function postUser(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => 'required|numeric',
            'comments' => 'required',
            'password' => 'required',
        ],[
            'id.required' => 'Missing key/value for id',
            'id.numeric' => 'Invalid id',
            'comments.required' => 'Missing key/value for comments',
            'password.required' => 'Missing key/value for password',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Incomplete form fields',
                'errors' => $validator->messages()
            ], 422);
        }

        if ($input['password'] != env('APP_PASSWORD')) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password'
            ], 401);
        }

        $user = User::find($input['id']);
        $user->comments .= "\n". $input['comments'];
        $user->save(); 

        return response()->json([
            'success' => true,
            'message' => 'OK'
        ], 200);
    }
}
