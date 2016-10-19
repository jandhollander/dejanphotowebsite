<?
    require "functions.php";
    
    session_start();
    
    $basket = $_SESSION["basket"];
    
    $albumID = $_GET["a"];
    
    $db = getDB();
    
    $album = $db->select("dejanAlbum", "*", ["id" => $albumID])[0];
    $pics = $db->select("dejanPic", "*", ["album" => $albumID]);
    
    $name = $album["name"];
    $dir = $album["dir"];
//    $buy = $album["buy"];
    $pic = $pics[0]["filename"];
    $buylink = $album["buylink"];
    $private = $album["private"] > 0;
    
/*    $title = urlencode("DeJan Photography - Album {$name}");
    $desc = urlencode($album["description"] . " " . $album["date"] . " - " . $album["location"]);
    $image = urlencode("http://www.dejan-photo.be/" . getFilePath($dir, $pic));
    $href = encodeURIComponent("http://www.dejan-photo.be/#gallery.php?a={$albumID}");
    
    $url = "http://www.dejan-photo.be/fbshare.php?d=" . $desc . "&t=" . $title . "&i=" . $image . "&u=" . $href;
    */
    $url = getFbShareLink("DeJan Photography - Album {$name}",
        $album["description"] . " " . $album["date"] . " - " . $album["location"],
        getFilePath($dir, $pic),
        getAbsolutePath("#gallery.php?a={$albumID}"));
?>
<div style="padding-bottom: 10px; height: 35px;">
    <? if (!$private) { ?>
    <div class="fb-like" data-href="<?=$url?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    <? } ?>
    
    <? if($buylink && strpos($buylink,"http") >= 0) { ?>
    <a id="buyLink" href="<?=$buylink?>" target="buylink" class="btn btn-primary glyphicon glyphicon-shopping-cart" style="float: right; padding: 2px 15px;"
        data-toggle="popover" title="Alle foto's" data-content="Op zoek naar alle foto's van dit evenement? Klik op deze knop!" data-placement="auto"></a>    
    <script>
    $().ready(function() {
        setTimeout(function() {
            $("#buyLink").popover("show");
        }, 5000);
    });
    </script>
    <? } ?>
</div>
<div>
<?
    foreach ($pics as $index => $pic) {
        $picID = $pic["id"];
        $filename = $pic["filename"];
        $imgSrc = getFilePath($dir, $filename);
        
        $buy = false;
//        $bigFile = getBigFilePath($imgSrc);
//        if ($bigFile) {
//            $buy = true;
//        } else {
//            $buy = false;
//        }
        
        $inBasket = isset($basket[$imgSrc]);
        $selectedClass = $inBasket ? "selected" : "";
        
        $basketButtonClass = "basketButt{$picID}";
    ?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail thumbnail-hovercaption thumbnail-animate <?=$selectedClass?>">
        <a href="#" onclick="showGallery(<?=$index?>); return false;">
            <img class="galleryItem" src="<?=$imgSrc?>" title="<?=$filename?>">
        </a>
        <?
        if ($buy == true) {
        ?>
        <div class="caption">
        <? if ($inBasket) { 
            $add = "none";
            $remove = "block";
        } else {
            $add = "block";
            $remove = "none";
        }
        ?>
            <a class="<?=$basketButtonClass?> btn btn-danger" style="display: <?=$remove?>" href="#" role="button" 
                    onclick="removeFromBasket('<?=$imgSrc?>'); $('.<?=$basketButtonClass?>').toggle(); $(this).closest('.thumbnail').removeClass('selected'); return false;">
                <span class="glyphicon glyphicon-remove"></span>
            </a>
            <a class="<?=$basketButtonClass?> btn btn-primary" style="display: <?=$add?>" href="#" role="button" 
                    onclick="addToBasket('<?=$dir?>','<?=$filename?>'); $('.<?=$basketButtonClass?>').toggle(); $(this).closest('.thumbnail').addClass('selected'); return false;">
                <span class="glyphicon glyphicon-share-alt"></span>
                <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
        </div>
        <? } ?>
    </div>
</div>
<?  } ?>
</div>
<? if (!$private) { ?>
<div class="fb-comments" data-href="<?=$url?>" data-numposts="5"></div>
<? } ?>