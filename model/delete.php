<?php

include('db_connect.php');

if(isset($_GET['id_product']) && is_numeric($_GET['id_product'])){
    if(isset($_COOKIE['permission'])&&$_COOKIE['permission']==1) {


        $id_product = $_GET['id_product'];

        if ($stmt = $mysqli->prepare("DELETE FROM products WHERE id_product = ? LIMIT 1")) {
            $stmt->bind_param("i", $id_product);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Błąd zapytania";
        }

        $mysqli->close();

        header("Location: ../shop.php?success=2");

    }
} else {
    header("Location: ../shop.php");
}