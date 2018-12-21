$("body").on("click",".upload-btn",function(e){
    $(this).parents("form").ajaxForm(options);
});

var options = {
    complete: function(response)
    {
        if($.isEmptyObject(response.responseJSON.error)){
            $("input[name='doc_type']").val('');
            alert('Image Upload Successfully.');
        }else{
            printErrorMsg(response.responseJSON.error);
        }
    }
};

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}