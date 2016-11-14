<?php
include_once(ROOT . "model/db_connect.php");

if (isset($_GET['logout'])) {
    // header('location:' . HTTP . 'index.php?wylogowano2='.$_COOKIE['id']);

    if (isset($_COOKIE['id'])) {
        $q = mysqli_query($mysqli, "delete from session where user_id = '$_COOKIE[id_user]' and web = '$_SERVER[HTTP_USER_AGENT]';");


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

}
