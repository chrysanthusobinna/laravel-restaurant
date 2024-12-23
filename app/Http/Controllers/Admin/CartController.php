<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\CartTrait;

class CartController extends Controller
{
    
    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }
    
 
    public function index()
    {
        $menus = Menu::all();
        return view('admin.pos-index',compact('menus'));
    } 


 

    use CartTrait;



    
}
