<?
    $showError = true;
    $error = $_GET["e"];
    if (!isset($error) || strlen($error) == 0) {
        $showError = false;
    }
?>

<div class="jumbotron jumbotron-danger">
    <h3>Er ging iets mis!</h3>
    <? if ($showError == true) { ?>
    <p><?=$error?></p>
    <? } ?>
    <p>Contacteer mij via <a href="#" onclick="loadPage('contact.php'); return false;">deze pagina</a> en vermeld de bovenstaande foutboodschap.</p>
</div>