albums = null;
basket = {};
base_url = "http://www.dejan-photo.be";

loadAlbums = function(/*Function*/ onLoad) {
    if (albums === null) {
        $.getJSON( "albums.php", function( data ) {
            albums = data;
            var links = [];
          
            if (onLoad) {
                onLoad();
            }
        });
    } else {
        if (onLoad) {
            onLoad();
        }
    }
};

showAlbums = function() {
    loadAlbums(function() {
        loadPage("showAlbums.php", "Albums");

        updateFBInfo({
            title: "DeJan Photography - Albums",
            desc: "Alle albums van DeJan Photography.",
            image: "http://www.dejan-photo.be/" + albums[0].dir + "/" + albums[0].pics[0]
        });
    });
};

loadAlbum = function(album) {
    loadAlbums(function() {
        loadPage("gallery.php?a=" + album.id, album.name, album.date + " - " + album.location, album);
        
        updateFBInfo({
            title: "DeJan Photography - Album " + album.name,
            desc: album.description + " " + album.date + " - " + album.location,
            image: "http://www.dejan-photo.be/" + album.dir + "/" + album.pics[0]
        });
    });
};

loadPage = function(url, title, subtitle, context) {
    if (url.indexOf(".php") >= 0) {
        return loadPageNoTemplate(url, title, subtitle);
    }
    
    var hashPart = context ? context.dir : "";
    context = context || {albums:albums};
    setTitle(title, subtitle);
    $("#content").empty();
    $.get(url, function(data) {
        var scripts = extractScripts(data);
        
        data = data.replace(/[\n\r]/ig, "");
        data = data.replace(/<script>.*<\/script>/ig, "");
        
        // console.log(data);
        
        $("#content").html(tmpl(data, context));
        try {
            FB.XFBML.parse($("#content").get(0));
        } catch (e) {} 
        for (x in scripts) {
            //console.log(scripts[x]);
            eval(scripts[x]);
        }
    });
    
    setHash(url, hashPart);

    updateFBInfo({
        title: "DeJan Photography - " + title,
        desc: subtitle,
        image: "http://www.dejan-photo.be/aperture.png"
    });
};

var SCRIPT_OPEN = "<script>";
var SCRIPT_CLOSE = "</script>";

extractScripts = function(data) {
    var result = [];
    var counter = 0;
    while (data.indexOf(SCRIPT_OPEN) >= 0) {
        var index = data.indexOf(SCRIPT_OPEN);
        data = data.substring(index + SCRIPT_OPEN.length);
        
        var closeIndex = data.indexOf(SCRIPT_CLOSE);
        result[counter] = data.substring(1, closeIndex);
        counter++;
        data = data.substring(closeIndex + SCRIPT_CLOSE.length);
    }
    // console.log(result);
    return result;
};

loadPageNoTemplate = function(url, title, subtitle, onfinish) {
    setTitle(title, subtitle);
    $("#content").empty();
    $.get(url, function(response){
        $("#content").html(response);
        if (onfinish) {
            onfinish();
        }
        
        try {
            FB.XFBML.parse($("#content").get(0));
        } catch (e) {}   
    });
    
    setHash(url);

    updateFBInfo({
        title: "DeJan Photography - " + title,
        desc: subtitle,
        image: "http://www.dejan-photo.be/aperture.png"
    });
};

showGallery = function(index) {
    var options = {
        index: index,
        urlProperty: "src"
    };
    
    var gallery = $(".galleryItem");
    
    blueimp.Gallery(gallery, options);
};

showBasket = function() {
    loadPageNoTemplate("basket.php", "Winkelwagen", "", updateBasket);
};

setTitle = function(title, subtitle) {
    if (title) {
        $("#title").html(title);
        $("#subtitle").html(subtitle ? subtitle : "");
    }
};

setHash = function() {
    var path = $.makeArray(arguments).join("/");
    ignoreHash = true;
    window.location.hash = "#" + path;
    setTimeout(function() {
        ignoreHash = false;
    }, 100);
    
    if (ga) {
        ga('send', 'pageview', path);
    }
};

start = function() {
    var hash = window.location.hash;
    if (hash.length > 0) {
        hash = hash.substring(1);
        var parts = hash.split("/");
        var page = parts[0];
        var title = parts[0].substring(0,1).toUpperCase() + parts[0].substring(1).split(".")[0];
        var subtitle;
        var context;
        if (parts.length > 1) {
            var dir = parts[1];
            for (var i=0 ; i<albums.length ; i++) {
                var album = albums[i];
                if (album.dir == dir) {
                    title = album.name;
                    subtitle = album.date + " - " + album.location;
                    context = album;
                }
            }
        }
        
        if (page == "basket.php") {
            showBasket();
        } else {
            loadPage(page, title, subtitle, context);
        }
    } else {
        loadPage("home.php", "Home");  
    }
};

ignoreHash = false;
window.onhashchange = function() {
    if (ignoreHash === false) {
        start();
    }
};

addToBasket = function(dir, pic) {
    $.post("basket.php", {
        key: dir + "/" + pic
    }, function(response) {
        if (response > 0) {
            $("#cartNr").html(response);
        } else {
            $("#cartNr").empty();
        }
    });
};

removeFromBasket = function(key) {
    $.ajax("basket.php?" + $.param({
                key: key
            }),
        {
        success: function(response) {
            if (response > 0) {
                $("#cartNr").html(response);
            } else {
                $("#cartNr").empty();
            }
        },
        method: "DELETE"
    });
};

updateFBInfo = function(options) {
    fbInfo = options;   
    // console.log(fbInfo);
};

fbShare = function() {
    var url = encodeURIComponent(window.location.href);
    var desc = encodeURI(fbInfo.desc || fbInfo.title);
    var title = encodeURI(fbInfo.title);
    var image = encodeURI(fbInfo.image);
    
    var href = "http://www.dejan-photo.be/fbshare.php?d=" + desc + "&t=" + title + "&i=" + image + "&u=" + url;
    //console.log(href);
   
    try {
        FB.ui({
          method: 'share',
          href: href,
        }, function(response){});
    } catch (e) {}
};

preventRMB = function() {
    var images = $("img");
    images.on("contextmenu", function(e) {
        e.preventDefault();
    });  
    images.on("dragstart", function(e) {
        e.preventDefault(); 
    });
};
setInterval(preventRMB, 100);

removeElement = function(jquery, onfinish) {
    jquery.css("transition", "none");
    jquery.animate({
        opacity: 0,
        width: 0
    }, 500, function() {
        jquery.remove();
        if (onfinish) {
            onfinish();
        }
    });
};

updateBasket = function() {
    q=$('#quantity');
    q.val($('.basketItem').length);
    if (q.val() <= 0) {
        $("#ppButton").hide();
        $("#notEmptyDiv").hide();
        
        jumbo = $("#emptyDiv");
        jumbo.css({
            opacity: 0,
            display: "block"
        });
        jumbo.animate({
            opacity: 1
        }, 250)
    } else {
        $("#ppButton").show();
        $("#notEmptyDiv").show();
        $("#emptyDiv").hide();
    }
};

sendEmail = function(form) {
    $.post(form.action, $(form).serialize());
};


