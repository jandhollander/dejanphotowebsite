<?
    require "functions.php";
    
    session_start();
    
    function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
    
    $basket = $_SESSION["basket"];
    
    $albumID = $_GET["a"];
    
    $db = getDB();
    
    $album = $db->select("dejanAlbum", "*", ["id" => $albumID])[0];
    $pics = $db->select("dejanPic", "*", ["album" => $albumID]);
    
    $name = $album["name"];
    $dir = $album["dir"];
//    $buy = $album["buy"];
    $pic = $pics[0]["filename"];
    
    $title = urlencode("DeJan Photography - Album {$name}");
    $desc = urlencode($album["description"] . " " . $album["date"] . " - " . $album["location"]);
    $image = urlencode("http://www.dejan-photo.be/{$dir}/{$pic}");
    $href = encodeURIComponent("http://www.dejan-photo.be/#gallery.php?a={$albumID}");
    
    $url = "http://www.dejan-photo.be/fbshare.php?d=" . $desc . "&t=" . $title . "&i=" . $image . "&u=" . $href;
?>
<!--<div style="padding-bottom: 10px">
    <div class="fb-like" data-href="<?=$url?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
</div>-->
<link rel="stylesheet" href="360slider/threesixty.css">
<div class="threesixty product1">
    <div class="spinner360">
        <span>0%</span>
    </div>
    <ol class="threesixty_images"></ol>
</div>
<!--
<div class="fb-comments" data-href="<?=$url?>" data-numposts="5"></div>
-->
<script>
$(document).ready(function () {
    product1 = $('.product1').ThreeSixty({
        totalFrames: 8, // Total no. of image you have for 360 slider
        endFrame: 8, // end frame for the auto spin animation
        currentFrame: 1, // This the start frame for auto spin
        framerate: 4,
        imgList: '.threesixty_images', // selector for image list
        progress: '.spinner360', // selector to show the loading progress
        imagePath:'3dsarge/', // path of the image assets
        filePrefix: 'sarge-', // file prefix if any
        ext: '.jpg', // extention for the assets
        height: 600,
        width: 800,
        navigation: true,
        disableSpin: false // Default false
    });
});
</script>