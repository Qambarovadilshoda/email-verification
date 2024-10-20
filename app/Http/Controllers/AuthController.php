<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerifyRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\SendSmsToMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }
    public function handleRegister(RegisterRequest $request)
    {
        $avatar = $request->file('avatar');
        $fileName = time() . '.' . $avatar->getClientOriginalExtension();
        $uploadedAvatar = $avatar->storeAs('images', $fileName, 'public');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->verification_token = uniqid();
        $user->password = bcrypt($request->password);
        $user->avatar = $uploadedAvatar;
        $user->save();

        Mail::to($user->email)->send(new SendSmsToMail($user));

        return redirect()->route('verifyForm');
    }
    public function loginForm()
    {
        return view('auth.login');
    }
    public function handleLogin(LoginRequest $request) {

        $user = User::where('email', $request->email)->first();
        if(Hash::check($request->password, $user->password)){
            if($user->email_verified_at !== null) {
                Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                return redirect()->route('loginForm');
            }else{
                abort(404);
            }
        }
        return redirect()->back();
    }
    public function logout()  {
        Auth::logout();
        return redirect()->route('loginForm');
    }
    public function editProfile()  {

        return view('auth.edit');
    }
    public function updateProfile(UpdateProfileRequest $request, $id) {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                @unlink(storage_path('app/public/' . $user->avatar));
            }

            $avatar = $request->file('avatar');
            $fileName = time() . '.' . $avatar->getClientOriginalExtension();
            $user->avatar = $avatar->storeAs('images', $fileName, 'public');
        }
        $user->save();
        return redirect()->route('dashboard');

    }

    public function dashboard(){
        return view('auth.dashboard');
    }

    public function handleVerify(EmailVerifyRequest $request) {
        $user = User::where('verification_token', $request->verify_token)->first();
        if(!$user ||  $user->verification_token !== $request->verify_token ) {
            return redirect()->back();
        }
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('loginForm');
    }
}
