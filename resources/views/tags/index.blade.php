@extends('layouts.app')

@section('content')
  <div class="text-right mb-3">
    <a href="{{route('tag.create')}}" class="btn btn-success btn-sm">
      {{-- {{isset($tags)}} --}}
      Add tag</a>
  </div>
<div class="card">
    <div class="card-header">tag</div>
    <div class="card-body">
        <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tags as $tag)
            <tr>
              <td>{{ $tag->name }}</td>
              <td></td>
              <td>
                <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-success btn-sm">Edit</a>
              </td>
              <td>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="handleDelete({{$tag->id}})">
                  Delete
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>

<!-- Modal -->
<form action="" method="POST" id="deletetagForm">
  @csrf
  @method('DELETE')
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          カテゴリーを削除しますか？
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
          <button type="submit" class="btn btn-danger">削除する</button>
        </div>
      </div>
    </div>
  </div>
</form>
{{-- modal end --}}
@endsection

@section('css')
    
@endsection

@section('js')
    <script>
      function handleDelete(id) {
        var form = document.getElementById('deletetagForm');
        form.action = '/tag/' + id;

        $('#exampleModal').modal('show');
      }
    </script>
@endsection