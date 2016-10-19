<?
    require "functions.php";

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        $pw   = $_POST["pw"];
        $name = $_POST["name"];
        $dir  = $_POST["dir"];
        $date = $_POST["date"];
        $loc  = $_POST["loc"];
        $desc = $_POST["desc"];
        $buylink = $_POST["buylink"];
        $private = $_POST["private"] || 0;

        if ($pw == "potloodje") {
            $db = getDB();
            
            $id = $db->insert("dejanAlbum", [
                    "name" => $name,
                    "dir" => $dir,
                    "date" => $date,
                    "description" => $desc,
                    "location" => $loc,
                    "buylink" => $buylink,
                    "private" => $private
                ]);
            //var_dump($db->error());
                
            $path = realpath(getDirPath($dir));
            $files = scandir($path);
            
            foreach ($files as $file) {
                if (preg_match("/\.jpg$/i", $file)) {
                    $db->insert("dejanPic", [
                        "album" => $id,
                        "filename" => $file
                    ]);    
                }
            }
            
            header("Location: http://www.dejan-photo.be/#gallery.php?a=" . $id);
            exit;
        } else {
            header("Location: http://www.dejan-photo.be/#error.php?e=Busted!");
            exit;
        }
    } else {
?>
<div class="panel panel-default">
    <div class="panel-heading">Voeg album toe</div>
    <div class="panel-body">
        <form action="http://www.dejan-photo.be/addAlbum.php" method="POST">
            <input class="form-control" name="name" placeholder="Naam" required> <br/>
            <input class="form-control" name="dir" placeholder="Folder" required> <br/>
            <input class="form-control" name="date" placeholder="Datum" required> <br/> 
            <input class="form-control" name="loc" placeholder="Locatie" required> <br/> 
            <input class="form-control" name="desc" placeholder="Omschrijving" required> <br/>
            <input class="form-control" name="buylink" placeholder="Buy link"> <br/>
            <input type="checkbox" class="form-control" name="private" value="1">Private? <br/>

            <input class="form-control" type="password" placeholder="Paswoord" name="pw" required> <br/>
            <button type="submit" class="btn btn-primary">Voeg toe</button>
        </form>
    </div>
</div>
<? 
    } 
?>