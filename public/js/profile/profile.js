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
                    modalDiv.find('.modal-body').html(xhr.message);
                    modalDiv.find('.btn-close').attr('onclick', 'redirect()');
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
    $('.btn-rubah-data').click(function(){
        $(this).attr('disabled', 'disabled');
        $('#form-anggota input').attr("readonly", false);
    });
    $('#form-anggota input').attr('readonly', 'readonly');


    $('#tanggal_lahir_pribadi').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: '-3d'
        });
    $(".event-address-pribadi").change(function() {
        if($(this).prop('checked') == true) {
                var ap = $("input[name='alamat_pribadi']").val();
                var rt = $("input[name='rtRw_pribadi']").val();
                var kp = $("input[name='kec_pribadi']").val();
                var dp = $("input[name='desKel_pribadi']").val();
                var kabkot = $("input[name='kabkot_pribadi']").val();

                $("input[name='alamat_usaha']").val(ap);
                $("input[name='rtRw_usaha']").val(rt);
                $("input[name='kec_usaha']").val(kp);
                $("input[name='kel_usaha']").val(dp);
                $("input[name='kabKot_usaha']").val(kabkot);
        } else {
            $("input[name='alamat_usaha']").val("");
            $("input[name='rtRw_usaha']").val("");
            $("input[name='kec_usaha']").val("");
            $("input[name='kel_usaha']").val("");
            $("input[name='kabKot_usaha']").val("");
        }
    });
    // $('.event-address-pribadi').click(function(){

    // })
});

// pre-submit callback
function showRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    alert('About to submit: \n\n' + queryString);
    return true;
}
function redirect(){
    window.location = window.location.href;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
        '\n\nThe output div should have already been updated with the responseText.');
}
