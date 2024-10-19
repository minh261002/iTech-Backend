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
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);
    }

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

        $refreshTokenData = $this->refreshTokenData($admin);

        $refresh_token = JWTAuth::getJWTProvider()->encode($refreshTokenData);

        $cookie = $this->setAccessTokenAndRefreshToken($token, $refresh_token);

        $accessTokenCookie = $cookie['tokenCookie'];
        $refreshTokenCookie = $cookie['refreshTokenCookie'];

        return $this->respondWithToken($token, $refresh_token, $admin)->withCookie($accessTokenCookie)->withCookie($refreshTokenCookie);
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
        $refreshTokenCookie = Cookie::forget('refresh_token');

        return response()->json(['message' => 'Đăng xuất thành công'])->withCookie($cookie)->withCookie($refreshTokenCookie);
    }

    public function refresh(Request $request)
    {
        try {
            if ($request->hasCookie('access_token')) {
                $token = $request->cookie('access_token');

                $request->headers->set('Authorization', 'Bearer ' . $token);
            }
            $admin = JWTAuth::parseToken()->authenticate();
            $token = auth()->guard('admin')->refresh();

            auth()->guard('admin')->invalidate(true);

            $refreshTokenData = $this->refreshTokenData($admin);
            $refreshToken = JWTAuth::getJWTProvider()->encode($refreshTokenData);

            $cookie = $this->setAccessTokenAndRefreshToken($token, $refreshToken);

            $accessTokenCookie = $cookie['tokenCookie'];
            $refreshTokenCookie = $cookie['refreshTokenCookie'];

            return $this->respondWithToken($token, $refreshToken, $admin)->withCookie($accessTokenCookie)->withCookie($refreshTokenCookie);

        } catch (TokenExpiredException $e) {
            if ($request->hasCookie('refresh_token')) {
                if (!$request->cookie('refresh_token')) {
                    return response()->json(['error' => 'Token không hợp lệ'], 401);
                }

                $refreshToken = $request->cookie('refresh_token');
                $refreshTokenData = JWTAuth::getJWTProvider()->decode($refreshToken);

                $admin = Admin::find($refreshTokenData['admin_id']);
                $token = auth()->guard('admin')->login($admin);
                $refreshTokenData = $this->refreshTokenData($admin);
                $refreshToken = JWTAuth::getJWTProvider()->encode($refreshTokenData);

                $cookie = $this->setAccessTokenAndRefreshToken($token, $refreshToken);
                $accessTokenCookie = $cookie['tokenCookie'];
                $refreshTokenCookie = $cookie['refreshTokenCookie'];

                return $this->respondWithToken($token, $refreshToken, $admin)->withCookie($accessTokenCookie)->withCookie($refreshTokenCookie);
            }

            return response()->json(['error' => 'Refresh Token đã hết hạn'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token không hợp lệ'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'Không có token'], 401);
        }
    }

    protected function respondWithToken($token, $refresh_token, $user)
    {
        return response()->json([
            'admin' => new AdminResource($user),
            'access_token' => $token,
            'refresh_token' => $refresh_token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('admin')->factory()->getTTL() * 60, //1 ngày
        ]);
    }

    private function setAccessTokenAndRefreshToken($token, $refresh_token)
    {
        $cookie = Cookie::make(
            'access_token',
            $token,
            config('jwt.ttl') * 60 * 24, //1 ngày
            "/",
            null,
            true,
            true,
            false,
            "None"
        );

        $refreshTokenCookie = Cookie::make(
            'refresh_token',
            $refresh_token,
            config('jwt.refresh_ttl') * 60 * 24 * 14, //2 tuần
            "/",
            null,
            true,
            true,
            false,
            "None"
        );

        return [
            'tokenCookie' => $cookie,
            'refreshTokenCookie' => $refreshTokenCookie
        ];
    }

    private function refreshTokenData($admin)
    {
        return [
            "admin_id" => $admin->id,
            "expires_in" => time() + config('jwt.refresh_ttl ') * 60 * 24 * 14, //2 tuần
            "random" => time() . md5(rand())
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
