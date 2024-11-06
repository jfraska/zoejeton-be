<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\SocialAccountsService;
use Exception;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public const PROVIDERS = ['github', 'google'];

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->respondWithMessage('User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token =  $user->createToken(env('API_AUTH_TOKEN_PASSPORT'))->accessToken;
            return $this->respondWithToken($token);
        } else {
            return $this->sendError(self::UNAUTHORIZED, null, ['error' => 'Unauthorised']);
        }
    }

    /**
     * Session api
     *
     * @return \Illuminate\Http\Response
     */
    public function session(Request $request)
    {
        $user = Auth::user()->load('linkedSocialAccounts');
        return $this->sendResponse(['user' => $user], 'succes');
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return $this->respondWithMessage('Logout successfully.');
    }

    private function respondWithToken($token)
    {
        $success['token'] =  $token;
        $success['access_type'] = 'bearer';
        $success['expires_in'] = now()->addDays(1);

        return $this->sendResponse($success, 'Login successfully.');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, self::PROVIDERS)) {
            return $this->sendError(self::NOT_FOUND);
        }

        $state = request()->input('state');

        $success['provider_redirect'] = Socialite::driver($provider)->stateless()->with(['state' => $state])->redirect()->getTargetUrl();

        return $this->sendResponse($success, "Provider '" . $provider . "' redirect url.");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, self::PROVIDERS)) {
            return $this->sendError(self::NOT_FOUND);
        }

        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();

            if ($providerUser) {
                $user = (new SocialAccountsService())->findOrCreate($providerUser, $provider);

                $token = $user->createToken(env('API_AUTH_TOKEN_PASSPORT_SOCIAL'))->accessToken;

                $state = request()->input('state');

                if ($state === 'mobile') {
                    return redirect('http://zoejeton.com?access_token=' . $token);
                }

                return redirect('http://' . $state . '.localhost:3000/api/auth/callback?access_token=' . $token);
            }
        } catch (Exception $e) {
            return $this->sendError(self::UNAUTHORIZED, null, ['error' => $e->getMessage()]);
        }
    }
}
