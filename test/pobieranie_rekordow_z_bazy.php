<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
include_once('../model/db_connect.php');
if (!$polaczenie = $mysqli->query("SELECT * FROM products ORDER BY id_product")) {
    echo "blad bazy";
} else {

    $test=$polaczenie->fetch_all();
    foreach ($test as $a){
        echo $a[0]." ".$a[1]."<br />";

    }

//    while ($wiersz = $polaczenie->fetch_object()) {
//        echo "<p>" . $wiersz->id_produkty . " " . $wiersz->name . "</p>";
//    }

}

$polaczenie->close();

?>
</body>
</html>