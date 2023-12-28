<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(session()->has('ADMIN_ID'))
        {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }
    public function pass(){

        $hash = Hash::make('029160');
        return $hash;
    }
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $result = Admin::where(['email'=>$email])->first();
        if($result)
        {
            if(Hash::check($password,$result->password))
            {
                $request->session()->put('ADMIN_ID',$result->id);
                $request->session()->put('ADMIN_STATUS', true);
                return redirect('/admin/dashboard');
            }
            else
            {
                $request->session()->flash('error','Please Enter Correct Password');
                return redirect('/admin');
            }
        }
        else
        {
            $request->session()->flash('error','Please Enter Correct Email');
            return redirect('/admin');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        session()->forget('ADMIN_ID');
        session()->forget('ADMIN_STATUS');
        session()->flash('error','Logged Out Successfully');
        return redirect('/admin');
    }
}
