<?php
/**
 * Created by PhpStorm.
 * User: Aiden
 * Date: 2017/2/8
 * Time: 17:27
 */

namespace App\Api\Controllers;

use App\Exceptions\ApplicationException;
use App\models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                throw new ApplicationException(40002);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            throw new ApplicationException(50001);
        }

        // all good so return the token
        return $this->responseData([
            'token' => $token
        ]);
    }

    public function signup(Request $request)
    {
        $newUser = [
            'user_email' => $request->get('user_email'),
            'name' => $request->get('name'),
            'user_password' => bcrypt($request->get('user_password'))
        ];
        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);

        return $this->responseData([
            'token' => $token
        ]);
    }
}
