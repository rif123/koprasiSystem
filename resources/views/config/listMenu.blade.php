<!-- Bootstrap Core Css -->
<link href="{{ URL::asset('') }}plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<p class="bg-primary" style="text-align:center">All Menu<p>
    <div class="col-md-3">
        &nbsp;
    </div>
    <div class="col-md-7">
        <div class="just-padding">
            <div class="tree">
                <li>
                    <a onclick="setMenu(0, 'Root')">
                       <span>ROOT</span>
                   </a>
                </li>
                <?php
                    echo Helpers::printRecursiveListMenu($allMenu);
                ?>
            </div>
        </div>
    </div>
<style>
.tree li {
margin: 0px 0;
list-style-type: none;
position: relative;
padding: 20px 5px 0px 5px;
}

.tree li::before{
content: '';
position: absolute;
top: 0;
width: 1px;
height: 100%;
right: auto;
left: -20px;
border-left: 1px solid #ccc;
bottom: 50px;
}
.tree li::after{
content: '';
position: absolute;
top: 30px;
width: 25px;
height: 20px;
right: auto;
left: -20px;
border-top: 1px solid #ccc;
}
.tree li a{
display: inline-block;
border: 1px solid #ccc;
padding: 5px 10px;
text-decoration: none;
color: #666;
font-family: arial, verdana, tahoma;
font-size: 11px;
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
}

/*Remove connectors before root*/
.tree > ul > li::before, .tree > ul > li::after{
border: 0;
}
/*Remove connectors after last child*/
.tree li:last-child::before{
  height: 30px;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after,
.tree li a:hover+ul li::before,
.tree li a:hover+ul::before,
.tree li a:hover+ul ul::before{
border-color:  #94a0b4;
}
</style>
<script>
    function setMenu(id_menu, name){
        window.opener.document.getElementById('parent_menu_name').value = name;
        window.opener.document.getElementById('parent_menu').value = id_menu;
        window.close();
        //document.getElementsByClassName('parent_menu')[0].setAttribute("value", "yolo");
    }
</script>
