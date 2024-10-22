<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Mail\AdminSendResetLinkMail;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (!$token = auth()->guard('admin')->attempt($credentials)) {
            return response()->json([
                'status' => 401,
                'error' => 'Thông tin đăng nhập không chính xác'
            ], );
        }

        $admin = auth()->guard('admin')->user();


        $cookie = $this->setAccessTokenAndRefreshToken($token);

        $accessTokenCookie = $cookie['tokenCookie'];

        return $this->respondWithToken($token, $admin)->withCookie($accessTokenCookie);
    }

    public function me()
    {
        try {
            return response()->json([
                'admin' => new AdminResource(auth()->guard('admin')->user())
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Token không hợp lệ'
            ], 401);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        $cookie = Cookie::forget('access_token');

        return response()->json(['message' => 'Đăng xuất thành công'])->withCookie($cookie);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'admin' => new AdminResource($user),
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    private function setAccessTokenAndRefreshToken($token)
    {
        $cookie = Cookie::make(
            'access_token',
            $token,
            52560000,
            "/",
            null,
            true,
            true,
            false,
            "None"
        );

        return [
            'tokenCookie' => $cookie,
        ];
    }


    public function sendLinkResetPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $token = Str::random(64);
        $admin = Admin::where('email', $data['email'])->first();

        $admin->remember_token = $token;
        $admin->save();

        Mail::to($request->email)->send(new AdminSendResetLinkMail($token, $data['email'], $admin->name, $data['device'], $data['time']));

        return response()->json(['message' => 'Link reset password đã được gửi đến email của bạn']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::where('email', $data['email'])->first();

        if ($admin->remember_token != $data['token']) {
            return response()->json(['error' => 'Token không hợp lệ'], 401);
        }

        $admin->password = bcrypt($data['password']);
        $admin->remember_token = null;
        $admin->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công']);
    }
}
