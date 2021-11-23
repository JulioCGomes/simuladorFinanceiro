<?php

namespace App\Http\Controllers\Api;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Api\Traits\RecaptchaTrait;
use App\Models\ReferenceUser;
use App\Models\User;
use App\Http\Helpers\ReferDomainBlock;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Controller login user.
     *
     * @param Request $request
     * @return Json
     */
    public function login(Request $request)
    {
        try {
            /** @var User $user */
            $user = User::where('email', $request->email)->first();

            if (empty($user)) {
                throw new Exception('Unauthorized');
            }

            if (!Hash::check($request->password, $user->password)) {
                throw new Exception('Unauthorized');
            }

            $return = null;
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $return = $user->createToken(env('APP_KEY', uniqid()))->accessToken;
            }

            return response()->json([
                'data' => [
                    'token' => $return,
                    'usuario' => $user,
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
