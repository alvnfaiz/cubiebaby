<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    //
    public function loginForm()
    {
        $category = Category::all();
        return view('auth.login', compact('category'));
    }

    public function authenticated(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $id = Auth::user()->id;
            $userAct = UserActivity::where('user_id', $id)->first();
            if($userAct == null){
                UserActivity::create([
                    'user_id' => $id,
                    'last_login' => now(),
                    'login_count' => 1,
                    'order_count' => 0,
                ]);
            }

            //if cache cart exist, insert product to cart
            if(Cache::has('cart'.$id)){
                $cart = Cache::get('cart'.$id);
                foreach($cart as $key => $value){
                    $cart[$key]['user_id'] = $id;
                }
                Cart::insert($cart);
                Cache::forget('cart'.$id);
            }


            if($userAct != null){
                UserActivity::where('user_id', $id)
                ->update([
                    'last_login' => now(),
                    'login_count' => UserActivity::where('user_id', $id)->value('login_count') + 1,
                ]);
            }     
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    public function registerForm(){
        $category = Category::all();
        return view('auth.register', compact('category'));
    }



    public function register(Request $request){
        //validate
        $request->validate([
            'username' => 'required|min:6|max:255|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'phone_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'nullable',
        ]);

        //create user
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);
        

        return redirect()->route('login');
    }

    public function forgetPasswordForm(){
        return view('Auth.forget-password');
    }

    public function forgetPassword(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
