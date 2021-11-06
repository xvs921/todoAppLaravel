@extends('base')
<style>
.testimonials
{
	width: 100%;
	margin: 60px auto;
	display: grid;
	grid-template-columns: repeat( auto-fit, minmax(550px, 1fr));
	grid-gap: 5px;
}
.ready{
	--card-bg-color: green;
}
.todo{
	--card-bg-color: red;
}
.testimonials .card
{
	position: relative;
	width: 550px;
	margin: 0 auto;
	background: var(--card-bg-color);
	padding: 20px;
	box-sizing: border-box;
	text-align: center;
	box-shadow: 0 10px 40px rgba(0,0,0,.5);
	overflow: hidden;
	border-radius: 20px;
	flex-direction: column;
	display: flex;
}
.testimonials .card .content .buttons
{
	display: flex;
	justify-content: space-between;
	justify-content: flex-end;
}
.testimonials .card .content h3
{
	font-size: 44px;
	line-height: 44px;
	color: #fff;
}
.testimonials .card .content p
{
	font-size: 32px;
	line-height: 32px;
	color: #fff;
}
.testimonials .card .content span
{
	color: #fff;
}
</style>
@section('content')
	<h1>{{ $title }}</h1>
    <div class='testimonials'>
    @foreach($tasks as $t)
		<div class="{{ $t->completedClassFind() }}">
			<div class="content" id="todo{{ $t->id }}">
				<h3>{{ $t->title }}</h3>
				<p>{{ $t->description }}</p>
				<span>Last modify date: {{ $t->updated_at }}</span>
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
<script>
	let a = screen.width;
	let b = screen.height;
</script>