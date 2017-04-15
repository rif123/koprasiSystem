<?php include"./count.php"; ?>
<?php include "./assets/".$template."/delete_promo.php"; ?>
<script>
	function to_menu(n){
		window.location=n;
	}
</script>
<div class="header_container">
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
            <h1 class="logo"> <a href="<?=site_url()?>" title="<?=$identitas->site_title?>"><img class="respond-img" src="<?=base_url().'uploads/'.$identitas->logo?>" alt="<?=$identitas->site_title?>"></a></h1>
            <!--Logo Ends-->
            <!--Responsive NAV-->            
			<div class="responsive-nav" style="display:none;">
				<span style="-moz-user-select: none;">Menu</span>
				<select onChange="to_menu(this.value);">
					<?php
						foreach($menu->result() as $c){
							if($c->parent==0){
								echo'<option value="'.site_url('category/'.$c->idx_category_product.'/'.strtolower(str_replace(" ","-",$c->nm_categrory_product))).'">'.$c->nm_categrory_product.'</option>';
							}
						}
					?>
                </select>
            </div>
            <!--Responsive NAV-->
            <!--Search Starts-->
            <form class="header_search" action="<?=site_url('page/search')?>" method="GET">
                <div class="form-search">
                    <input id="search" name="key" class="input-text" autocomplete="on" placeholder="Cari Produk" type="text">
                    <button type="submit" title="Search"></button>
                </div>
            </form>
            <!--Search Ends-->
			<!--Like area-->
            <div class="box-like">
				<div>
			   <div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="https://<?=$identitas->facebook?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				</div>
				<br>
				<div>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<a href="https://<?=$identitas->twitter?>" class="twitter-follow-button" data-count="none">Tweet</a>
				</div>
			</div>
            <!--Like area-->
        </header>
        <!--Header Ends-->
    </div>
    <div class="navigation_container">
        <!--Navigation Starts-->
        <nav>
            <ul class="primary_nav">
				<li><a href="<?=site_url()?>" title="Home">Home</a></li>
				<?php
						foreach($menu->result() as $c){
							if($c->parent==0){
								$Qc=$this->additional_model->get_category($c->idx_category_product);
								if($Qc->num_rows()==0){
									echo'<li><a href="'.site_url('category/'.$c->idx_category_product.'/'.strtolower(str_replace(" ","-",$c->nm_categrory_product))).'" title="'.$c->nm_categrory_product.'">'.$c->nm_categrory_product.'</a></li>';
								}else{
									echo'<li><a href="'.site_url('category/'.$c->idx_category_product.'/'.strtolower(str_replace(" ","-",$c->nm_categrory_product))).'" title="'.$c->nm_categrory_product.'">'.$c->nm_categrory_product.'</a>
											<ul class="sub_menu">';
												foreach($Qc->result() as $sw){
													echo'<li> <a href="'.site_url('category/'.$sw->idx_category_product.'/'.strtolower(str_replace(" ","-",$c->nm_categrory_product)).'/'.strtolower(str_replace(" ","-",$sw->nm_categrory_product))).'" title="'.$sw->nm_categrory_product.'">'.$sw->nm_categrory_product.'</a>';
															$Qsc=$this->additional_model->get_category($sw->idx_category_product);
																if($Qc->num_rows()==0){
																	echo'</li>';
																}else{
																	echo'<ul>';
																	foreach($Qsc->result() as $sc){
																		echo'<li><a href="'.site_url('category/'.$sc->idx_category_product.'/'.strtolower(str_replace(" ","-",$c->nm_categrory_product)).'/'.strtolower(str_replace(" ","-",$sw->nm_categrory_product)).'/'.strtolower(str_replace(" ","-",$sc->nm_categrory_product))).'"title="'.$sc->nm_categrory_product.'">'.$sc->nm_categrory_product.'</a></li>';
																	}
																	echo'</ul>
																		</li>';
																}
												}
										echo'</ul>
										</li>';
												
								}
							}
						}
						?>
																										
            </ul>
			<div class='minicart' id='cart-area'>
				<?=$cart?>
			</div>
        </nav>
        <!--Navigation Ends-->
    </div>
    