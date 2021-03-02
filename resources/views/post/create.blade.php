@extends('layouts.app')

@section('content')
@include('partials.error')
<div class="card">
    <div class="card-header">Post</div>
    <div class="card-body">
        <form action={{ isset($post) ? route('post.update', $post->id) : route('post.store')}} method="POST" enctype="multipart/form-data">
          @csrf
          @if(isset($post)) 
            @method('PUT')
          @endif
          <div class="form-group">
            <label for="title">Title</label>
            <input id="title" class="form-control" type="text" name="title" value="{{isset($post) ? $post->title : ''}}">
          </div><!-- /.form-control -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{isset($post) ? $post->description : ''}}</textarea>
          </div><!-- /.form-control -->
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{isset($post) ? $post->content : ''}}</textarea>
          </div><!-- /.form-control -->
          @if (isset($post))
            <div class="form-group">
              <img src="{{asset('storage/' . $post->image)}}" alt="">
            </div><!-- /.form-group -->
            @endif
          <div class="form-group mt-4">
            <label for="image">Image</label>
            <input class="form-control" type="file" id="image" name="image">
          </div><!-- /.form-control -->
          <div class="form-group">
            <label for="published_at">Published_at</label>
            <input class="form-control" type="text" id="published_at" name="published_at" value="{{isset($post) ? $post->published_at : ''}}">
          </div><!-- /.form-control -->
          {{-- <input class="form-control" type="text" id="published_at" name="published_at" value="{{isset($post) ? $post->published_at : ''}}"> --}}
          <div class="form-group">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category">
              @foreach ($categories as $category)
              <option value="{{$category->id}}"
                @if (isset($post))
                    @if($category->id === $post->category_id)
                      selected
                    @endif
                @endif
                >
                {{$category->name}}
              </option>
              @endforeach
            </select>
          </div><!-- /.form-control -->
          @if ($tags->count() > 0)
          <div class="form-group">
            <label for="tag">tag</label>
            <select name="tags[]" class="form-control" id="tag" multiple>
              @foreach ($tags as $tag)
              <option value="{{$tag->id}}"
                @if (isset($post))
                    @if($post->hasTag($tag->id))
                      selected
                    @endif
                @endif
                >
                {{$tag->name}}
              </option>
              @endforeach
            </select>
          </div><!-- /.form-control -->
          @endif

          <button type="submit" class="btn btn-success btn-sm">submit</button><!-- /.btn btn-success btn-sm -->
        </form>
    </div>
</div>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script>
      flatpickr('#published_at', {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
      });
    </script>
@endsection

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection