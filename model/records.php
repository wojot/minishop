<?php
include('db_connect.php');


if (isset($_GET['id_product'])) {
    /* tryb edycji */
    if (isset($_POST['submit'])) {

        if (is_numeric($_POST['id_product'])) {
            $id_product = $_POST['id_product'];
            $name = htmlentities($_POST['name'], ENT_QUOTES);
            $description = htmlentities($_POST['description'], ENT_QUOTES);
            $price = htmlentities($_POST['price'], ENT_QUOTES);
            $category = htmlentities($_POST['category'], ENT_QUOTES);

            //jezeli zdjecie zostalo przeslane w formularzu, dodajemy je do tabeli ze zdjeciami
            if ($_FILES['photo']['name']!='') {
                $photo_name = implode(explode('.', $_FILES['photo']['name'], -1));
                $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));



                $query = "INSERT INTO photos (id_photo,photo_name,photo) VALUES (NULL, '$photo_name', '$photo')";
                if ($mysqli->query($query)) {
                    $_SESSION['success_add_product'] = "Udało sie dodać zdjęcie. ";
                } else {
                    $_SESSION['error_add_product'] = "Nie udało się dodać zdjęcia. Kod błędu: ";
                    if ($mysqli->connect_errno) {
                        $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->connect_errno;
                    }
                    $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->error;
                }

                $photo_id = mysqli_insert_id($mysqli);

            } else { //jezeli zdjecie nie zostalo przeslane w formularzu, to pobieramy z bazy zdjecie danego produktu, zeby moc wykonac aktualizacje

                if ($stmt = $mysqli->prepare("SELECT products.id_product, photos.id_photo, photos.photo_name, photos.photo FROM products, photos WHERE 
                                              products.photo_id = photos.id_photo AND id_product = ?")
                ) {
                    $stmt->bind_param("i", $id_product);
                    $stmt->execute();
                    $stmt->bind_result($id_product, $photo_id, $photo_name, $photo);
                    $stmt->fetch();
                    $stmt->close();
                } else {
                    $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->error;
                }
            }


            //w przypadku gdy formularz nie jest wypelniony, cofamy do formularza z bledem
            if ($name == '' || $description == '' || $price == '' || $category == '') {
                createForm($name, $description, $price, $category, $photo, 'Wypełnij wszystkie pola przy edycji', $id_product);
            } else

            {//w przypadku gdy formularz jest wypelniony, aktualizujemy produkt w bazie
                if ($stmt = $mysqli->prepare("
UPDATE products SET products.name = ?, products.description = ?, products.price = ?, products.category_id = ?, products.photo_id = ? 
WHERE products.id_product = ?")
                ) {
                    $stmt->bind_param("ssdiii", $name, $description, $price, $category, $photo_id, $id_product);
                    $stmt->execute();
                    $stmt->close();

                    $_SESSION['success_add_product'] = $_SESSION['success_add_product'].'Edytowano produkt.';
                } else {
                    $_SESSION['error_add_product'] = 'Nie udalo sie edytowac produktu.' . $mysqli->error;
                }
                //$_SESSION['error_add_product'] = $_SESSION['error_add_product'] . 'cos niegra2' . $mysqli->error;
                header("Location: ../shop.php");
            }

        }

    } else {
        if (is_numeric($_GET['id_product']) && $_GET['id_product'] > 0) {

            $id_product = $_GET['id_product'];

            if ($stmt = $mysqli->prepare("SELECT products.id_product, products.name, products.description, 
products.price, products.category_id, photos.photo FROM products, photos WHERE products.photo_id = photos.id_photo AND id_product = ?")
            ) {
                $stmt->bind_param("i", $id_product);
                $stmt->execute();
                $stmt->bind_result($id_product, $name, $description, $price, $category, $photo);
                $stmt->fetch();
                createForm($name, $description, $price, $category, $photo, NULL, $id_product);
                $stmt->close();
            } else {
                $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->error;
            }

        } else {
            header("Location: ../shop.php");
        }
    }

} else {
    /*Tryb nowego rekordu*/

//    if (isset($_POST['submit'])) {

    if (isset($_FILES['photo']['tmp_name'])) {

//        $test=$_FILES['photo']['name'];
//        header("Location: ../testttes.php?'$test'");
//        if (isset($_FILES['photo']['tmp_name'])) {
//            header("Location: ../testttes.php?'$_FILES['photo']['tmp_name']'");
//        }


        $name = htmlentities($_POST['name'], ENT_QUOTES);
        $description = htmlentities($_POST['description'], ENT_QUOTES);
        $price = htmlentities($_POST['price'], ENT_QUOTES);
        $category = htmlentities($_POST['category'], ENT_QUOTES);
        //$photo_name = $_FILES['photo']['name'];
        $photo_name = implode(explode('.', $_FILES['photo']['name'], -1));
        @$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        //$photo = $_FILES['photo']['tmp_name'];


        if ($name == '' || $description == '' || $price == '' || $category == '') {
            //$_SESSION['error_add_product'] = "Wypełnij wszystkie pola";
            //header("Location: ../index.php");
            createForm($name, $description, $price, $category, $photo, 'Wypełnij wszystkie pola');
        } else {

            $query = "INSERT INTO photos (id_photo,photo_name,photo) VALUES (NULL, '$photo_name', '$photo')";
            if ($mysqli->query($query)) {
                $_SESSION['success_add_product'] = "Udało sie dodać zdjęcie. ";
            } else {
                $_SESSION['error_add_product'] = "Nie udało się dodać zdjęcia. Kod błędu: ";
                if ($mysqli->connect_errno) {
                    $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->connect_errno;
                }
                $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->error;
            }

            $id_of_current_photo = mysqli_insert_id($mysqli);

            $query = "INSERT INTO products (id_product,name,description,price,category_id,photo_id) VALUES (NULL,'$name','$description','$price','$category','$id_of_current_photo')";
            if ($mysqli->query($query)) {
                $_SESSION['success_add_product'] .= "Udało sie dodać produkt.";
            } else {
                $_SESSION['error_add_product'] = "Błąd zapytania, nie udało sie dodać produktu. Kod błędu: ";
                if ($mysqli->connect_errno) {
                    $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->connect_error;
                }
                $_SESSION['error_add_product'] = $_SESSION['error_add_product'] . $mysqli->error;
            }


            header("Location: ../shop.php");
        }

    } else {
        createForm();
    }

}

$mysqli->close();
