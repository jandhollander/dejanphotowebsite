<?php
session_start();

$basket = $_SESSION["basket"];
$nrbasket = isset($basket) ? count($basket) > 0 ? count($basket) : "" : "";

$theme = $_GET["theme"];
if (!isset($theme)) {
    $theme = "paper";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <meta name="verification" content="d4c2cfacef1a7aa7fa2e94de4a2e269a" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="icon" type="image/png" href="aperture.png">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/<?=$theme?>/bootstrap.min.css">
    <!--<link rel="stylesheet" href="theme/<?=$theme?>.min.css">-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="blueimp/js/blueimp-gallery.min.js"></script>
    <link rel="stylesheet" href="blueimp/css/blueimp-gallery.min.css">
    
    <script type="text/javascript" src="pongstagram/pongstagr.am.min.js"></script>
    
    <script type="text/javascript" src="360slider/threesixty.js"></script>
    
    <!-- Site functionality -->
    <script src="functions.js"></script>
    <link rel="stylesheet" href="style.css"></link>
    <link rel="stylesheet" href="toggle-switch.css"></link>
    <script src="tmpl.js"></script>
    
    <title>DeJan Photography</title>

    <!-- ISOGRAM -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-39897465-4', 'auto');
      ga('send', 'pageview');
    
    </script>
    
    <!-- SMARTLOOK -->
    <script type="text/javascript">
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='//rec.getsmartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', 'd1e7ccf4c65826261f9d02ded379666bc184bf87');
    </script>
  </head>
  <body>
    <div id="fb-root"></div>  
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '626367980799697',
          xfbml      : true,
          version    : 'v2.4'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
      
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" onclick="loadPage('home.php', 'Home'); return false;" class="navbar-brand">
            <span><img src="aperture.png" style="height: 30px"/></span>
            <span class="specialFont" style="text-shadow: 2px 2px #555">DeJan Photography</span>
          </a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
                <a href="#" onclick="showAlbums(); return false;">Albums</a>
            </li>
            <li>
                <a href="http://www.oypo.be/dejan" target="_blank">Events</a>
            </li>
            <li>
                <a href="#" onclick="loadPage('instagram.html', 'Instagram'); return false;">Instagram</a>
            </li>
            <li>
                <a href="#" onclick="loadPage('materiaal.php', 'Materiaal', 'Wat ik allemaal meesleur'); return false;">Materiaal</a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
<!--            <li>
                <a href="#" onclick="fbShare(); return false;">Share</a>
            </li>-->
            <li>
                <a href="#" onclick="loadPage('contact.php', 'Contact'); return false;">Contact</a>
            </li>
<!--            <li>
                <a href="#" onclick="showBasket(); return false;">Winkelwagen <span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge" id="cartNr"><?=$nrbasket?></span></a>
            </li>-->
          </ul>

        </div>
      </div>
    </div>
    <div class="container">
        ::before
        <div id="page-header" class="page-header">
            <h1><span id="title"></span> <small id="subtitle"></small></h1>
        </div>
        <div id="content" class="bs-docs-section"></div>
    </div>
    <div class="navbar navbar-fixed-bottom footer">
        <div class="container">
            <div class="nav navbar-nav navbar-right">
                &copy; <?php echo date("Y") ?> Jan D'Hollander, All rights reserved
            </div>
        </div>
    </div>
    
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <script>loadAlbums(function() {start();});</script>
  </body>
</html>