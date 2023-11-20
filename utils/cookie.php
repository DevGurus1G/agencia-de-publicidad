<?php
//Por defecto modo claro
$modo;
if(isset($_COOKIE['modo'])){
    $modo = $_COOKIE['modo'];
}else{
    $modo = "light";
}