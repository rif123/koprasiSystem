$(document).ready(function(){
    var options = {
        success:       showResponse,  // post-submit callback
        beforeSend: function() {

        },
        uploadProgress: function(event, position, total, percentComplete) {

        },
        success: function() {

        },
        complete: function(xhr) {

        }
        // other available options:
        //url:       url         // override for form's 'action' attribute
        //type:      type        // 'get' or 'post', override for form's 'method' attribute
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
        //clearForm: true        // clear all form fields after successful submit
        //resetForm: true        // reset the form after successful submit

        // $.ajax options can be used here too, for example:
        //timeout:   3000
    };
    $('.btn-profile').click(function(){
        $('#form-anggota').trigger('submit');
    });
    $('#form-anggota').submit(function() {
        $(this).ajaxSubmit(options);
        return false;
    });
});

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