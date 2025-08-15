<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactUs;
use Laracasts\Flash\Flash;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{


    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function checkRole(){
        if (Auth::check()) {
            if (Auth::user()->role == "admin" || Auth::user()->role == "agent") {

                return redirect()->route('admin.leads.list');
            } else {

                return redirect()->route('profile.edit');
            }
        } else {

            return redirect()->route('login');
        }

    }

}
