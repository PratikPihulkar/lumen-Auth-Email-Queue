<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }


    public function register(Request $req)
    {
        $this->validate($req, [
            'email' => 'email|required',
            'password' => 'required|confirmed'
        ]);

        $email = $req->input('email');
        $password  = Hash::make($req->input('password'));

        User::create(['email'=>$email, 'password'=>$password]);

        return response()->json(['status'=>'success', 'operation'=>'created']);
    }

    public function chechMe(Request $req)
    {
        return response()->json(auth()->user());
    }
    
    

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            // Attempt to verify the credentials and create a token for the user
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500);

        }

        // Return the token if no error
        return response()->json(compact('token'));
    }
}
