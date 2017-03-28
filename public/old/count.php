<?php
$pemisah		='||';
$waktu			=time()+25200;
$sekarang		=(int)($waktu/86400);
$data 			= "./countlog.txt"; 
if(getenv('HTTP_X_FORWARDED_FOR'))
$ip=getenv('HTTP_X_FORWARDED_FOR');
else
$ip=getenv('REMOTE_ADDR');
$buka=fopen($data,"a");
$tulis="$ip$pemisah$sekarang\n";
fwrite($buka,$tulis);
fclose($buka);
$arr=file($data);
$jumlah_hits=count($arr);
$exp=explode($pemisah,$arr[0]);
if($exp[1] < $sekarang)
{
fopen($data,'w');
}
/*----------Count Total---------------*/
$filename = "./countlog_total.txt"; 
$count= file($filename); 
$count[0]++; 
$file = fopen ($filename, "w") or die ("Cannot find $filename"); 
fputs($file, "$count[0]"); 
fclose($file);
?>