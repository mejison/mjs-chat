<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use App\Http\Requests\Auth\Register as RegisterRequest;

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

    public function register(RegisterRequest $request) {
        $data =  $request->only(['name', 'password_confirmation', 'email', 'password']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $credentials = ['email' => $user->email, 'password' => $data['password']];
        
        return response()->json([
            'data' => $this->getPassportTokens($credentials),
            'status' => 'success',
            'message' => 'Success loggedin'
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
