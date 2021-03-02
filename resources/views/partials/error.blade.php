@if (session()->has('errors'))
  <div class="alert alert-danger">
      {{ session()->get('errors') }}
  </div>
@endif