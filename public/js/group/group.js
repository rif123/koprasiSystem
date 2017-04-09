$(document).ready(function(){
    // save
    $('.btn-save-group').click(function(){
        var datas = $('#form-menu-group').serialize();
        $.ajax({
            url: urlSave,
            type : 'POST',
            dataType :'json',
            data : datas,
            success: function(retval){
                if (retval.status) {
                    $('#defaultModalLabel').text('Berhasil');
                    $('.modal-body').text('Data Berhasil Tersimpan');
                    $('.btn-close').attr('onclick', 'redirect()');
                    $('#defaultModal').modal('show');

                }
            }
        });
    });

    $('.edit-group').click(function(){
        var user_grp  =  $(this).attr('data-id-grp');
        $.ajax({
            url: urlShow,
            type : 'GET',
            dataType :'json',
            data : {user_grp : user_grp},
            success: function(retval){
                var btn  = $('.btn-process');
                    $('.btn-process').html('');
                    btn.append('<button type="button" class="btn bg-blue-grey waves-effect" onclick="updateData(\''+retval.data.user_grp+'\')">Edit</button>');
                    btn.append(' | <button type="button" class="btn btn-info waves-effect" onclick="redirect()">Reset</button>');

            }
        });
    });

    $('.delete-group').click(function(){
        var user_grp  =  $(this).attr('data-id-grp');
        window.location  = urlDeleteGroup+"?user_grp="+user_grp;
    });
    $('select[name="group_name"]').change(function(){
        var user_grp = $(this).val();
        $.ajax({
            url: urlEditMenuSelected,
            type : 'GET',
            dataType :'json',
            data : {user_grp : user_grp},
            success: function(retval){
                $('.menu-left-list').html(retval.html);
            }
        });
    });
    $('.btn-save-role').click(function(){
        var datas = $('#form-menu-role').serialize();
        $.ajax({
            url: urlEditUserGroup,
            type : 'POST',
            dataType :'json',
            data : datas,
            success: function(retval){
                if (retval.status) {
                    $('#defaultModalLabel').text('Berhasil');
                    $('.modal-body').text('Data Berhasil Tersimpan');
                    $('#defaultModal').modal('show');
                }
            }
        });
    });

});
function redirect(){
    window.location = window.location.href ;
}
function updateData(user_grp) {
    var datas = $('#form-menu-group').serialize();
    $.ajax({
        url: urlEditGroup,
        type : 'POST',
        dataType :'json',
        data : datas+"&user_grp="+user_grp,
        success: function(retval){
            if (retval.status) {
                $('#defaultModalLabel').text('Berhasil');
                $('.modal-body').text('Data Berhasil Tersimpan');
                $('.btn-close').attr('onclick', 'redirect()');
                $('#defaultModal').modal('show');

            }
        }
    });
}
