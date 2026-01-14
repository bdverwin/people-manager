<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use App\Services\AuthServices\AuthManager;

class AuthController extends Controller
{
    protected AuthManager $authManager;

    public function __construct(AuthManager $authManager){
        $this->authManager = $authManager;
    }

    public function showDashboard(){
        if(!Auth::check()){
            return redirect('/login');
        }
        return redirect('/department');
    }

    public function showLogin(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function login(AuthRequest $request){

        $user = $this->authManager->login($request->validated());

        if (! $user) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();

        return redirect('/department');
    }

    public function logout(Request $request){
        $this->authManager->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister(){
        if(Auth::check()){
            return redirect('/department');
        }
        return view('register');
    }

    public function register(AuthRequest $request){
        $this->authManager->register($request->validated());

        return redirect('/department');
    }

}
