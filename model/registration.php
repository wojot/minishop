<?php
session_start();

$error_flag = false;

//walidacja maila
if (!empty($_POST['register_email'])) {
    $email = htmlentities($_POST['register_email']); // TODO: zabezpieczenie przed sql injection
} else {
    $error_flag = true;
    $_SESSION['error'] = "Niepoprawny email.";
}

//walidacja nicku
if (empty($_POST['register_nick']) || strlen($_POST['register_nick']) < 3 || strlen($_POST['register_nick']) > 50) {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Nick powinien mieć od 3 do 50 znaków.";
} else {
    $nick = htmlentities($_POST['register_nick'], ENT_QUOTES);
}

//walidacja imienia
if (!empty($_POST['register_name'])) {
    $name = htmlentities($_POST['register_name'], ENT_QUOTES);
} else {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Podaj imię.";
}

//walidacja nazwiska
if (!empty($_POST['register_surname'])) {
    $surname = htmlentities($_POST['register_surname'], ENT_QUOTES);
} else {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Podaj nazwisko.";
}

//walidacja miejscowosci
if (!empty($_POST['register_city'])) {
    $city = htmlentities($_POST['register_city'], ENT_QUOTES);
} else {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Podaj miejscowość.";
}

//walidacja ulicy
if (!empty($_POST['register_street'])) {
    $street = htmlentities($_POST['register_street'], ENT_QUOTES);
} else {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Podaj ulicę.";
}

//walidacja hasel
if (!empty($_POST['register_password']) && !empty($_POST['register_password2']) && strlen($_POST['register_password']) > 3 && $_POST['register_password'] == $_POST['register_password2']) {
    $password = htmlentities($_POST['register_password'], ENT_QUOTES);
    $password_hash = hash('md5', $password);
} else {
    $error_flag = true;
    $_SESSION['error'] = $_SESSION['error'] . " Podaj odpowiedne, zgodne hasła.";
}

if (isset($_POST['register_telephone'])) {
    $telephone = $_POST['register_telephone'];
} else {
    $telephone = 0;
}


if ($error_flag) {
    header('Location: ../signup.php');
} else if ($error_flag == false) {

    try { //TODO: try catch php


        include_once('db_connect.php');


        if ($mysqli->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //sprawdzanie czy email istnieje w bazie
            $result = $mysqli->query("SELECT id_user FROM users WHERE email='$email'");

            if (!$result) throw new Exception($mysqli->error);

            $how_many_mails = $result->num_rows;
            if ($how_many_mails > 0) {
                $error_flag = true;
                $_SESSION['error'] = $_SESSION['error'] . " Istnieje już konto przypisane do tego adresu e-mail!";
            }

            //Czy nick jest już zarezerwowany?
            $result = $mysqli->query("SELECT id_user FROM users WHERE nick='$nick'");

            if (!$result) throw new Exception($mysqli->error);

            $how_many_mails = $result->num_rows;
            if ($how_many_mails > 0) {
                $error_flag = true;
                $_SESSION['error'] = $_SESSION['error'] . " Istnieje już konto o takim nicku! Wybierz inny.";
            }

            if ($error_flag == false) {
                


                // dodawanie rekordu do bazy
                if ($mysqli->query("INSERT INTO users VALUES (NULL, '$nick', '$email', '$password_hash', 0, '$name', '$surname', '$city', '$street', '$telephone')")) {
                    $_SESSION['success'] = true;
                } else {
                    $_SESSION['error'] = $_SESSION['error'] . " Blad dodawania.";
                    throw new Exception($mysqli->error);
                }
            }
            $mysqli->close();
        }

    } catch (Exception $e) {
        $_SESSION['error'] = "Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie! " . $e;

    }

    header('Location: ../signup.php');

}