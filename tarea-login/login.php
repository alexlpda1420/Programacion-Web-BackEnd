<?php

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$check_user = "admin";
$check_pass = "12345";

if ($usuario == $check_user && $password == $check_pass) {
    header ("location:https://www.potrerodigital.org/");
} else {
    header ("location:error.html");
}