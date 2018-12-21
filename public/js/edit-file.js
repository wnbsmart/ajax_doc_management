$(document).ready(function(){

    $('.edit-btn').click( function () {
        // select document's type within edit modal
        var docTypeVal = this.value;
        $('#editForm option[value='+docTypeVal+']').prop('selected', 'selected').change();

        // within edit_form, add document's id value to hidden field (#edit_id)
        var docIdVal = $(this).attr("data-id");
        $('#edit_id').val(docIdVal);
    });

    $('#editForm').on('submit', function(e){
        e.preventDefault();
        var id = $('#edit_id').val();
        var doc_type = $('#editForm #doc_type');
        var clickedEditBtn = $('.edit-btn');
        var homeMsg = $('#message1');
        var modalMsg = $('#editModalErrMsg');
        var btnDocumentName = $('button[class="btn btn-link doc_name"][data-id='+id+']');
        $.ajax({
            url:"/edit/"+id,
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                console.log();
                // edit home error msg box
                homeMsg.css(data.message1css1, data.message1css2);
                homeMsg.html(data.message1);
                homeMsg.addClass(data.class_name).removeClass('alert-danger');

                // edit modal error msg box
                modalMsg.css(data.message2css1, data.message2css2);
                modalMsg.html(data.message2);
                modalMsg.addClass(data.class_name);

                // insert new file in the table
                // $(data.edited_row).insertAfter(lastTableRow);
                console.log(btnDocumentName.text());
                console.log(doc_type.children(':selected').text());

                // if file uploaded
                if(data.edited_row !== ''){
                    // hide modal
                    $('#editModal').modal('hide');
                    // change edited row's properties
                    btnDocumentName.text(doc_type.children(':selected').text());
                    clickedEditBtn.prop('value', doc_type.val());
                }
            }
        })
    });
});