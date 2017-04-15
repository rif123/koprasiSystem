<html>
<body>
	<div style='padding: 5em;'>
		<div style="width: 40%;min-height: 20em;margin: auto;border: 1px solid #F8910D;border-radius: 5px;overflow: hidden;">
			<p style="background: #F18700;padding: 15px 15px;margin: 0;font-family: Arial;color: #fff;font-size: 1.5em;">Welcome to <?=$identitas->site_title?></p>
			<p style="font-family: arial;font-size: 14px;color: #474747;padding: 0 10px;">Untuk Melakukan Reset Password silahkan Klik <a href="<?=site_url('page/my_account/'.$pelanggan->row()->idx_pelanggan.'?q='.$fsystem)?>">Di sini</a></p>
			<p style="text-align: center;margin-top: 10em;font-family: arial;font-size: 14px;color: #474747;padding: 0 10px;"><?=$identitas->site_title?></p>
		</div>
	</div>
</body>
</html>
