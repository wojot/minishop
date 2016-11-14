<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sklep internetowy</title>

    <!-- Bootstrap -->
    <link href="http://localhost/php/pai_git/css/bootstrap.css" rel="stylesheet">
    <link href="http://localhost/php/pai_git/css/bootstrap-theme.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
<script>
    onload = function czyon(){
        var item = document.getElementById("brakjs");
        item.style.display = 'none';
    }
</script>

</head>
<body>

<?php
if (!isset($_COOKIE['nick'])) {

    setcookie("id", 0, time() - 1, "/");
    unset($_COOKIE['id']);
    setcookie("id_user", 0, time() - 1, "/");
    unset($_COOKIE['id_user']);

    setcookie("nick", 0, time() - 1, "/");
    unset($_COOKIE['nick']);
    setcookie("email", 0, time() - 1, "/");
    unset($_COOKIE['email']);
    setcookie("permission", 0, time() - 1, "/");
    unset($_COOKIE['permission']);
    setcookie("name", 0, time() - 1, "/");
    unset($_COOKIE['name']);
    setcookie("surname", 0, time() - 1, "/");
    unset($_COOKIE['surname']);
    setcookie("city", 0, time() - 1, "/");
    unset($_COOKIE['city']);
    setcookie("street", 0, time() - 1, "/");
    unset($_COOKIE['street']);
    setcookie("tel", 0, time() - 1, "/");
    unset($_COOKIE['tel']);


    setcookie("amountOfProducts", 0, time() - 1, "/");
    unset($_COOKIE['amountOfProducts']);
    setcookie("cart", 0, time() - 1, "/");
    unset($_COOKIE['cart']);
    setcookie("controlSum", 0, time() - 1, "/");
    unset($_COOKIE['controlSum']);
    setcookie("lastAddedProduct", 0, time() - 1, "/");
    unset($_COOKIE['lastAddedProduct']);
    setcookie("sumOfCart", 0, time() - 1, "/");
    unset($_COOKIE['sumOfCart']);
    setcookie("lastPrice", 0, time() - 1, "/");
    unset($_COOKIE['lastPrice']);
    setcookie("lastName", 0, time() - 1, "/");
    unset($_COOKIE['lastName']);
}


?>