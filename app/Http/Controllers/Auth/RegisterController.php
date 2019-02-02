<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users',
            'phone' => 'required|regex:/^[0-9]+$/|min:10|max:13|unique:users',
            'license_number' => 'required|string|max:30',
            'password' => 'required|confirmed|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#!@$&]).{6,}+$/|min:6',
            'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:2048',
        ], [
        'first_name.required' => 'First name is required',
        'last_name.required'  => 'Last name is required',
        'email.required' => 'Email is required',
        'phone.required'  => 'Phone number is required',
        'license_number.required' => 'License Number is required',
        'password.required' => 'Password is required',
        'password.confirmed' => 'Passwords should match',
        'password.regex' => 'Password should contain one capital and one small letter, one number, one special character(&#33;,&#64;,&#35;,&#36;,&amp;)',
        'image.mimes' => 'Image should be JPEG or JPG or PNG and size should be max 2MB',
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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'license_number' => $data['license_number'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
