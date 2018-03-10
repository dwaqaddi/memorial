<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyMail;
 
class UserController extends Controller
{
    public function index()
    {

        return User::all();
    }

    public function showId(String $userId)
    {
        $user = User::where('userId', $userId)->first();
        return response()->json($user, 201);
    }

    public function showEmail(String $userEmail)
    {
        $user = User::where('userEmail', $userEmail)->first();
        return response()->json($user, 201);
    }

    public function resetPassword(String $userEmail)
    {

        $random_str = str_random(8);
        $generatedPassword = bcrypt($random_str);

        $user = User::where('userEmail', $userEmail)->first();
        $user->password = $generatedPassword;
        $user->save();

        Mail::to($user->userEmail)->send(new ResetPasswordMail($user, $random_str));

        return response()->json($user, 201);
    }

    public function resendVerifyEmail(String $userEmail){

        $user = User::where('userEmail', $userEmail)->first();
        Mail::to($user->userEmail)->send(new VerifyMail($user));

        return response()->json($user, 201);

    }

    public function store(Request $request)
    {
        // not in use
        // uses RegisterController instead
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, String $userId)
    {
        $user = User::where('userId', $userId)->first();

        if ($request->has('password')) {
            // change password
            $user = User::where('userId', $userId)->first();
            $user->password = bcrypt($request->password);
            $user->save();
        }else if (! $request->has('password')){
            // update account info without password change
            // password change uses different method in app
            $user->update($request->all());
        }

        return response()->json($user, 200);
    }

    public function delete(String $userId)
    {
        //// uses different code for delete
        //// delete code is change userIsActive = 1

        // $user->delete();
        // return response()->json(null, 204);

        $user = User::where('userId', $userId)->first();
        $user->userIsActive = 1;
        $user->save();

        return response()->json($user, 201);
    }

    public function verify($userId)
    {
        $user = User::where('userId', $userId)->first();
        $user->userIsUserVerified = 1;
        $user->save();

        return response()->json($user, 201);
    }










}