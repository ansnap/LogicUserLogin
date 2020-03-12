<?php

/**
 * Возвращает перевод строки
 */
function __t($str) {
    global $lang_arr;

    if (isset($lang_arr[$str])) {
        return $lang_arr[$str];
    }

    return $str;
}
