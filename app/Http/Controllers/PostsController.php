<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    public function show($id)
    {
      return view('blog.show')
      ->with('post', Post::find($id));
    }

    public function category($id)
    {
      return view('blog.category')
      ->with('categories', Category::all())
      ->with('posts', Category::find($id)->post()->searched()->simplePaginate(1))
      ->with('tags', Tag::all());
    }
    
    public function tag($id)
    {
      return view('blog.tag')
      ->with('tags', Tag::all())
      ->with('posts', Tag::find($id)->post()->searched()->simplePaginate(1))
      ->with('categories', Category::all());
    }
}
