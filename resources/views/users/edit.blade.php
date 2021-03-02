@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">user</div>
    <div class="card-body">
        <form action="{{ route('users.update-profile', $user->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          {{-- @if(isset($user))  --}}
            @method('PUT')
          {{-- @endif --}}
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control" type="text" name="name" value="{{$user->name}}">
          </div><!-- /.form-control -->
          <div class="form-group">
            <label for="about">about</label>
            <textarea class="form-control" name="about" id="about" cols="30" rows="10">{{$user->about}}</textarea>
          </div><!-- /.form-control -->
          {{-- @if (isset($user))
            <div class="form-group">
              <img src="{{asset('storage/' . $user->image)}}" alt="">
            </div><!-- /.form-group -->
            @endif --}}
          {{-- <div class="form-group mt-4">
            <label for="image">Image</label>
            <input class="form-control" type="file" id="image" name="image">
          </div><!-- /.form-control --> --}}
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