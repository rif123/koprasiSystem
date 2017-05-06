@extends('layouts.index_no_require')
@section('content')
@include('layouts.left')
@include('layouts.right')

<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="header">
            <h2>Generate Token</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="body">
                    <form action="{{url(route('config.generateToken'))}}" method="post" enctype="multipart/form-data">
                        {!! Form::token() !!}
                        <div class="row clearfix">
                            <h2 class="card-inside-title group-title">Nama Anggota</h2>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <!--
                                        <input class="form-control bs-autocomplete" id="ac-demo" value="" placeholder="Nama Anggota" type="text" data-source="demo_source.php" data-hidden_field_id="city-code" data-item_id="id" data-item_label="cityName" autocomplete="off" name="nm_anggota">
                                    -->
                                        <input type="text" id="nm_anggota"  class="form-control" value="" name="nm_anggota"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">credit_card</i>
                                    </span>
                                    <div class="form-line">
                                          <input type="text" name="no_anggota"  class="form-control" placeholder="No Anggota">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">credit_card</i>
                                    </span>
                                    <div class="form-line">
                                          <input type="text" name="kode_wilayah"  class="form-control kode-wilayah" placeholder="Kode Wilayah (3 Digit)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">credit_card</i>
                                    </span>
                                    <div class="form-line">
                                          <input type="text" name="tahun_wub" class="form-control tahun-wub" placeholder="Tahun Wub (2 digit)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">credit_card</i>
                                    </span>
                                    <div class="form-line">
                                          <input type="text" name="no_anggota" class="form-control no_anggota" placeholder="Nomor Anggota (3 Digit)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    -->
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-primary waves-effect" >Generate</button>
                            </div>
                        </div>
                    </form>
                    <hr></hr>
                    @if (\Session::has('userName'))
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-md-offset-4 body bg-pink" style="border:1px solid #000;">
                        Generate Berhasil
                        <ul class="dashboard-stat-list">
                            <li>
                                User
                                <span class="pull-right"><b>{{\Session::get('userName')}}</b></span>
                            </li>
                            <li>
                                Password
                                <span class="pull-right"><b>{{\Session::get('token')}}</b></span>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        h2.group-title{
            margin-left:15px
        }
    </style>
</section>


<style>
ul.bs-autocomplete-menu {
position: absolute;
top: 0;
left: 0;
width: 100%;
max-height: 200px;
overflow: auto;
z-index: 9999;
border: 1px solid #eeeeee;
border-radius: 4px;
background-color: #fff;
box-shadow: 0px 1px 6px 1px rgba(0, 0, 0, 0.4);
}

ul.bs-autocomplete-menu a {
font-weight: normal;
color: #000;
}

.ui-helper-hidden-accessible {
border: 0;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}

.ui-state-active,
.ui-state-focus {
color: #23527c;
background-color: #337ab7;
}

.bs-autocomplete-feedback {
width: 1.5em;
height: 1.5em;
overflow: hidden;
margin-top: .5em;
margin-right: .5em;
}

.loader {
font-size: 10px;
text-indent: -9999em;
width: 1.5em;
height: 1.5em;
border-radius: 50%;
background: #333;
background: -moz-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
background: -webkit-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
background: -o-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
background: -ms-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
background: linear-gradient(to right, #333333 10%, rgba(255, 255, 255, 0) 42%);
position: relative;
-webkit-animation: load3 1.4s infinite linear;
animation: load3 1.4s infinite linear;
-webkit-transform: translateZ(0);
-ms-transform: translateZ(0);
transform: translateZ(0);
}

.loader:before {
width: 50%;
height: 50%;
background: #333;
border-radius: 100% 0 0 0;
position: absolute;
top: 0;
left: 0;
content: '';
}

.loader:after {
background: #fff;
width: 75%;
height: 75%;
border-radius: 50%;
content: '';
margin: auto;
position: absolute;
top: 0;
left: 0;
bottom: 0;
right: 0;
}

@-webkit-keyframes load3 {
0% {
-webkit-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
transform: rotate(360deg);
}
}

@keyframes load3 {
0% {
-webkit-transform: rotate(0deg);
transform: rotate(0deg);
}
100% {
-webkit-transform: rotate(360deg);
transform: rotate(360deg);
}
}

</style>
@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
<script src="{{ url('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
<script>
var urlGerUserAnggota = "{{ url(route('config.getAnggota')) }}";
$.widget("ui.autocomplete", $.ui.autocomplete, {

  _renderMenu: function(ul, items) {
    var that = this;
    ul.attr("class", "nav nav-pills nav-stacked  bs-autocomplete-menu");
    $.each(items, function(index, item) {
      that._renderItemData(ul, item);
    });
  },

  _resizeMenu: function() {
    var ul = this.menu.element;
    ul.outerWidth(Math.min(
      ul.width("").outerWidth() + 1,
      this.element.outerWidth()
    ));
  }

});

(function() {
  "use strict";
  $('.kode-wilayah').inputmask('999', { placeholder: '___' });
  $('.tahun-wub').inputmask('99', { placeholder: '__' });
  $('.no_anggota').inputmask('999', { placeholder: '___' });
  $('.bs-autocomplete').each(function() {
    var _this = $(this),
      _data = _this.data(),
      _hidden_field = $('#nm_anggota');
    _this.after('<div class="bs-autocomplete-feedback form-control-feedback"><div class="loader">Loading...</div></div>')
      .parent('.form-group').addClass('has-feedback');

    var feedback_icon = _this.next('.bs-autocomplete-feedback');
    feedback_icon.hide();

    _this.autocomplete({
        minLength: 2,
        autoFocus: true,
        source: function(request, response) {
            jQuery.get(urlGerUserAnggota, {
               query: request.term
           }, function (retVal) {
               response(retVal);
           });
        },
        search: function() {
          feedback_icon.show();
          _hidden_field.val('');
        },
        response: function() {
          feedback_icon.hide();
        },
        focus: function(event, ui) {
        _this.val(ui.item.nm_anggota);
          event.preventDefault();
        },
        select: function(event, ui) {
          _this.val(ui.item.nm_anggota);
          _hidden_field.val(ui.item.id);
          event.preventDefault();
        }
      })
      .data('ui-autocomplete')._renderItem = function(ul, item) {
        return $('<li></li>')
          .data("item.autocomplete", item)
          .append('<a>' + item.nm_anggota + '</a>')
          .appendTo(ul);
      };
  });
})();
</script>
@stop
@stop
@stop
