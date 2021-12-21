<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Helpers\Fungsi;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $User;

    public function __construct(Request $request, User $user)
    {
        $this->User = $user;
    }

    public function register(Request $request)
    {
    	try {
    		$this->validate($request, [
                'nik' => 'required|string|min:16|max:16|unique:users,nik',
                'role_id' => 'required|exists:roles,id',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $data = array(
                'nik' => $request->nik,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            );

            $user = User::create($data);

            $token = JWTAuth::fromUser($user);

	    	return response()->json(
                Fungsi::resOK(array(
                    'message' => 'Register user successful',
                    'token' => $token
                ))
            , 200);
	    } catch (\Illuminate\Validation\ValidationException $e ) {
            return response()->json(
                Fungsi::resErrorValidation($e)
            , $e->status);
        } catch (\Exception $e){
            return response()->json(
                Fungsi::resError($e->getMessage())
            , 422);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'nik' => 'required|string|min:16|max:16',
            'password' => 'required|string|min:6',
        ]);

        try {
            $getUser = User::where('nik', $request->nik);

            if ($getUser->count() == 0) {
                return response()->json(
                    Fungsi::resError('User not found', 422)
                , 422);
            }

            $credentials = $request->only('nik', 'password');

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    Fungsi::resError('Invalid password', 422)
                , 422);
            }

            return response()->json(
                Fungsi::resOK(array(
                    'message' => 'Login successful',
                    'token' => $token
                ))
            , 200);
        } catch (JWTException $e) {
            return response()->json(
                Fungsi::resError('Could not create token.')
            , 422);
        } catch (\Illuminate\Validation\ValidationException $e ) {
            return response()->json(
                Fungsi::resErrorValidation($e)
            , $e->status);
        } catch (\Exception $e){
            return response()->json(
                Fungsi::resError($e->getMessage())
            , 422);
        }
    }

    public function getUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(
                    Fungsi::resError('User not found.')
                , 422);
            }

            $token = JWTAuth::fromUser($user);

            $getData = User::with('role')
                ->where('id', $user->id)
                ->firstOrFail();

            $data = array(
                'nik' => $getData->nik,
                'role' => $getData->role->role,
                'jwt' => $token
            );

            return response()->json(
                Fungsi::resOK($data)
            , 200);
        } catch (\Exception $e){
            $message = $e->getMessage();
        }

        return response()->json(
            Fungsi::resError($message)
        , 422);
    }

    public function logout() {
        try {
            auth()->logout();

            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(
                Fungsi::resOK('User successfully signed out')
            , 200);
        } catch (\Exception $e){
            $message = $e->getMessage();
        }

        return response()->json(
            Fungsi::resError($message)
        , 422);
    }
}