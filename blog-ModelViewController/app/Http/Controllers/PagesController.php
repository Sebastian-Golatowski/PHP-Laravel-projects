<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to Laravel";
        // return view('pages.index',compact('title'));
        return view('pages.index')->with('key',$title);
    }
    
    public function about(){
        $title = "About";
        return view('pages.about')->with('key',$title);;
    }

    public function services(){
        $data = array (
            'key' => 'Services',
            'services' => ['Web Design', "Programing","SEO"]
        );
        return view('pages.services')->with($data);;
    }
}
