$(document).ready(function(){

    // delete rows not loaded by ajax
    $('.form-delete').on('submit', function(e){
        e.preventDefault();
        var currentRow = $(this).parent().parent();
        var id = this[2].value; // 'id' is the 3rd element of the form
        var _token =  $('input[name="_token"]').val();
        $.ajax({
            url:"/delete/"+id,
            method:"DELETE",
            data: {
                '_token' : _token,
                "id": id
            },
            dataType:'JSON',
            success:function(data)
            {
                $('#message1').css('display', 'block');
                $('#message1').html(data.message);
                $('#message1').addClass('alert-success');
                currentRow.css('display', 'none');
            },
            error: function (response) {
                console.log('Error:', response);
            }
        })
    });

    // add event handler for newly added row by ajax
    $('#docs_table').on( "click", ".form-delete", function( e ) {
        console.log("test");
        e.preventDefault();
        var currentRow = $(this).parent().parent();
        var id = this[2].value; // 'id' is the 3rd element of the form
        var _token =  $('input[name="_token"]').val();
        $.ajax({
            url:"/delete/"+id,
            method:"DELETE",
            data: {
                '_token' : _token,
                "id": id
            },
            dataType:'JSON',
            success:function(data)
            {
                $('#message1').css('display', 'block');
                $('#message1').html(data.message);
                $('#message1').addClass('alert-success');
                currentRow.css('display', 'none');
            },
            error: function (response) {
                console.log('Error:', response);
            }
        })
    });
});