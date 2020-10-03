<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate(
            [
                'email' => 'required|string',
                'password' => 'required|string'
            ]
        );

        /**
         *  client_id and client_secret should be in the payload when mobile applications started to use.
         */
        if (Auth::attempt($login)) {
            $http = new Client();
            $response = $http->post(config('app.url') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('app.oauth_client_id'),
                    'client_secret' => config('app.oauth_secret'),
                    'username' => $request->input('email'),
                    'password' => $request->input('password'),
                    'scope' => '',
                ],
            ]);

            $result = json_decode((string) $response->getBody(), true);
        } else {
            $result = response()->json(
                [
                    'errors' => [
                        'status' => '422',
                        'details' => 'Invalid login credential!'
                    ]
                ],
                401
            );
        }

        return $result;
    }
}
