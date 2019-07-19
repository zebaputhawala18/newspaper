<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required',
            'password'      => 'required',
        ], [
            'email.required'        => 'Email address is required',
            'password.required'     => 'Password name is required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try{
            $isUserVisible = User::where('email',$request->get('email'))
                                   ->where('isVisible','0')
                                   ->where('role','!=','subscriber')
                                   ->first();
            if($isUserVisible === null){
                return redirect()->back()->withErrors([
                    'email'     => 'This Email Address is blocked by Admin.'
                ])->withInput();
            }
            if(Auth::attempt([
                    'email'    => $request->get('email'),
                    'password' => $request->get('password')
                ]) === true){
                return response()->json([
                    'title'         => 'success',
                    'message'       => 'User Logged In Successfully',
                    'type'          => 'SUCCESS',
                    'redirect_url'  => route('admin.dashboard')
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'title'     => 'error',
                'message'   => $e->getMessage(),
                'type'      => 'Error'
            ]);
        }
    }
}
