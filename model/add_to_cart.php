<?php
if (isset($_GET['page'])) {
    $page_output = "../shop.php?page=" . $_GET['page'];
} else {
    $page_output = "../shop.php?page=" . "1";
}


if (isset($_GET['id'])) {
    setcookie('lastAddedProduct', $_GET['id'], time() + 3600, '/');
    

    if (isset($_COOKIE['cart'])) {
        setcookie('cart', $_COOKIE['cart'] . ' ' . $_GET['id'], time() + 3600, '/');
        header('location:' . $page_output);
    } else {
        setcookie('cart', $_GET['id'], time() + 3600, '/');
        header('location:' . $page_output);
    }
}