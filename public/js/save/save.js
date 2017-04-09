$(document).ready(function(){
    var options = {
        dataType:  'json',
        beforeSend: function() {

        },
        uploadProgress: function(event, position, total, percentComplete) {

        },
        success: function(xhr) {
            if (xhr.status) {
                var modalDiv = $('#defaultModal');
                    modalDiv.find('.modal-title').html("Berhasil");
                    modalDiv.find('.btn-close').attr("onCLick", "redirect()");

                    modalDiv.find('.modal-body').html(xhr.message);
                    modalDiv.modal('show');
            } else {
                var modalDiv = $('#defaultModal');
                    modalDiv.find('.modal-title').html("Peringatan");
                    modalDiv.find('.modal-body').html(xhr.message);
                    modalDiv.modal('show');
            }
        },
        complete: function(xhr) {

        }
    };
    $('#form-menu-wajib').submit(function() {
        $(this).ajaxSubmit(options);
        return false;
    });

    $('.btn-simpan-wajib').click(function(){
        window.location  = urlListWajib;
    });
    $('.btn-simpan-pokok').click(function(){
        window.location  = urlListPokok;
    });
});

function redirect() {
    window.location = window.location.href ;
}
// pre-submit callback
function showRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    alert('About to submit: \n\n' + queryString);
    return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
        '\n\nThe output div should have already been updated with the responseText.');
}
