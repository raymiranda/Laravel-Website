<?php

namespace App\Http\Controllers\Auth;

use Input;
use Validator;
use Redirect;
use Request;
use Session;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class FormController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

   /**
    * Create a new authentication controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware('guest', ['except' => 'getLogout']);
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
       $data['captcha'] = $this->captchaCheck();

       $validator = Validator::make($data,
            [
           'first_name'     => 'required|max:255',
           'last_name'      => 'required|max:255',
           'address1'       => 'required|max:255',
           'address2'       => 'max:255',
           'city'           => 'required|max:255',
           'state'          => 'required|max:255',
           'zip'            => 'required|max:5',
           'phone'          => 'required|max:10',
           'email'          => 'required|email|max:255|unique:users',
           'companyName'    => 'required|max:255',
           'companyAddress' => 'required|max:255',
           'companyCity'    => 'required|max:255',
           'companyState'   => 'required|max:255',
           'companyZip'     => 'required|max:5',
           'companyPhone'   => 'required|max:7',
           'captcha'        => 'required|min:1',
            ],
            [
                'first_name.required'     => 'First name is required',
                'last_name.required'      => 'Last name is required',
                'address1.required'       => 'A primary address is required',
                'city.required'           => 'City is required',
                'state.required'          => 'State is required',
                'zip.required'            => 'Zip is required',
                'phone.required'          => 'Contact phone number is required',
                'email.required'          => 'Email is required',
                'email.email'             => 'Email is invalid',
                'companyName.required'    => 'Company name is required',
                'companyAddress.required' => 'Company address is required',
                'companyCity.required'    => 'Company city is required',
                'companyState.required'   => 'Company state is required',
                'companyZip.required'     => 'Company zip is required',
                'companyPhone.required'   => 'Company phone number is required',
                'captcha.min'             => 'Wrong captcha, please try again.'
            ]
        );

        return $validator;
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
   protected function create(array $data)
   {
       $user = User::create([
           'firstName' => $data['first_name'],
           'lastName' => $data['first_name'],
           'email' => $data['email'],
           'password' => bcrypt($data['password']),
           'address1' => $data['address1'],
           'address2' => $data['address2'],
           'city' => $data['city'],
           'state' => $data['state'],
           'zip' => $data['zip'],
           'phone' => $data['phone'],
           'companyName' => $data['companyName'],
           'companyAddress' => $data['companyAddress'],
           'companyCity' => $data['companyCity'],
           'companyState' => $data['companyState'],
           'companyZip' => $data['companyZip'],
           'companyPhone' => $data['companyPhone']
       ]);
       $user = new \App\User(); 
       $user->create($request); 
       DB::table('users')->insert($user);
       return $user;
   }
}
