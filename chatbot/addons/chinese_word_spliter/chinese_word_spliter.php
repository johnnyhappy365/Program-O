<?php

spl_autoload_register(function ($class) {
    if ($class) {
        $file = str_replace('\\', '/', $class);
        $file .= '.php';
        if (strpos($file, 'app/library/thirds') === 0) {
            $file = __DIR__ . "/../../../../" . str_replace('app/library/thirds/', '', $file);

        }
        if (file_exists($file)) {
            include $file;
        }
    }
});

use app\library\thirds\aip_nlp\Nlp;


function splitChineseWord($text)
{
//    处理没有用的语气词
    $pattern = '[哈|啊|嘛|呢|啦|了]';
    mb_regex_encoding('utf-8');
    $text = mb_ereg_replace($pattern, '', $text);


    $result = implode(' ', Nlp::wordseq($text));
    return $result;
}

function ch2arr($str)
{
    $length = mb_strlen($str, 'utf-8');
    $array = [];
    for ($i=0; $i<$length; $i++)
        $array[] = mb_substr($str, $i, 1, 'utf-8');
    return $array;
}
