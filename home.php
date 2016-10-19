<?
    require "functions.php";
    
    session_start();

    $db = getDB();
    
    $albums = $db->select("dejanAlbum", "*", ["private" => 0, "ORDER" => "id DESC"]);
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <? 
        foreach ($albums as $index => $album) { 
            if ($index < 5) {
                if ($index == 0) {
                    $className = "active";
                } else {
                    $className = "";
                }
        ?>
        <li data-target="#myCarousel" data-slide-to="<?=$index?>" class="<?=$className?>"></li>
            <? } ?>
        <? } ?>
    </ol>
    <div class="carousel-inner">
        <? foreach ($albums as $index => $album) { 
            if ($index < 5) {
                if ($index == 0) {
                    $className = "active";
                } else {
                    $className = "";
                }
                $dir = $album["dir"];
                $albumID = $album["id"];
                $pics = $db->select("dejanPic", "*", ["album" => $albumID]);
                $fileName = $pics[0]["filename"];
                $imgSrc = getFilePath($dir, $fileName);  
                $nrPicsMore = count($pics) - 1;
                $albumName = $album["name"];
                $albumDate = $album["date"];
                $albumLocation = $album["location"];

        ?>
        <div class="item <?=$className?>"> 
            <img src="<?=$imgSrc?>" style="width:100%" data-src="holder.js/900x500/auto/#7cbf00:#fff/text: " alt="<?=$albumName?>">
            <div class="container">
                <div class="carousel-caption">
                    <h1> <?=$albumName?> </h1>
                    <p> <?=$albumDate?> - <?=$albumLocation?> </p>
                    <button type="button" class="btn btn-primary" onclick='loadAlbum(albums[<?=$albumID?>]); return false;'><?=$nrPicsMore?> meer</button>
                </div>
            </div>
        </div>
            <? } ?>
        <? } ?>
    </div>
    
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
     
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
