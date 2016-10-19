<?
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

$title = $_GET["t"];
$desc = $_GET["d"];
$img = $_GET["i"];
$url = $_GET["u"];

?>
<html>
    <head>
        <!-- Facebook -->
        <meta property="og:url"                content="<? echo curPageURL(); ?>" />
        <meta property="og:title"              content="<?=$title?>" />
        <meta property="og:description"        content="<?=$desc?>" />
        <meta property="og:image"              content="<?=$img?>" />
        <meta property="og:image:url"          og-type="url" content="<?=$img?>" />
        
        <meta http-equiv="refresh" content="0;URL='<?=$url?>'" />
    </head>
    <body>
    </body>
</html>
