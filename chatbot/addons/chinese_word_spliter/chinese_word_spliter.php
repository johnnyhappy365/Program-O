<?php

include(__DIR__ . "/../aip_nlp/Nlp.php");

function splitChineseWord($text)
{
    $result = implode(' ', (explode("\t", trim(wordseq($text)["scw_out"]["wordsepbuf"]))));
//    var_dump($result);
    return $result;
//    return implode(' ', ch2arr($text));
}

function ch2arr($str)
{
    $length = mb_strlen($str, 'utf-8');
    $array = [];
    for ($i=0; $i<$length; $i++)
        $array[] = mb_substr($str, $i, 1, 'utf-8');
    return $array;
}
