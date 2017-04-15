<?php include"./count.php"; ?>
<?php include "./assets/".$template."/delete_promo.php"; ?>
<!--Header Starts-->
        <header>
            <div class="top_bar clear">
              
                <!--Top Links Starts-->
                <ul class="top_links">
				<?php 
				if(($this->session->userdata('set_login_cus')==TRUE)){
                   echo '<li><a href="'.site_url('page/my_account').'" title="My Account" >My Account</a></li>';
				   if($fl_wishlist==1){
					echo	'<li><a href="'.site_url('page/my_account/wishlist').'" title="Wishlist">Wishlist</a></li>';
				   }
				   echo '<li><a href="'.site_url('page/logout').'" title="Logout '.$identitas->site_title.'">Logout</a></li>';
				}	
				if(($this->session->userdata('set_login_cus')==FALSE)){
					if($fl_wishlist==1){
						echo	'<li><a href="'.site_url('page/my_account/wishlist').'" title="Wishlist">Wishlist</a></li>';
					}
				  echo'<li><a href="'.site_url('page/login_user').'" title="Login '.$identitas->site_title.'">Login</a></li>';
				}	
				?>
                </ul>
                <!--Top Links Ends-->
            </div>
            <!--Logo Starts-->
            <h1 class="logo"> <a href="<?=site_url()?>" title="<?=$identitas->site_title?>"><img src="<?=base_url().'uploads/'.$identitas->logo?>" alt="<?=$identitas->site_title?>"></a></h1>
            <!--Logo Ends-->
            <!--Responsive NAV-->            
			<div class="responsive-nav" style="display:none;">
                <div id="uniform-undefined" class="selector"><span style="-moz-user-select: none;">Navigate...</span><select style="opacity: 0;" onchange="if(this.options[this.selectedIndex].value != ''){window.top.location.href=this.options[this.selectedIndex].value}">
                    <option selected="selected" value="">Navigate...</option>
                    <option value="leisure_index.html"> Home</option>
                    <option value="leisure_listing.html"> -  Listing Page</option>
                    <option value="leisure_detail.html">Product Page</option>
                    <option value="leisure_cart.html"> -  Shopping Cart</option>
                    <option value="leisure_checkout.html"> -  Checkout</option>
                    <option value="leisure_contact.php">Contact</option>
                </select></div>
            </div>
            <!--Responsive NAV-->
        </header>
        <!--Header Ends-->