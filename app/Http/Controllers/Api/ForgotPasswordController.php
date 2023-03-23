<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\{Password, Validator, DB, Hash, Mail, Response, URL};
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;



class ForgotPasswordController extends Controller
{

    /*Reset Password Api*/
    public function resetPassword(Request $request)
    {
        $userData = User::where('email', $request->email)->first();
        if (!is_null($userData) && $userData->flag == 0) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',

            ]);
            if ($validator->fails()) {
                return response::json([
                    'code' => 401,
                    'status' => 'failed',
                    'message' => $validator->errors()
                ]);
            }

            $password =  Str::random(60);
            $data['email'] = $request->email;
            $data['title'] = "Password Reset";
            $data['body'] = "Please click on below link to reset your password";
            $resetPasswordMail =  Mail::send('emails.resetPassword', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            $update['password'] = $password;
            if (!is_null($resetPasswordMail) && $resetPasswordMail) {
                $resetPassword = User::where('email', $request->email)->update($update);
                if ($resetPassword) {
                    return response::json([
                        'code' => 201,
                        'status' => 'Success',
                        'message' => 'Reset Password Successfully..'
                    ]);
                }
            }
        } elseif (!is_null($userData) && $userData->flag == 1) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
                'confirmPassword' => 'required|same:password'
            ]);
            if ($validator->fails()) {
                return response::json([
                    'code' => 401,
                    'status' => 'failed',
                    'message' => $validator->errors()
                ]);
            }
            $update['password'] = bcrypt($request->password);
            $resetPassword = User::where('email', $request->email)->update($update);
            if ($resetPassword) {
                return response::json([
                    'code' => 201,
                    'status' => 'success',
                    'message' => 'Forgot Password Successfully..'
                ]);
            }
        } else {
            return response::json([
                'code' => 401,
                'status' => 'Failed',
                'message' => 'Please Enter The Valid Email Address.'
            ]);
        }
    }

    /* Forgot Password Api*/
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response::json([
                'code' => 401,
                'status' => 'failed',
                'message' => $validator->errors()
            ]);
        }
        if ($request->email) {
            $user = User::where('email', $request->email)->first();
            $time = strtotime(Carbon::now());
            $token = $time . Str::random(60);

            $data['url'] = URL::to('/') . '/api/change-password/token=' . $token;

            $data['email'] = $request->email;
            $data['title'] = "Password Reset";
            $data['body'] = "Please click on below link to reset your password";
            Mail::send('emails.forgotPassword', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            $dataTime = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $dataTime
                ]
            );
            return response::json([
                'code' => 201,
                'status' => 'success',
                'token' => $token,
                'message' => 'Forgot Password Link Sent Successfully..'
            ]);
        } else {
            return response::json([
                'code' => 401,
                'status' => 'failed',
                'message' => 'Please Enter The Valid Email Address.'
            ]);
        }
    }
    /*Change Password Api*/
    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $userData = User::where('id', $request->id)->first();
        $response = '';
        if (!is_null($userData)) {
            if (!(Hash::check($request->old_password, $userData->password))) {
                $response = response()->json(['Error' => 'Your old password does not matches with the password you provided. Please try again.']);
            } elseif ($request->old_password == $request->password) {
                $response = response()->json(['Error' => 'New Password cannot be same as your current password. Please choose a different password']);
            } else {
                $update['password'] = bcrypt($request->password);
                $abc = User::where('id', $request->id)->update($update);
                $response = response()->json(['Success' => 'Change Password Successfully!']);
            }
            return $response;
        }
    }
}
