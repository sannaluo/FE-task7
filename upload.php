<?php
// palasten kansio
$tmp_path = "tmp/";
// php tallentaa saapuvat palaset paikkaan 'tmp_name'
$tmp_name = $_FILES['file']['tmp_name'];
// alkup. tiedostonnimi
$name = $_FILES['file']['name'];
// osan numero
$part = $_POST['part'];

$target_file = $tmp_path . $part . $name;
// Open temp file
$out = fopen($target_file, "a");

if ($out) {
    // Read binary input stream and append it to temp file
    $in = fopen($tmp_name, "r");
    if ($in) {
        while ($buff = fread($in, 1024 * 1024)) {
            fwrite($out, $buff);
        }
    }
    fclose($in);
    fclose($out);
    echo '{"part": "' . $part . '"}';
}