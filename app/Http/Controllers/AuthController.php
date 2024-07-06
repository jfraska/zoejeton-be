<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param string $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider): JsonResponse
    {
        $validated = $this->validateProvider($provider);
        if ($validated !== null) {
            return $validated;
        }

        $redirectUrl = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $redirectUrl]);
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param string $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider): JsonResponse
    {
        $validated = $this->validateProvider($provider);
        if ($validated !== null) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail() ?? $user->getNickname()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }

    /**
     * Validate the provider.
     *
     * @param string $provider
     * @return JsonResponse|null
     */
    protected function validateProvider($provider): ?JsonResponse
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
        return null;
    }
}
