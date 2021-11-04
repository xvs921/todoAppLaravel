@extends('base')

@section('content')
<h1>Edit Task</h1>

<form method="POST" action="/tasks">
  @csrf
  <div class="form-group">
    <label for="description">Task Description</label>
    <input class="form-control" name="description" value="{{ $task->description }}"/>
    <label for="description">Task Created At</label>
    <input class="form-control" name="description" value="{{ $task->created_at }}"/>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Edit Task</button>
  </div>
</form>
@endsection