@extends('base')

@section('content')
    <h1>Hello Task app</h1>

    <div class='testimonials'>
    @foreach($tasks as $t)
        <div class="card">
			<div class="layer"></div>
			<div class="content">
				<p>{{ $t->description }}</p>
                <form action="/tasks/{{ $t->id }}" method="GET">
                    @method('GET')
                    <button class="btn btn-error btn-block" input="submit">Modify</button>
                </form>
                <form action="/tasks/{{ $t->id }}" method="POST">
                    @method('PATCH')
                    <button class="btn btn-light btn-block" input="submit">Complete</button>
                </form>
                <form action="/tasks/{{ $t->id }}" method="DELETE">
                    @method('DELETE')
                    <button class="btn btn-error btn-block" input="submit">Delete</button>
                </form>
            </div>
		</div>
    @endforeach
    </div>
    <a href='tasks/create' class='btn btn-primary btn-lg btn-block'>new</a>
@endsection