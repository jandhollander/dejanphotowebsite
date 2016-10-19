<?
session_start();

$basket = $_SESSION["basket"];
if (!isset($basket)) {
    $basket = array();
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $key = $_POST["key"];
    
    $bigUrl = str_replace("/", "/big/", $key);
    
    $basket[$key] = $bigUrl;
    
    $_SESSION["basket"] = $basket;

    echo count($basket);
} else if ($method == "DELETE") {
    $key = $_REQUEST["key"];

    unset($basket[$key]);

    $_SESSION["basket"] = $basket;

    echo count($basket);
} else if ($method == "GET") {
?>

<div class="jumbotron">
    <h1 id="emptyDiv" style="display: none">Je winkelwagen is leeg!</h1>
    <h1 id="notEmptyDiv">Deze foto's zitten in je winkelwagen!</h1>
    <p>Vind je mijn werk leuk en wil je me steunen om nog betere foto's te kunnen maken?<br/>
    Wil je mijn foto's gebruiken om af te drukken, in een zoekertje of gewoon om te sharen op facebook?<br/>
    Voor een zelf te kiezen bedrag per foto, kan je meteen de gekozen digitale foto's downloaden op hoge resolutie en mag je ermee doen wat je maar wil.<br/>
    <ol>
    <li>Ga naar de <a href="#" onclick="showAlbums(); return false;">albums</a> en laad je winkelwagen vol met foto's.</li>
    <li>Kies daarna hieronder het te schenken bedrag per foto en betaal veilig met Paypal.</li>
    <li>Je kan de gekozen foto's meteen downloaden en je ontvangt een email waarmee je ze later ook nog kan downloaden.</li>
    </ol>
    </p>
    <h3>Eenvoudiger kan niet!</h3>
</div>

<div class="row">
<?php foreach ($basket as $key => $item) { 
    $size = getimagesize($item);?>
<div class="basketItem col-sm-6 col-md-4">
    <div class="thumbnail thumbnail-hovercaptiona">
        <a href="#" onclick="showGallery($(this).children()[0]); return false;">
            <img class="galleryItem" src="<?=$key?>">
        </a>
        <div class="caption">
            Grootte: <?=$size[0]?>x<?=$size[1]?><br/>
            <a href="#" class="btn btn-danger" role="button" onclick="removeFromBasket('<?=$key?>'); removeElement($(this).closest('.basketItem'), updateBasket); return false;">
                <span class="glyphicon glyphicon-remove"></span>
            </a>
        </div>
    </div>
</div>
<?php } ?>
</div>

<?php 
    $count = count($basket);?>
<div class="row" style="padding-bottom: 50px">
    <?/*<form id="ppButton" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" onsubmit="this.item_number.value = this.amount.value;">*/?>
    <form id="ppButton" action="https://www.paypal.com/cgi-bin/webscr" method="post" onsubmit="this.item_number.value = this.amount.value;">
        <div class="btn-group" data-toggle="buttons" style="padding-bottom: 20px">
            <label class="btn btn-default">
                <input type="radio"name="amount" value="50" /> €50
            </label> 
            <label class="btn btn-default active">
                <input type="radio" name="amount" value="25" checked /> €25
            </label> 
            <label class="btn btn-default">
                <input type="radio" name="amount" value="15" /> €15
            </label> 
            <label class="btn btn-default">
                <input type="radio" name="amount" value="10" /> €10
            </label> 
            <label class="btn btn-default">
                <input type="radio" name="amount" value="5" /> €5
            </label> 
        </div>
        <input type="hidden" name="cmd" value="_xclick">
        <!--<input type="hidden" name="amount" value="25">-->
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="item_name" value="Digitale foto's">
        <input type="hidden" id="item_number" name="item_number" value="25">
        <input id="quantity" type="hidden" name="quantity" value="<?=$count?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="lc" value="BE">
        <input type="hidden" name="return" value="http://www.dejan-photo.be/delivery.php">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="cancel_return" value="http://www.dejan-photo.be/#basket.php">
        
        <input type="hidden" name="business" value="6J7YXS2Y8T9TU">
        <?/*<input type="hidden" name="business" value="jan.dhollander-facilitator@pandora.be">*/?>
        
        <div class="input-group" style="margin-bottom: 10px">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input class="form-control" type="email" placeholder="Je emailadres" required name="custom">        
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit" border="0">Doneer nu!</button>
    </form>
</div>
<?php } ?>
