<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class WelcomeController extends Controller
{
  // public function search()
  // {
  //   return view('welcome')
  //     ->with('posts', Post::searched())
  //     ->with('categories', Category::all())
  //     ->with('tags', Tag::all());
  // }

  public function index() {
    return view('welcome')
    ->with('categories', Category::all())
    ->with('tags', Tag::all())
    ->with('posts', Post::searched()->simplePaginate(1));
  }
}
