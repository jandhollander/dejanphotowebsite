<?php

require "medoo.php";
require "settings.php";

function getDB() {
    return new medoo(getSettings());
}

function getFbShareLink($title, $desc, $image, $href) {
    $title = urlencode($title);
    $desc = urlencode($desc);
    $image = urlencode($image);
    $href = encodeURIComponent($href);

    return "http://www.dejan-photo.be/fbshare.php?d=" . $desc . "&t=" . $title . "&i=" . $image . "&u=" . $href;
}

function getBaseUrl() {
    return getSettings()["baseurl"];
}

function getAbsolutePath($path) {
    return getBaseUrl() . $path;
}

function getAlbumBasePath() {
    return getAbsolutePath(getSettings()["albumpath"]);
}

function getDirPath($dir) {
    return getAlbumBasePath() . $dir . "/";
}

function getFilePath($dir, $filename) {
    return getDirPath($dir) . $filename;
}

function getBigFileName($filename) {
     return str_replace("/", "/big/", $filename);
}

function getBigFilePath($filename) {
    return realpath(getBigFileName($filename));
}

function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}
?>