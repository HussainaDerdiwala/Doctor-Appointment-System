<?php
session_start();

// settings
$width = 150;
$height = 50;
$length = 6;

// generate random captcha text
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz';
$captchaText = '';
for ($i = 0; $i < $length; $i++) {
    $captchaText .= $chars[rand(0, strlen($chars) - 1)];
}

// Determine captcha type
$type = $_GET['type'] ?? 'login';
if ($type === 'signup') {
    $_SESSION['signup_captcha'] = $captchaText;
} else {
    $_SESSION['login_captcha'] = $captchaText;
}

// create image
$image = imagecreate($width, $height);
$bg = imagecolorallocate($image, 255, 255, 255); // white background
$textColor = imagecolorallocate($image, 0, 0, 0); // black text

// add noise lines
for ($i = 0; $i < 5; $i++) {
    $lineColor = imagecolorallocate($image, rand(100,255), rand(100,255), rand(100,255));
    imageline($image, 0, rand()%$height, $width, rand()%$height, $lineColor);
}

// draw the text
$fontFile = __DIR__ . "/fonts/Roboto-Regular.ttf"; // make sure this file exists
if (file_exists($fontFile)) {
    imagettftext($image, 20, rand(-10, 10), 20, 35, $textColor, $fontFile, $captchaText);
} else {
    imagestring($image, 5, 30, 15, $captchaText, $textColor); // fallback without font
}

// send image to browser
header("Content-Type: image/png");
imagepng($image);
imagedestroy($image);
?>
