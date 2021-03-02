@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">user</div>
    <div class="card-body">
        <table class="table">
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td><img width="100px" height="60px" src="{{asset('storage/' . $user->image)}}" alt=""></td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <form action="{{route('users.make-admin', $user->id)}}" method="post">
                  @csrf
                  @if (!$user->isAdmin())
                  <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                  @endif
                </form>
              </td>
            </tr>
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