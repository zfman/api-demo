
<?php
header("content-type:text/html;charset=utf-8");
error_reporting(E_ALL || ~E_NOTICE);

session_start();

$c=$_GET['c'];
$c_name=$c."Controller";
$c_path='controller/'.$c_name.'.php';

$method=$_GET['a'];
require ($c_path);
$controller=new $c_name;
$controller->$method();

    ?>