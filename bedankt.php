<?
    require "functions.php";
    $email = $_GET["e"];
    $id = $_GET["r"];
    
    $db = getDB();
    
    $datas = $db->select("dejanOrder", "*", [
        "AND" => [
            "id" => $id, 
            "email" => $email
        ]
    ]);
?>
<div class="jumbotron">
    <h3>Bedankt voor je bestelling!</h3>
    <p>Je kan je bestelde foto's hieronder downloaden door op de groene knop bij elke foto te klikken.</p>
    <p>Als het niet lukt of er is iets niet duidelijk, kan je mij altijd contacteren via <a href="#" onclick="loadPage('contact.php'); return false;">deze pagina</a>.</p>
</div>
<?
    foreach($datas as $data) {
        $imgs = explode(",", $data["order"]);
        foreach($imgs as $index => $img) {
            if (strlen($img) > 0) {
        ?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail thumbnail-hovercaption">
        <a href="#" onclick="showGallery(<?=$index-1?>); return false;">
            <img class="galleryItem" src="<?=$img?>" alt="">
        </a>
        <div class="caption">
            <a class="btn btn-success" href="http://www.dejan-photo.be/download.php?r=<?=$id?>&e=<?echo urlencode($email);?>&i=<?=$index?>" role="button">
                <span class="glyphicon glyphicon-download-alt"></span>
            </a>
        </div>
    </div>
</div>
<?
            }
        }
    }

?>