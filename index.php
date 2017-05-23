<?php
header("Content-Type: text/html; charset=utf-8");
//error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once (dirname(__FILE__).'/application/config.php');
session_start();
Config::set();
Route::start(); // запускаем маршрутизатор
