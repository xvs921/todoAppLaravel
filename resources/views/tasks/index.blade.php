@extends('base')
<style>
.testimonials
{
	margin: 200px auto 100px;
	display: grid;
	grid-template-columns: repeat( auto-fit, minmax(350px, 1fr));
	grid-gap: 20px;
}
.testimonials .card
{
	position: relative;
	width: 350px;
	margin: 0 auto;
	background: #333;
	padding: 20px;
	box-sizing: border-box;
	text-align: center;
	box-shadow: 0 10px 40px rgba(0,0,0,.5);
	overflow: hidden;
}
.testimonials .card .layer
{
	position: absolute;
	top: calc(100% - 2px);
	left: 0;
	width: 100%;
	height: 100%;
	background: linear-gradient(#03a9f4, #e91ee3);
	z-index: 1;
	transition: 0.5s;
}
.testimonials .card:hover .layer
{
	top: 0;
}
.testimonials .card .content
{
	position: relative;
	z-index: 2;
}
.testimonials .card .content p
{
	font-size: 18px;
	line-height: 24px;
	color: #fff;
}
.testimonials .card .content .image
{
	width: 100%;
	heigth: 100%;
	margin: 0 auto;
	border-radius: 50%;
	overflow: hidden;
	border: 4px solid #fff;
	box-shadow: 0 10px 40px rgba(0,0,0,.2);
}
.testimonials .card .content .details h2
{
	font-size: 18px;
	color: #fff;
}
.testimonials .card .content .details h2 span
{
	color: #03a9f4;
	font-size: 14px;
	transition: 0.5s;
}
.testimonials .card:hover .content .details h2 span
{
	color: #fff;
}
</style>

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
                    <button class="btn btn-info btn-lg" input="submit">Modify</button>
                </form>
                <form action="/tasks/{{ $t->id }}" method="POST">
					@csrf
                    @method('PATCH')
                    <button class="btn btn-light btn-lg" input="submit">Complete</button>
                </form>
                <form action="/tasks/{{ $t->id }}" method="DELETE">
					@csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-lg" input="submit">Delete</button>
                </form>
            </div>
		</div>
    @endforeach
    </div>
    <a href='tasks/create' class='btn btn-primary btn-lg btn-block'>new</a>
@endsection