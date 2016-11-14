<?php

include_once('db_connect.php');


if (isset($_COOKIE['lastAddedProduct'])) {

    getProductName($_COOKIE['lastAddedProduct'], $mysqli);
}

function getProductName($id, &$mysqli)
{
    if (isset($_GET['page'])) {
        $page_output = "shop.php?page=" . $_GET['page'];
    } else {
        $page_output = "shop.php?page=" . "1";
    }

    $q = $mysqli->query("SELECT name, price FROM products WHERE id_product=" . $id);
    $result = $q->fetch_assoc();

    if (isset($_COOKIE['sumOfCart']) && strlen($_COOKIE['cart']) != $_COOKIE['controlSum']) {

        $sum = $_COOKIE['sumOfCart'] + $result['price'];
        setcookie('sumOfCart', $sum, time() + 3600, '/');
        $controlSumValue = strlen($_COOKIE['cart']);
        setcookie('controlSum', $controlSumValue, time() + 3600, '/');
        setcookie('amountOfProducts', $_COOKIE['amountOfProducts'] + 1, time() + 3600, '/');
        setcookie('lastName', $result['name'], time() + 3600, '/');
        setcookie('lastPrice', $result['price'], time() + 3600, '/');

        header("location: " . $page_output);
    }
    if (!isset($_COOKIE['sumOfCart'])) {
        setcookie('lastName', $result['name'], time() + 3600, '/');
        setcookie('lastPrice', $result['price'], time() + 3600, '/');
        setcookie('sumOfCart', $result['price'], time() + 3600, '/');
        setcookie('amountOfProducts', 1, time() + 3600, '/');
        setcookie('controlSum', 1, time() + 3600, '/');

        header("location: " . $page_output);
    }
    $q->close();
}


