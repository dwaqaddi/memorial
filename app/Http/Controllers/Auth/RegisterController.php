<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use App\User;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'userEmail' => 'required|string|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'userEmail' => $data['userEmail'], 
            'password' => bcrypt($data['password']),
            'userFName' => $data['userFName'], 
            'userMName' => $data['userMName'],
            'userLName' => $data['userLName'],
            'userMobileNumber' => $data['userMobileNumber'],
            'userAddress1' => $data['userAddress1'],
            'userAddress2' => $data['userAddress2'],
        ]);
    }

    public function register(Request $request)
    {
        // Here the request is validated. The validator method is located
        // inside the RegisterController, and makes sure the name, email
        // password and password_confirmation fields are required.
        $this->validator($request->all())->validate();

        // After the user is created, he's logged in.
        $user = $this->create($request->all());
        $this->guard()->login($user);

        // A Registered event is created and will trigger any relevant
        // observers, such as sending a confirmation email or any 
        // code that needs to be run as soon as the user is created.

        // event(new Registered($user = $this->create($request->all())));
        Mail::to($user->userEmail)->send(new VerifyMail($user));

        // And finally this is the hook that we want. If there is no
        // registered() method or it returns null, redirect him to
        // some other URL. In our case, we just need to implement
        // that method to return the correct response.
        return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json($user, 201);
    }
}
