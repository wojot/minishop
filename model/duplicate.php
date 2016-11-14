<?php
include_once('db_connect.php');
if (isset($_COOKIE['permission']) && $_COOKIE['permission'] == 1) {
    if ($_GET['id_product'] >= 0 && is_numeric($_GET['id_product'])) {

        $product_duplicated = $_GET['id_product'];

        if ($stmt = $mysqli->prepare("SELECT * FROM products WHERE id_product = ?")) {
            $stmt->bind_param("i", $product_duplicated);
            $stmt->execute();
            $stmt->bind_result($id_product, $name, $description, $price, $category, $path);
            $stmt->fetch();
            $stmt->close();


            $stmt = $mysqli->prepare("INSERT INTO products VALUES (NULL, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssdii", $name, $description, $price, $category, $path);
            $stmt->execute();
            $stmt->close();

        } else {
            echo "blad inputu";
        }

    } else {
        echo "Nieprawidlowy produkt";
    }

    $mysqli->close();

    header('Location: ../shop.php?page=' . $_GET['page'] . '&success=3');
}