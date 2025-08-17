<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{


    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function checkRole(){
        return redirect()->route('admin.leads.list');

        // if (Auth::check()) {
        //     if (Auth::user()->role == "admin") {

        //         return redirect()->route('admin.leads.list');
        //     } else {

        //         return redirect()->route('profile.edit');
        //     }
        // } else {

        //     return redirect()->route('login');
        // }

    }

}
