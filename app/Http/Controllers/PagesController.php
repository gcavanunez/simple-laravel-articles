<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

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
    public function author()
    {
        $nombreDelAuthor = 'Frank';
        $articles = Article::paginate(3);
        return view('pages.author', ['author' => $nombreDelAuthor, 'articles' => $articles]);
        // return response()->json(["articles" => $articles], 200);
        // view('pages.author', ['author' => $nombreDelAuthor, 'articles' => $articles]);
    }
}