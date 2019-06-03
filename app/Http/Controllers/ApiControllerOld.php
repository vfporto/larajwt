<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Area;
use Illuminate\Support\Facades\Hash;

class ApiControllerOld extends Controller
{
    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        /*$user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);*/


        $user->nome = $request->nome;
        $user->login = $request->login;
        $user->matricula = $request->matricula;
        $user->email = $request->email;
        $user->senha = bcrypt($request->senha);
        $user->area = Area::find($request->area_id);


        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(/*Request $request*/)
    {
        /*//$input = $request->only('name', 'password');
        $input = $request->only('login', 'senha');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Login ou senha invalido(s)',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);*/

        //$credentials = $request->only('login', 'senha');
        $credentials = request(['login', 'senha']);

        $user = User::where('login', $credentials['login'])->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid user'], 401);
        }


        // Validate Password
        if (!Hash::check($credentials['senha'], $user->senha)) {
            return response()->json([
                'error' => 'Senha invalida'/*,
                'hash1' => Hash::make($credentials['senha']),
                'hash2' => Hash::make($user->senha),

            */], 401);
        }
        // Generate Token
        $token = JWTAuth::fromUser($user);

        // Get expiration time
        $objectToken = JWTAuth::setToken($token);
        //$expiration = JWTAuth::decode($objectToken->getToken())->get('exp');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'//,
            //'expires_in' => JWTAuth::decode()->get('exp')
        ]);



    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
