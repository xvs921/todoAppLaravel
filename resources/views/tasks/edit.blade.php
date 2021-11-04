@extends('base')

@section('content')
<h1>Edit Task</h1>

<form method="POST" action="/tasks/edit/{{ $task->id }}">
    @method('PATCH') 
    @csrf
    <div class="form-group">
      <label for="description">Task Description</label>
      <input class="form-control" name="description" value="{{ $task->description }}"/>
      <label>Task Created At: {{ $task->created_at}}</label>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Edit Task</button>
    </div>
</form>
@endsection