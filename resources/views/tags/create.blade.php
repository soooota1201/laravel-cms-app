@extends('layouts.app')

@section('content')
@include('partials.error')
<div class="card">
    <div class="card-header">tag</div>
    <div class="card-body">
        <form action={{ isset($tag) ? route('tag.update', $tag->id) : route('tag.store')}} method="POST">
          @csrf
          @if(isset($tag)) 
            @method('PUT')
          @endif
          <div class="form-group">
          <input class="form-control" type="text" name="name" value="{{isset($tag) ? $tag->name : ''}}">
          </div><!-- /.form-control -->
          <button type="submit" class="btn btn-success btn-sm">submit</button><!-- /.btn btn-success btn-sm -->
        </form>
    </div>
</div>
@endsection
