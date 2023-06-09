<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\DailyTracker;
use App\Models\DeviceToken;
use App\Models\User;
use App\Notifications\EmailVerification;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Otp;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;

    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function emailVerify(Request $request) //email Verify otp
    {
        try {

            $rules = [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required|min:6|max:6'
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails())
                return $this->responseMessage(400, false, $validation->messages());


            $otpVerify = $this->otp->validate($request->email, $request->otp);

            if (!$otpVerify->status)
                return $this->responseMessage(401, false, $otpVerify);

            $user = User::where('email', $request->email)->first();
            $user->email_verified_at = now(); //update email_verified_at to now time
            $user->save();

            $token = JWTAuth::fromUser($user);
            $user->access_token = $token;
            $user->token_type = 'bearer';
            $user->expires_in = auth()->factory()->getTTL() * 60;
            return $this->responseMessage(200, true, 'success', $user);

        } catch (\Exception $e) {

            return $this->responseMessage(400, false, 'an error occurred');

        }
    }

    public function resendOtpVerification(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email|exists:users,email',
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails())
                return $this->responseMessage(400, false, $validation->messages());

            $user = $user = User::where('email', $request->email)->first();
            $user->notify(new EmailVerification());
            return $this->responseMessage(200, true, 'Email verification Has Been Send');

        } catch (\Exception $e) {

            return $this->responseMessage(400, false, 'an error occurred');

        }
    }

    public function addDeviceToken(Request $request)
    {

        $rules = [
            'device_token' => 'required|string',
        ];

        $validation = validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return $this->responseMessage(400, false, $validation->messages());
        }

        try {

            DeviceToken::updateorcreate([
                'device_token' => $request->device_token
            ]);

            $dayType = 'Day';
            if ($this->getRamadan()) {
                $dayType = 'Ramadan';
            }
            if ($this->getEidAlFitr() || $this->getEidAlAdha()) {
                $dayType = 'Eid';
            }

            return $this->responseMessage(200, true, 'success', ['day_type' => $dayType, 'types' => ['Day', 'Eid', 'Ramadan']]);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function login(Request $request) //login normal
    {
        try {

            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string'
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails()) {
                return $this->responseMessage(400, false, $validation->messages());
            }

            $credentials = $request->only(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return $this->responseMessage(400, false, 'email or password error');
            }

            $user = Auth::user();

            if ($user->email_verified_at == null)
                return $this->responseMessage(202, false, 'Email Needed To Verify');

            $user->access_token = $token;
            $user->token_type = 'bearer';
            $user->expires_in = auth()->factory()->getTTL() * 60;
            return $this->responseMessage(200, true, 'success', $user);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function register(Request $request) //register new user
    {
        try {

            $rules = [
                'name' => 'required|string|between:2,100',
                'email' => 'required|email|string|max:100|unique:users,email',
                'password' => 'required|string|min:8|confirmed'
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails()) {
                return $this->responseMessage(400, false, $validation->messages());
            }

            $user = User::create(array_merge(
                $validation->validated(), [
                    'password' => Hash::make($request->password)
                ]
            ));

            $user->notify(new EmailVerification()); //send Email verification

            return $this->responseMessage(201, true, 'Email verification Has Been Send');
        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function profile()
    {
        $data = auth()->user();
        return $this->responseMessage(200, true, 'success', $data);
    }

    public function logout()
    {
        auth()->logout();
        return $this->responseMessage(200, true, 'successfully logged out');
    }

    public function refresh()
    {
        $data['access_token'] = auth()->refresh();
        $data['token_type'] = 'bearer';
        $data['expires_in'] = auth()->factory()->getTTL() * 60;
        return $this->responseMessage(200, true, 'success', $data);
    }

    public function loginWithGoogle(Request $request)
    {
        try {

            $redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
            return $this->responseMessage(200, true, 'success', ['redirect_url' => $redirectUrl]);
        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function loginWithFacebook(Request $request)
    {
        try {

            $redirectUrl = Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
            return $this->responseMessage(200, true, 'success', ['redirect_url' => $redirectUrl]);
        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function loginWithGoogleCallback(Request $request) // login with google
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {

                $token = JWTAuth::fromUser($existingUser);

                $existingUser->access_token = $token;
                $existingUser->token_type = 'bearer';
                $existingUser->expires_in = auth()->factory()->getTTL() * 60;

                return $this->responseMessage(200, true, 'success', $existingUser);

            } else {
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = now();
                $newUser->password = Hash::make($user->email);
                $newUser->save();

                $token = JWTAuth::fromUser($newUser);

                $newUser->access_token = $token;
                $newUser->token_type = 'bearer';
                $newUser->expires_in = auth()->factory()->getTTL() * 60;

                return $this->responseMessage(200, true, 'success', $newUser);
            }

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function loginWithFacebookCallback(Request $request)  // login with facebook
    {
        try {

            $user = Socialite::driver('facebook')->stateless()->user();

            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {

                $token = JWTAuth::fromUser($existingUser);

                $existingUser->access_token = $token;
                $existingUser->token_type = 'bearer';
                $existingUser->expires_in = auth()->factory()->getTTL() * 60;

                return $this->responseMessage(200, true, 'success', $existingUser);

            } else {
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = now();
                $newUser->password = Hash::make($user->email);
                $newUser->save();

                $token = JWTAuth::fromUser($newUser);

                $newUser->access_token = $token;
                $newUser->token_type = 'bearer';
                $newUser->expires_in = auth()->factory()->getTTL() * 60;

                return $this->responseMessage(200, true, 'success', $newUser);
            }
        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:8|confirmed'
        ];

        $validation = validator::make($request->all(), $rules);

        if ($validation->fails())
            return $this->responseMessage(400, false, $validation->messages());


        try {

            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->responseMessage(200, true, 'password updated success');

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function addDailyTracker(Request $request)
    {
        try {

            $rules = [
                'type' => 'required|string|in:morning,evening,after_prayer,charity,quran'
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails())
                return $this->responseMessage(400, false, [$validation->messages(), 'types' => ['morning', 'evening', 'after_prayer', 'charity', 'quran']]);


            DailyTracker::updateorcreate([
                'user_id' => \auth()->user()->id,
                'date' => date('Y-m-d')
            ], [
                $request->type => true
            ]);

            return $this->responseMessage(200, true, 'success');

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

    public function getDailyTracker()
    {
        try {

            $dailyTrackers = \auth()->user()->tracker;
            foreach ($dailyTrackers as $dailyTracker) {
                $count = 0;
                if ($dailyTracker->morning == true)
                    $count += 1;

                if ($dailyTracker->evening == true)
                    $count += 1;

                if ($dailyTracker->after_prayer == true)
                    $count += 1;

                if ($dailyTracker->charity == true)
                    $count += 1;

                if ($dailyTracker->quran == true)
                    $count += 1;

                $dailyTracker->count = $count / 5 * 100;
            }

            return $this->responseMessage(200, true, 'success', $dailyTrackers);


        } catch (\Exception $e) {
            return $this->responseMessage(400, false, 'an error occurred');
        }
    }

}
