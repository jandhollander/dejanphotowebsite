<?
            $path = realpath("vlp-melsele");
            $files = scandir($path);

            foreach($files as $file) {
                echo $file;
                if (preg_match("/\.jpg$/i", $file)) {
                    echo " FOTO <br/>";
                } else {
                    echo "<br/>";
                }
            }