<?php
session_start();
header('Content-type: image/jpeg');
$text = $_SESSION['secure'];
$font_size = 20;
$image_width = 210;
$image_height = 50;
$image = imagecreate($image_width, $image_height);
//giving the image background color using decimal colour code
imagecolorallocate($image, 192,192,192);
$text_color = imagecolorallocate($image, 0,0,128);
//using image line to distort the font
// for($x =1; $x <= 30; $x++){
//   $x1 = rand(1, 100);
//   $x2 = rand(1, 100);
//   $y1 = rand(1, 100);
//   $y2 = rand(1, 100);
//   imageline($image, $x1, $y1, $x2, $y2, $text_color);
//
// }

//adding font-type to the image
imagettftext($image, $font_size, 0, 15, 30, $text_color, 'Chestnut.ttf', $text);

imagejpeg($image);
?>
