<?php
function replaceString($str)
{
    $str = str_replace('"', "", $str);
    $str = str_replace('"', "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace(">", "", $str);
    $str = str_replace("<", "", $str);
    $str = str_replace("!=", "", $str);
    return $str;
}
