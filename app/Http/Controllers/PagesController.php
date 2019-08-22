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
}