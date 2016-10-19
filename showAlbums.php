<?
    require "functions.php";
    
    session_start();
    
    $db = getDB();
    
    $albums = $db->select("dejanAlbum", "*", ["private" => 0, "ORDER" => "id DESC"]);
?>
<div class="row">
<? 
    foreach ($albums as $index => $album) {
        if ($index > 0 && $index % 3 == 0) {
?>
</div>
<div class="row">
<? 
        }
        $dir = $album["dir"];
        $albumID = $album["id"];
        $pics = $db->select("dejanPic", "*", ["album" => $albumID]);
        $filename = $pics[0]["filename"];
        $imgSrc = getFilePath($dir, $filename);
        $albumName = $album["name"];
        $albumDate = $album["date"];
        $albumLocation = $album["location"];
        $albumDescription = $album["description"];
?>
<div class="col-sm-12 col-md-4">
    <a href="#" onclick='loadAlbum(albums[<?=$albumID?>]); return false;'>
        <div class="thumbnail thumbnail-animate">
            <img src="<?=$imgSrc?>" alt="<?=$albumName?>">
            <div class="banner"><?=count($pics)?></div>
            <div class="caption">
                <h3><?=$albumName?></h3>
                <p><?=$albumDate?> - <?=$albumLocation?></p>
                <p><?=$albumDescription?></p>
            </div>
        </div>
    </a>
</div>
<? 
    } 
?>
</div>
