  @extends('base')
  <style>
  .header
  {
    font-size: 32px;
  }
  </style>
  @section('content')
  <h1>New Task</h1>

  <form method="POST" action="/tasks">
    @csrf
    <div class="form-group">
      <label class="header" for="title">Task title</label>
      <input class="form-control" name="title" />
      <label class="header" for="description">Task Description</label>
      <input class="form-control" name="description" />
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Create Task</button>
    </div>
  </form>
  @endsection