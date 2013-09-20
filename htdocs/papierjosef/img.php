<?php
$im = ImageCreate(110,100);
$white = ImageColorAllocate($im,0xFF,0xFF,0xFF);
$red = ImageColorAllocate($im,0xFF,0x00,0x00);
$black = ImageColorAllocate($im,0x00,0x00,0x00);
$y0=30;
$y1=50;
$y2=70;
$min=5;
$max=95;
$median=90*($_GET['e']-$_GET['i'])/($_GET['a']-$_GET['i'])+5;
$quart1=90*($_GET['q1']-$_GET['i'])/($_GET['a']-$_GET['i'])+5;
$quart2=90*($_GET['q2']-$_GET['i'])/($_GET['a']-$_GET['i'])+5;
$font_size =1;

ImageLine($im,$min,$y0,$min,$y2,$black);
ImageLine($im,$max,$y0,$max,$y2,$black);
ImageLine($im,$min,$y1,$quart1,$y1,$black);
ImageLine($im,$quart2,$y1,$max,$y1,$black);
ImageLine($im,$median,$y0,$median,$y2,$red);

ImageRectangle($im,$quart1,$y0,$quart2-1,$y2,$black);

ImageString($im, $font_size, $quart1, $y2+2,  "".$_GET['q1'], $black);
ImageString($im, $font_size, $quart2, $y2+2,  "".$_GET['q2'], $black);
ImageString($im, $font_size, $min, $y2+2,  "".$_GET['i'], $black);
ImageString($im, $font_size, $max, $y2+2,  "".$_GET['a'], $black);

header('Content-Type: image/png');
ImagePNG($im);
?>
