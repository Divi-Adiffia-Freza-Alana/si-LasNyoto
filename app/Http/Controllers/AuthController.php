<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    //
    public function index(){

        return view('login');

    }

    public function registration()
    {
        return view('registration');
    }

    public function createregistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

   


        if($request->password == $request->confirmpassword){

            //dd($request->all());

                $user =User::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'konsumen',
              ]);

                $user->assignRole('konsumen');
                
                Session::flash('status', 'success');
                Session::flash('message', 'Registrasi Berhasil Silahkan Login');
              
    }else{
             
        Session::flash('status', 'fail');
        Session::flash('message', 'Registrasi Gagal Silahkan Coba Kembali');


       

    }

    return redirect("/login");

   
}

/*public function create(array $data)
{
  return Users::create([
    'id' => Str::uuid(),
    'name' => $data['name'],
    'email' => $data['email'],
    'password' => Hash::make($data['password'])
  ]);
}    */


    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            Session::flash('status', 'success');
            Session::flash('message', 'Login Berhasil');

            if(auth()->user()->hasRole('konsumen')){
                return redirect('/transaksi');

            } 
 
            return redirect()->intended('/');
        }


 
       /* return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');*/

        Session::flash('status', 'fail');
        Session::flash('message', 'Login Gagal');

        return redirect('/login');

    }



    public function logout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');

    }

    
    



}
