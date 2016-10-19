<?
require "functions.php";

$db = getDB();

$method = $_SERVER["REQUEST_METHOD"];

if ("GET" == $method) {
    $data = $db->select("dejanAlbum", "*", ["private" => 0, "ORDER" => "id DESC"]);

    foreach ($data as $albumkey => $album) {
        $pics = $db->select("dejanPic", "*", ["album" => $album["id"]]);
        
        $picarray = array();
        
        foreach ($pics as $key => $pic) {
            $filename = $pic["filename"];
            $picarray[$key] = $filename;
        }
        $album["pics"] = $picarray;
        $data[$album["id"]] = $album;
    }
} else {
    $data = "Nothing done";
}

echo json_encode($data);

?>
