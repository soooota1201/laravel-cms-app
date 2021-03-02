@extends('layouts.app')

@section('content')
<div class="text-right mb-3">
  <a href="{{route('post.create')}}" class="btn btn-success btn-sm">
    {{-- {{isset($categories)}} --}}
    Add Post</a>
</div>
<div class="card">
    <div class="card-header">Post</div>
    <div class="card-body">
        <table class="table">
          <tbody>
            @foreach ($posts as $post)
            @if ($post)
            <tr>
              <td><img width="100px" height="60px" src="{{asset('storage/' . $post->image)}}" alt=""></td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->category->name }}</td>
              <td>tag</td>
              <td>
                  @if ($post->trashed())
                <form action="{{route('restore-posts', $post->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-danger btn-sm">
                    Restore
                  </button>
                </form>
                @else 
                <a href="{{route('post.edit', $post->id)}}" class="btn btn-success btn-sm">Edit</a>
                @endif
              </td>
              <td>
                {{-- <a href="{{route('post.trashed', $post->id)}}" type="button" class="btn btn-danger btn-sm">
                  Trash
                </a> --}}

                <form action="{{route('post.destroy', $post->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">
                    {{ $post->trashed()? 'Delete' : 'Trash'}}
                  </button>
                </form>
              </td>
            </tr>
            @else
              まだ投稿されていません。
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection

@section('css')
    
@endsection

@section('js')

@endsection