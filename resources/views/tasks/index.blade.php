@extends('base')
<style>
.testimonials
{
	margin: 50px auto 100px;
	display: grid;
	grid-template-columns: repeat( auto-fit, minmax(350px, 1fr));
	grid-gap: 20px;
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
	<h1>{{ $title }}</h1>
    <div class='testimonials'>
    @foreach($tasks as $t)
		<div class="{{ $t->completedClassFind() }}">
			<div class="content" id="todo{{ $t->id }}">
				<h3>{{ $t->title }}</h3>
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
					<div>
					<button type="button" id="btn-completed" class="btn btn-light btn-lg"><i class="{{ $t->isCompleted() }}"></i></button>
					<input type="hidden" id="todo_id" name="todo_id" value="0">
					</div>
				</div>
            </div>
		</div>
    @endforeach
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($){
    $("#btn-completed").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: "NOTITLE PLS",
        };
        var state = jQuery('#btn-completed').val();
        var type = "PATCH";
        var todo_id = jQuery('#todo_id').val();
        var ajaxurl = 'todo/'+todo_id;
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var todo = '<h1>'+data.title+'</h1>';
                jQuery("#todo" + todo_id).replaceWith(todo);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
</script>