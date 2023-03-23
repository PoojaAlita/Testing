<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, Response, Validator};

class AuthController extends Controller
{
    public $successStatus = 200;

    /*Registration Api*/
    public function registration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:3,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $user->createToken('Token')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], $this->successStatus);
    }
    /* Login Api */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response::json([
                'code' => 401,
                'status' => 'failed',
                'message' => $validator->errors()
            ]);
        }


        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /*UnAuthnticated Api*/
    public function unAuthnticated()
    {
        return response()->json([
            'code' => 401,
            'status' => 'failed',
            'message' => 'unAuthnticated'
        ]);
    }

    /* Logout api*/
    public function logout()
    {

        $logout =  auth()->user()->token()->revoke();
        if ($logout) {
            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        }
    }

    //Listing Data Of User
    public function listing()
    {
        $userData = User::where('status', 1)->where('flag', 1)->get(['id', 'name', 'email']);
        if ($userData) {
            return response()->json(['userData' => $userData], $this->successStatus);
        }
        return response()->json(['Error' => 'User Data Not Available'], 401);
    }

    //Show And Update Data Of User Using API
    public function edit(Request $request, $id)
    {
        if (isset($id)) {
            $userData = User::where('status', 1)->where('flag', 1)->find($id);
            if (!is_null($userData)) {
                if (isset($request) && $request->name  && $request->email) {
                    if (!is_null($userData)) {
                        $userData->name = $request->name;
                        $userData->email = $request->email;
                        $userData->update();
                    }
                }
                return response()->json(['userData' => $userData], $this->successStatus);
            }
        }
        return response()->json(['Error' => 'User Data Not Available'], 401);
    }

    //Remove Data Of User
    public function delete($id)
    {
        $userData = User::where('id', $id)->where('status', 1)->where('flag', 1)->find($id);
        if ($userData) {
            $userData->status = 0;
            $userData->update();
            // return response()->json(['userData' => $userData], $this->successStatus);
            return response()->json(['Success' => 'User Data Delete Successfully'], $this->successStatus);
        }

        return response()->json(['Error' => 'User Data Not Available'], 401);
    }

    //Show And Update Data Of Profile Using API
    public function profile_update(Request $request, $id)
    {
        if (isset($id)) {
            $userData = User::where('status', 1)->where('flag', 1)->find($id);
            if (!is_null($userData)) {
                if (isset($request) && $request->name  && $request->email) {
                    if (!is_null($userData)) {
                        $userData->name = $request->name;
                        $userData->email = $request->email;
                        $userData->update();
                    }
                }
                return response()->json(['userData' => $userData], $this->successStatus);
            }
        }
        return response()->json(['Error' => 'Data Not Available'], 401);
    }
}
