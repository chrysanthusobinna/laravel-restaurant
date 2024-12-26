<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class CartController extends Controller
{
    use AdminViewSharedDataTrait;
    use CartTrait;


    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    
    public function index()
    {
        $menus = Menu::all();
        return view('admin.pos-index',compact('menus'));
    } 

}
