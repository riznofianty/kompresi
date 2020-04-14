<?php

$file = "helo.txt";

function getTextInside($file)
{
    $myfile = fopen($file, "r") or die("Unable to open file!");
    $textInside =  fread($myfile, filesize($file));
    fclose($myfile);
    return $textInside; // in normal string
}

$text = (getTextInside($file));

function sortArraySensitiveCase($text)
{
    $keys = array_merge(range('a', 'z'), range('A', 'Z'));
    $values = array_fill(0, 52, 0);
    $freq = array_combine($keys, $values);
    $word = $text;
    $len = strlen($word);
    for ($i = 0; $i < $len; $i++) {
        $letter = $word[$i];
        if (array_key_exists($letter, $freq)) {
            $freq[$letter]++;
        }
    }
    print_r($freq);
}

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


echo (sortArrayCount($text));

// echo strlen($text);
