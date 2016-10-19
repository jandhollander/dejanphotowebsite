<?
    require "functions.php";
    
    $id = $_GET["r"];
    $email = $_GET["e"];
    $index = $_GET["i"];
    
    $db = getDB();
    
    $datas = $db->select("dejanOrder", "*", [
        "AND" => [
            "id" => $id,
            "email" => $email
        ]
    ]);
    
    $errorUrl = "http://www.dejan-photo.be/#error.php?e=";
    
    $count = count($datas);
    if ($count == 1) {
        $data = $datas[0];
        $imgs = explode(",", $data["order"]);
        if ($index < count($imgs)) {
            $img = $imgs[$index];
            
            $real = getBigFilePath($img);
            $basename = basename($real);
    
            if (!$real) {
                // file not found
                header("Location: " . $errorUrl . urlencode("File not found ($id,$email,$index,$real)"));
            } else {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$basename");
                header("Content-Type: image/jpg");
                header("Content-Transfer-Encoding: binary");
                
                readfile($real);
                
                exit;
            }
        } else {
            header("Location: " . $errorUrl . urlencode("Index not correct ($id,$email,$index)"));
        }
    } else {
            header("Location: " . $errorUrl . urlencode("No data found ($id,$email,$index)"));
    }
?>