$(document).ready(function(){

    $('#uploadForm').on('submit', function(e){
        e.preventDefault();
        var homeMsg = $('#message1');
        var modalMsg = $('#message2');
        var lastTableRow = $('#docs_table tr:last');
        $.ajax({
            url:"/upload",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                // edit home error msg box
                homeMsg.css(data.message1css1, data.message1css2);
                homeMsg.html(data.message1);
                homeMsg.addClass(data.class_name).removeClass('alert-danger');

                // edit modal error msg box
                modalMsg.css(data.message2css1, data.message2css2);
                modalMsg.html(data.message2);
                modalMsg.addClass(data.class_name);

                // insert new file in the table
                $(data.new_table_row).insertAfter(lastTableRow);

                // if file uploaded, hide modal
                if(data.new_table_row !== ''){
                    $('#uploadModal').modal('hide');
                }
            }
        })
    });
});