<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 17:27
 */

namespace App\Api\Controllers;

use App\models\User;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends BaseController
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
//        $credentials = $request->only('email', 'password');
        $credentials = [
            'user_email' => $request->get('user_email'),
            'password' => $request->get('user_password')
        ];
        $customClaims = ['foo' => 'bar', 'baz' => 'bob'];

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials, $customClaims)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $newUser = [
            'user_email' => $request->get('user_email'),
            'name' => $request->get('name'),
            'user_password' => bcrypt($request->get('user_password'))
        ];
        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
