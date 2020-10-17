<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::where('parent_id', 0)->get();
        $allMenus = Menu::pluck('title','id')->all();
        return view('welcome',compact('menus','allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
        ]);
        $addMenu                =   new Menu();
        $addMenu->title         =   $request->title;
        $addMenu->parent_id     =   empty($request->parent_id) ? 0: $request->parent_id;
        if($addMenu->save())
        {
            return back()->with('success', 'Menu added successfully.');
        }
        else
        {
            return back()->with('error', 'Menu can\'t be added.');            
        }
    }
}