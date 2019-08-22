<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'NucliuzMVC';
        $data['description'] = 'Simple social network built on the NucliuzMVC PHP framework';
        return view('pages.index', $data);
    }
    public function about()
    {
        $data = array();
        $data['title'] = 'About Us';
        $data['description'] = 'This simple laravel app is the way we upgraded from the NucliuzMVC';
        return view('pages.about', $data);
    }
}