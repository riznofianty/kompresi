<?php

//fungsi ini untuk memasukkan semua string yang ada di file txt ke dalam variabel
function getTextInside($file)
{
    $myfile = fopen($file, "r") or die("Unable to open file!");
    $textInside =  fread($myfile, filesize($file));
    fclose($myfile);
    return $textInside;
}
//fungsi ini untuk menghitung setiap baik huruf dan angka yang ada didalam file txt tersebut, dan memformatnya kedalam format array
function sortArrayCount($text)
{
    $freq = array();
    $word = $text;
    $len = strlen($word);
    for ($i = 0; $i < $len; $i++) {
        $letter = $word[$i];
        if (array_key_exists($letter, $freq)) {
            $freq[$letter]++;
        } else {
            $freq[$letter] = 1;
        }
    }
    print_r($freq);
}

if (isset($_POST['compress'])) {
    //untuk mengambil nama filenya
    $file = $_POST['file-compress'];

    //menjalankan fungsi yang diatas dalam menjalankan filenya
    $text = getTextInside("file/" . $file);
    echo "file name : $file <br>";
    echo sortArrayCount($text);
}
