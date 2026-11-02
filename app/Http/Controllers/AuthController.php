<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function verify(UserAuthRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        // Bersihkan session intended dan guard lama agar tidak konflik antar-role
        $request->session()->forget('url.intended');
        Auth::guard('admin')->logout();
        Auth::guard('kasir')->logout();
        Auth::guard('pimpinan')->logout();
        Auth::guard('pelanggan')->logout();

        if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'role'=>'admin'])){
            $request->session()->regenerate();
            return redirect('/admin/home');
        }else if (Auth::guard('kasir')->attempt(['email'=>$data['email'],'password'=>$data['password'],'role'=>'kasir'])){
            $request->session()->regenerate();
            return redirect('/kasir/home');
        }else if (Auth::guard('pimpinan')->attempt(['email'=>$data['email'],'password'=>$data['password'],'role'=>'pimpinan'])){
            $request->session()->regenerate();
            return redirect('/pimpinan/home');
        }else if (Auth::guard('pelanggan')->attempt(['email'=>$data['email'],'password'=>$data['password'],'role'=>'pelanggan'])){
            $request->session()->regenerate();
            return redirect('/pelanggan/dashboard');
        }else{
            return redirect(route('login'))->with('error','email dan password salah');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        Auth::guard('kasir')->logout();
        Auth::guard('pimpinan')->logout();
        Auth::guard('pelanggan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}

