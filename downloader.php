<?php

//   InstaProfilePhotoDownloader
//   WebPajooh <webpajooh@gmail.com>
//   Github: https://github.com/WebPajooh

$args = $argv;
$username = @$argv[1];

// Titlebar
echo "===================================\n";
echo "===== Photo Profile Downloader ====\n";
echo "===================================\n\n";

if (! $username) {
	exit("[!] Username required!");
}

$profileUrl = "https://instagram.com/{$username}?__a=1";
$json = json_decode(@file_get_contents($profileUrl));

@ $profilePhotoUrl = $json->graphql->user->profile_pic_url_hd;

if (filter_var($profilePhotoUrl, FILTER_VALIDATE_URL) === false) {
	exit("[!] Profile not found!");
}

$photo = @file_get_contents($profilePhotoUrl);
if (! $photo) {
	exit("[!] Something went wrong...!");
}
file_put_contents("$username.jpg", $photo);
exit("[i] Done!");
