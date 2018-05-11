<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'username' => 'required|max:255',
            'password' => 'required|min:4'
        ]);
        $username = $request['username'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
        
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;
        
        $user->save();
        
        Auth::login($user);
        
        return redirect()->route('dashboard');
    }
    public function postSignIn(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'],'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }
    
    public function getLogout() 
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
