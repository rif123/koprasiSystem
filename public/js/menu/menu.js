$(document).ready(function(){
    $('.edit-menu').click(function(){
        var id_menu  =  $(this).attr('data-id-menu');
        var name_menu  =  $(this).attr('data-name-menu');
        var url_menu = $(this).attr('data-url-menu');
        var parent_menu  = $(this).attr('data-parent-menu');
        var parent_menu_name  = $(this).attr('data-name-menu');

        var icon_menu  = $(this).attr('data-icon-menu');

        $('input[name="name_menu"]').val(name_menu);
        $('input[name="url_menu"]').val(url_menu);
        $('input[name="parent_menu"]').val(parent_menu);
        $('input[name="parent_menu_name"]').val(parent_menu_name);

        $('input[name="icon_menu_name"]').val(icon_menu);
        $('input[name="icon_menu"]').val(icon_menu);


        var btn  = $('.btn-save');
            btn.text('Edit');
            btn.removeClass('btn-primary');
            btn.addClass('bg-blue-grey');
            if($('.id_menu').length == 0) {
                btn.parent().append("<input class='id_menu' type='hidden' value='"+id_menu+"' name='id_menu'>");
                btn.parent().append(' | <button type="button" class="btn btn-info waves-effect" onclick="resetEdit()">Reset</button>');
            } else {
                $('.id_menu').val(id_menu);
            }
        var form = $('#form-menu');
            form.attr('action', urlUpdate);
    });
    $('.delete-menu').click(function(){
        var id_menu  =  $(this).attr('data-id-menu');
        window.location  = urlDelete+"?id_menu="+id_menu;
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

    $('span.icon-name').click(function(){
        window.opener.document.getElementById('icon_menu_name').value = $(this).text();
        window.opener.document.getElementById('icon_menu').value = $(this).text();
        window.close();
    });

});
function resetEdit(){
  window.location.reload(false);
}

function getAllMenuIcon (){
    w=800
    h=600
    if (window.screen) {
        w = window.screen.availWidth;
        h = window.screen.availHeight;
    }
    var myWindow = window.open(urlShowMenuIcon, "MsgWindow",'width='+w+',height='+h+',top=0,left=0');
}
function getAllMenu() {
    w=800
    h=600
    if (window.screen) {
        w = window.screen.availWidth;
        h = window.screen.availHeight;
    }
    var myWindow = window.open(urlShowMenu, "MsgWindow",'width='+w+',height='+h+',top=0,left=0');
}
