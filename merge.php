<?php
// palasten kansio
$tmp_path = "tmp/";
// kokonaisen tiedoston kansio
$target_path = "uploads/";
// alkup. tiedostonimi
$name = $_GET['name'];
// osien lkm
$count = $_GET['count'];
// kohdetiedoston polku+nimi
$target_file = $target_path . $name;

// tehdään kohdetiedosto
$out = fopen($target_file, "w");

// luetaan palaset ($in) ja lisätään ne kohdetiedostoon ($out)
for ($i = 1; $i <= $count; $i++) {
    $in = fopen($tmp_path . $i . $name, "r");
    while ($line = fread($in, 1024 * 1024)) {
        fwrite($out, $line);
    }
    fclose($in);
}
fclose($out);
echo '{"result": "' . $target_file . '"}';


// poistetaan palaset
for ($i = 1; $i <= $count; $i++) {
    if (file_exists($tmp_path . $i . $name))
        unlink($tmp_path . $i . $name);
}

?>