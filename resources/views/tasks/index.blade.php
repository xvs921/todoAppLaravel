@extends('base')
<style>
.testimonials
{
	margin: 200px auto 100px;
	display: grid;
	grid-template-columns: repeat( auto-fit, minmax(350px, 1fr));
	grid-gap: 20px;
}
.ready{
	--card-bg-color: lightgreen;
}
.todo{
	--card-bg-color: red;
}
.testimonials .card
{
	position: relative;
	width: 350px;
	margin: 0 auto;
	background: var(--card-bg-color);
	padding: 20px;
	box-sizing: border-box;
	text-align: center;
	box-shadow: 0 10px 40px rgba(0,0,0,.5);
	overflow: hidden;
}
.testimonials .card .content
{
	position: relative;
	z-index: 2;
}
.testimonials .card .content .button
{
	display: flex;
}
.testimonials .card .content p
{
	font-size: 18px;
	line-height: 24px;
	color: #fff;
}
</style>

@section('content')
    <h1>Hello Task app</h1>

    <div class='testimonials'>
    @foreach($tasks as $t)
		<div class="{{ $t->completedClassFind() }}">
			<div class="content">
				<h3>Task description</h3>
				<p>{{ $t->description }}</p>
				<div class="buttons">
					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('DELETE')
						@csrf
						<button class="btn btn-danger btn-lg" input="submit"><i class="fa fa-trash"></i></button>
					</form>
					<form action="/tasks/{{ $t->id }}" method="GET">
						@method('GET')
						@csrf
						<button class="btn btn-info btn-lg" input="submit"><i class="fa fa-pencil"></i></button>
					</form>
					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('PATCH')
						@csrf
						<button class="btn btn-light btn-lg" input="submit"><i class="{{ $t->isCompleted() }}"></i></button>
					</form>
				</div>
            </div>
		</div>
    @endforeach
    </div>
@endsection