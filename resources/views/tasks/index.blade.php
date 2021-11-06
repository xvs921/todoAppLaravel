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
}
.testimonials .card .content .buttons
{
	display: flex;
	justify-content: space-between;
}
.testimonials .card .content h3
{
	font-size: 44px;
	line-height: 48px;
	color: #fff;
}
.testimonials .card .content p
{
	font-size: 32px;
	line-height: 36px;
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
				<div class="buttons">
					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('DELETE')
						@csrf
						<button class="btn btn-danger btn-lg" input="submit"><i class="fa fa-trash"></i></button>
					</form>
						<button class="btn btn-info btn-lg open-modal" input="submit" value="{{ $t->id }}"><i class="fa fa-pencil"></i></button>

					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('PATCH')
						@csrf
						<button class="btn btn-light btn-lg" input="submit"><i class="{{ $t->isCompleted() }}"></i></button>
					</form>
				</div>
				<h3>{{ $t->title }}</h3>
				<p>{{ $t->description }}</p>
				<span>Last modify date: {{ $t->updated_at }}</span>
            </div>
		</div>
    @endforeach
    </div>

	<div class="modal fade" id="linkEditorModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Link Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                                <div class="form-group">
                                    <label for="inputLink" class="col-sm-2 control-label">Link</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="link" name="link"
                                               placeholder="Enter URL" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description"
                                               placeholder="Enter Link Description" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                            </button>
                            <input type="hidden" id="link_id" name="link_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($){

    jQuery('body').on('click', '.open-modal', function () {
        var link_id = $(this).val();
        $.get('tasks/' + link_id, function (data) {
            jQuery('#link_id').val(data.id);
            jQuery('#link').val(data.url);
            jQuery('#description').val(data.description);
            jQuery('#btn-save').val("update");
            jQuery('.linkEditorModal').modal('show');
        })
    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            url: jQuery('#link').val(),
            description: jQuery('#description').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var link_id = jQuery('#link_id').val();
        var ajaxurl = 'links';
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'links/' + link_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var link = '' + data.id + '' + data.url + '' + data.description + '';
                link += ' ';
                link += '';
                if (state == "add") {
                    jQuery('#links-list').append(link);
                } else {
                    $("#link" + link_id).replaceWith(link);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#linkEditorModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>