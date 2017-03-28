<!--Datatables-->
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/jquery.dataTables.css">
<link rel="stylesheet" media="screen" href="<?=$assets?>css/admin/demo_table_jui.css">
<!---Datatables-->
<script type="text/javascript" language="javascript" src="<?=$assets?>js/admin/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
        $('#ajax-status').hide();
        $('#message').hide();
        $('#form_input').ajaxForm({
                target: '#message',
                success: function() {
                        $('#message').show();
                }
        });
        $('#ajax-status').ajaxStart(function(){
                $('#message').hide();
                $(this).fadeIn('fast');
                $(this).html('processing...');
        });
        $('#ajax-status').ajaxSuccess(function(){
                $(this).hide();
        });
         
        
});

</script>
<!--Content-->
<div id="content">
<ul class="breadcrumb">
        <li><a href="#" class="glyphicons home">Home</a></li>
        <li class="divider"></li>
        <li>Ganti Profil</li>
</ul>
<div class="separator bottom"></div>
<div class="innerLR">

<form class="form-horizontal" id="form_input" method="POST" action="<?=site_url('pelanggan/reset_profile')?>" enctype="multipart/form-data">
        <!-- Widget -->
        <div class="widget widget-gray widget-body-gray">
                <!-- Widget heading -->
                <div class="widget-head"><h4 class="heading">Ganti Profil</h4></div>
                <!-- // Widget heading END -->
                <div class="widget-body">
                        <!-- Row -->
                        <div class="row">
                                                <span id="ajax-status"></span>
                                                <span id="message"  ></span>
                        <!-- Column -->
                                <div class="col-md-6">
                                                                                <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="email">Ganti Username</label>
                                                <div class="col-md-8">
                                                     <input type="text" name="username" class="form-control"/>
                                                 </div>
                                        </div>
                                        <!-- // Group END -->
                                                                                <!-- Group -->
                                        <div class="form-group">
                                                <label class="col-md-4 control-label" for="telepon">Ganti Password</label>
                                                <div class="col-md-8">
                                                        <input type="password" name="password" class="form-control"/>
                                                 </div>
                                        </div>
                                        <!-- // Group END -->
                                                                              
                                </div>
                        <!-- // Column END -->
                           </div> <!-- // Row END -->
                        <!-- Form actions -->
                        <div class="form-actions">
                                <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>OK</button>
                                <button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Reset</button>
                        </div>
                        <!-- // Form actions END -->
                        
                </div>
        

</div>
</form>
</div>
                
                                <!-- End Wrapper -->
                </div>  




