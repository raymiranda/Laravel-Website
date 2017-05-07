<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Redirect;
use Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\users;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
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
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
           'upload'         => 'required',
           'captcha'        => 'required|min:1'
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
                'upload.required'         => 'Company invoice is required',
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
       return User::create([
           'firstName' => $data['first_name'],
           'lastName' => $data['last_name'],
           'email' => $data['email'],
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
   }

   public function store(Request $request)
   {
        //***Collect and insert info into database***
        $user = new users;
        $user->firstName = Input::get("first_name");
        $user->lastName = Input::get("last_name");
        $user->email = Input::get("email");
        $user->address1 = Input::get("address1");
        $user->address2 = Input::get("address2");
        $user->city = Input::get("city");
        $user->state = Input::get("state");
        $user->zip = Input::get("zip");
        $user->phone = Input::get("phone");
        $user->companyName = Input::get("companyName");
        $user->companyAddress = Input::get("companyAddress");
        $user->companyCity = Input::get("companyCity");
        $user->companyState = Input::get("companyState");
        $user->companyZip = Input::get("companyZip");
        $user->companyPhone = Input::get("companyPhone");
        $user->save();

        //***Save file***
        // getting all of the post data
        $file = Input::get('upload');
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return 'The file submission is required!';
        }
        else {
            // checking file is valid.
            if (Input::file('upload')->isValid()) {
                $destinationPath = 'C:\wamp64\www\intern-project\resources\uploads'; // upload path
                $extension = Input::file('upload')->getClientOriginalExtension(); // getting image extension
                $fileName = Input::get("companyName").'.'.$extension; // renameing image
                Input::file('upload')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully'); 
                return Redirect::to('newUser');
            }
            else {
                // sending back with error message.
                Session::flash('error', 'Uploaded file is not valid');
                return 'The pdf failed to upload!';
            }
        }

        return redirect()->route('newUser');   
    }
}
