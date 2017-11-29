$('.delete-modal').click(function() {
    var id = $(this).data("id");
    var pathname = window.location.pathname+'/';
    var url_delete = pathname+id;
    $('#delete').click(function() {
        $.ajax({
            type: 'delete',
            dataType: 'json',
            url: url_delete,
            data:{
                '_token': $('input[name=_token]').val(),
                'id': id
            },
            success: function() {
                location.reload();
            }
        });
    });
});