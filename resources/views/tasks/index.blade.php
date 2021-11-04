@extends('base')

@section('content')
    <h1>Hello Task app</h1>

    @foreach($tasks as $t)
        <div>{{ $t->description }}</div>
        <form action="/tasks/{{ $t->id }}" method="POST">
            @method('PATCH')
            <button class="btn btn-light btn-block" input="submit">Complete</button>
        </form>
    @endforeach
    <a href='tasks/create' class='btn btn-primary btn-lg btn-block'>new</a>
@endsection