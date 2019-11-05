<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Auth\AuthenticationResource;


class PassportController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());

        $user->assignRoles('customer');

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $token = Auth::user()->createToken('RestAuthApi')->accessToken;

            return $this->respondWithToken($token);
        } else {

            return response()->json([
                'status'    => 2,
                'cod'       => Response::HTTP_UNAUTHORIZED,
                'lnag'      => str_replace('_', '-', app()->getLocale()),
                'error'     => __('Bad credentials...')
            ], Response::HTTP_UNAUTHORIZED);
            
        } 
    }

    //login user
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $token = Auth::user()->createToken('RestAuthApi')->accessToken;
            
            return $this->respondWithToken($token);

        } else {

            return response()->json([
                'status'    => 2,
                'cod'       => Response::HTTP_UNAUTHORIZED,
                'lnag'      => str_replace('_', '-', app()->getLocale()),
                'error'     => __('Bad credentials...')
            ], Response::HTTP_UNAUTHORIZED);

        }

    }

    //detail auth user
    public function details()
    {
        if (Auth::check()) {
            return response()->json([
                'status'    => 1,
                'cod'       => Response::HTTP_OK,
                'lnag'      => str_replace('_', '-', app()->getLocale()),
                'user'      => new AuthenticationResource(Auth::user())
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status'    => 2,
            'cod'       => Response::HTTP_UNAUTHORIZED,
            'lnag'      => str_replace('_', '-', app()->getLocale()),
            'error'     => __('There is no authenticated user')
        ], Response::HTTP_UNAUTHORIZED);
    }


    //logout user
    public function logout()
    {

        if (Auth::check()) {

            Auth::user()->token()->revoke();

            return response()->json([
                'status'    => 1,
                'cod'       => Response::HTTP_OK,
                'lnag'      => str_replace('_', '-', app()->getLocale()),
                'message'   => __('logout_success')
            ], Response::HTTP_OK); 
        }

        return response()->json([
            'status'    => 2,
            'cod'       => Response::HTTP_INTERNAL_SERVER_ERRO,
            'lnag'      => str_replace('_', '-', app()->getLocale()),
            'error'     =>'api.something_went_wrong'
        ], Response::HTTP_INTERNAL_SERVER_ERRO);

    }

    //return response if user auth success and tokens.
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'        => 1,
            'cod'           => Response::HTTP_OK,
            'lnag'          => str_replace('_', '-', app()->getLocale()),
            'message'       => __('Correct income...'),
            'user'          => new AuthenticationResource(Auth::user()),
            'token_type'    => 'Bearer',
            'token'         => $token,
        ], Response::HTTP_OK);
    }
}
