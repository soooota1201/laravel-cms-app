@extends('layouts.app')

@section('content')
@include('partials.error')
<div class="card">
    <div class="card-header">Category</div>
    <div class="card-body">
        <form action={{ isset($category) ? route('category.update', $category->id) : route('category.store')}} method="POST">
          @csrf 
          @if(isset($category)) 
            @method('PUT')
          @endif
          <div class="form-group">
          <input class="form-control" type="text" name="name" value="{{isset($category) ? $category->name : ''}}">
          </div><!-- /.form-control -->
          <button type="submit" class="btn btn-success btn-sm">submit</button><!-- /.btn btn-success btn-sm -->
        </form>
    </div>
</div>
@endsection
