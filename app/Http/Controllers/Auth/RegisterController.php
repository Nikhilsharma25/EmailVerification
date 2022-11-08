<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Mail\Registermail;
use Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    // protected $redirectTo ='/login';


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
            'name' => ['required', 'string', 'max:255'],
            // 'lastname' => ['required', 'string', 'max:255'],
            // 'phone'=>['required', 'string', 'max:10'],       
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

            $n=50;
            function getName($n) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
            }

            return $randomString;
            }

            // echo getName($n);
            // dd(getName($n));

            $data['token'] = getName($n);
           Mail::to('nikhilsharma28122000@gmail.com')->send(new Registermail($data));


        return User::create([
            'name' => $data['name'],
            'lastname'=>$data['lastname'],
            'phone'=>$data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verifytoken'=>$data['token'],
        ]);


    }

    public function EmailVerify($token){

        $user = User::where('verifytoken',$token)->update(['status'=>1]);
        return redirect('login');
    }

  public function register(Request $request)
    {
     
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));


        return $this->registered($request, $user)
                        ?: redirect('/login')->with('status','We sent activation link, Check your email and click on the link to verify your email');

}

   
}
