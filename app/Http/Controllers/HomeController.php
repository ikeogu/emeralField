<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('students/biodata');
    }
    // public function index()
    // {
    //     if(Auth::check()){
    //         if(Auth::user()->isAdmin == 1) {
                
    //           return redirect(route('admin'));
    //         }
    //         elseif(Auth::user()->isAdmin == 3){
    //             $acct = Account::find(Auth::user()->account_id);
    //             return view('success',['acct'=>$acct]);
    //         }else{
    //            return redirect(route('login'));
    //         } 
    //     }
    // }
}
