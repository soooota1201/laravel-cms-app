<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
      $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        return view('post.index')->with('posts', $post->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image = $request->image->store('posts', 'public');
        $post = Post::create([
          'title' => $request->title,
          'description' => $request->description,
          'content' => $request->content,
          'image' => $image,
          'published_at' => $request->published_at,
          'category_id' => $request->category
        ]);
        if($request->tags)
        {
          $post->tags()->attach($request->tags);
        }

        session()->flash('success', '投稿されました。');

        return redirect(route(('post.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content', 'category']);
        
        if($request->hasFile('image'))
        {
          $image = $request->image->store('posts', 'public');
          $post->deleteImage();
          $data['image'] = $image;
        }
        $post->update($data);
        // タグの更新
        if ($request->tags) {
          $post->tags()->sync($request->tags);
        }
        session()->flash('success', '更新されました。');
        return redirect(route(('post.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::withTrashed()->where('id', $id)->firstOrFail();
      if($post->trashed()){
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', '削除しました。');
      }else{
        $post->delete();
        session()->flash('success', 'ゴミ箱へ捨てました。');
      }
      return redirect(route(('post.index')));
    }

  /**
   * destroyメソッドに処理をかく
   * ORMを利用しても、deleteの処理以外の処理も書いても良い
   */

    public function trashed() {
      $trashed = Post::onlyTrashed()->get();
      return view('post.index')->with('posts', $trashed);
    }
    
    public function restore($id) {
      $post = Post::withTrashed()->where('id', $id)->firstOrFail();
      $post->restore();
      session()->flash('success', '復元されました。');
      return redirect(route(('post.index')));
    }


}
