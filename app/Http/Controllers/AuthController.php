<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $me = auth()->user();            
            return response()->json([
                'data' => $this->getPassportTokens($credentials),
                'status' => 'success',
                'message' => 'Success loggedin'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Wrong credentials'
        ]);
    }

    protected function getPassportTokens(array $data)
    {
        $client = new Client;               
        $passwordParams = [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('auth.passport.client_id'),
                'client_secret' => config('auth.passport.client_secret'),
                'username' => array_get($data, 'email'),
                'password' => array_get($data, 'password'),
                'scope' => '*',
            ],
            'http_errors' => false,
        ];

        $response = $client->post(url('oauth/token'), $passwordParams);        
        $result = json_decode($response->getBody()->getContents());

        if (empty($result->access_token)) {
            return false;
        }

        return $result;
    }
}
