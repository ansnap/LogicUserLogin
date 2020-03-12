<?php

require_once 'config.php';
require_once 'functions.php';

/**
 * Установка соединения с MySQL
 */
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    exit('Error: ' . $e->getMessage());
}

/**
 * Загрузка файла языка по GET параметру 'lang', например ?lang=ru
 */
$lang = filter_input(INPUT_GET, 'lang');
$lang_file = "languages/$lang.php";

if ($lang && file_exists($lang_file)) {
    require_once $lang_file;
}

