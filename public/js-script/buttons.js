<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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