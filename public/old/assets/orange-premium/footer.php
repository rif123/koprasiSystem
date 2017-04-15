 <footer>
            <ul class="footer_links">
			<?php if($menu_bawah->num_rows()>0){ 
				$link=$menu_bawah->row();	
			?>
                <li><span>Tentang Kami</span>
                    <ul>
						<li><a href="<?=site_url('page/view/'.$link->about_us.'/'.$this->page_model->nm_pg($link->about_us))?>"  title="About Us">About Us</a></li>
						<li><a href="<?=site_url('page/view/'.$link->persyaratan_ketentuan.'/'.$this->page_model->nm_pg($link->persyaratan_ketentuan))?>"  title="Persyaratan dan Ketentuan">Persyaratan dan Ketentuan</a></li>
						<li><a href="<?=site_url('page/view/'.$link->kebijakan_privasi.'/'.$this->page_model->nm_pg($link->kebijakan_privasi))?>"  title="Kebijakan Privasi">Kebijakan Privasi</a></li>
															
                    </ul>
					<?php if($fl_secure==1){
					echo'
					<ul><br>
                        <li><a href="http://shoplution.com" target="_blank"><img src="'.base_url().'assets/images/trusted seller1.png" width="80%"></a></li>
                    </ul>';
					}
					?>
                </li>
                <li class="seperator"> <span>Layanan</span>
                    <ul>
                        <li><a href="<?=site_url('page/view/'.$link->contact_us.'/'.$this->page_model->nm_pg($link->contact_us))?>"  title="Hubungi Kami">Hubungi Kami</a></li>
						<li><a href="<?=site_url('page/payment_confirm')?>"  title="Konfirmasi Pembayaran">Konfirmasi Pembayaran</a></li>
						<li><a href="<?=site_url('page/view/'.$link->tata_cara_belanja.'/'.$this->page_model->nm_pg($link->tata_cara_belanja))?>"  title="Tata Cara Belanja">Tata Cara Belanja</a></li>
						<li><a href="<?=site_url('page/view/'.$link->panduan_ukuran.'/'.$this->page_model->nm_pg($link->panduan_ukuran))?>"  title="Panduan Ukuran">Panduan Ukuran</a></li>
						<li><a href="<?=site_url('page/view/'.$link->faq.'/'.$this->page_model->nm_pg($link->faq))?>"  title="FAQ">FAQ</a></li>
						<li><a href="<?=site_url('page/view/'.$link->aturan_pengiriman.'/'.$this->page_model->nm_pg($link->aturan_pengiriman))?>"  title="Aturan Pengiriman dan Pengembalian">Aturan Pengiriman dan Pengembalian</a></li>
					</ul>
                </li>
				<?php } ?>
				<li> <span>Temukan Kami</span>
                    <ul>
                        <li><a href="http://www.<?=$identitas->facebook?>" target="_blank" title="Facebook">Facebook</a></li>
                        <li><a href="http://www.<?=$identitas->twitter?>" target="_blank" title="Twitter">Twitter</a></li>
						<li><a href="http://www.<?=$identitas->gplus?>" target="_blank" title="Google+">Google+</a></li>
						<li><a href="http://www.<?=$identitas->youtube?>" target="_blank" title="Youtube">Youtube</a></li>
                    </ul><br>
					 <ul>
                        <li><span>Live Chat</span></li>
                        <?php
						foreach($ym->result() as $rym){
						?>
							<li><a href="ymsgr:SendIM?<?=$rym->no_account?>"><img border=0 src="http://opi.yahoo.com/online?u=<?=$rym->no_account?>&m=g&t=1"></a></li>
						<?php
						}
						?>
                    </ul>
                </li>
                <li> <span>Pembayaran</span>
                    <ul>
						<?php
							foreach($acc->result() as $acc){
							if($acc->logo_bank){
								echo'<li><img src="'.base_url().'uploads/'.$acc->logo_bank.'" alt="'.$acc->nm_bank.'" width="50px" height="25px"></li>';
							}
							?>
							<li><a><?=$acc->nm_bank?> <?=$acc->no_rek?></a></li>
							<li><a><?=$acc->atas_nama?></a></li>
						<hr>
						<?php
							}
						?>
					</ul>
                </li>
            </ul>
            <div class="footer_customblock">
			<ul class="footer_links" style="margin: 0 2em;">
			   <li> <span>Testimoni Pelanggan</span>
			   <?php
			   $sql=$this->db->query("select a.*,b.full_name,b.email from testimoni a	join pelanggan b on a.idx_pelanggan=b.idx_pelanggan where a.cd_status=1");
			   if($sql->num_rows()>0){
			   echo'
			    <script>
					$(function() {
						$(".slider").jCarouselLite({
							btnNext: ".next",
							btnPrev: ".prev",
							visible: 1,
							auto:true,
							speed:1000,
							vertical: false
						});
					});
				</script>
			   <div class="slider">
					<ul>';
							foreach($sql->result() as $w){
								echo"
								<li style='height:100px;'>
								<p style='text-decoration: underline;line-height: 16px;'>".$w->full_name."</p>
								<br>
								<p>".$w->testimoni."</p>
								</li>";
							}
						echo'
						</li>  
					</ul>
				</div>';
				}
				?>
                </li>
            </ul>
            </div>
            <address style="padding:5px;">
            Copyright 2013.All Rights Reserved. <span><?=$identitas->site_title?></span>.<p style="float:right;">Punya Pertanyaan,Kritik atau Saran Silahkan <a href="<?=site_url('page/contact')?>" title="Tinggalkan Pesan">Tinggalkan Pesan</a></p>
            </address>
			<address style="margin:0;border-top:none;text-align:right;padding:0;">
				Developed by <a href="http://shoplution.com" target="_blank">Shoplution</a>
				<br><a href="https://plus.google.com/117578558026079812259" rel="publisher">Mitra Souvenir </a></br>
			</address>
			
        </footer>