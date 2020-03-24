<?php

namespace App\Http\Controllers\Auth;

use App\Mail\verifyEmail;
use App\User;
use App\Http\Controllers\Controller;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|string|size:10|unique:users',
            'profile' => 'required|image',
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
        $role = 'normal';
        $data1 = User::all();
        if (count($data1) == 0)
        {
            $role = 'Admin';
        }
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40),
            'role' => $role,
            'profile' => $data['mobile'],
        ]);
        if($file = request()->hasFile('profile'))
        {
            echo "HELLO";
            request()->file('profile')->storeAs('public/images', $data['mobile'].'.jpg', '');
        }

//        if ($file = request()->hasFile('profile'))
//        {
//            $file->photo->storeAs('images', $data['mobile']);
//        }
        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    public function verifyEmail()
    {
        return view('auth.verifyEmail');
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function emailDone($email, $verify_token)
    {
        $user = User::where(['email' => $email, 'verify_token' => $verify_token])->first();
        if($user)
        {
            User::where(['email' => $email, 'verify_token' => $verify_token])->update(['status' => '1', 'verify_token' => NULL]);
            return redirect(url('/'));
        }
        else
        {
            return 'User not found';
        }
    }
}
