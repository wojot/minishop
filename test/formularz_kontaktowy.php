<?php
//filtruje dane użytkownika
$error = "pusty";
if (!empty($_POST['imie'])) {
    $imie = htmlspecialchars(trim($_POST['imie']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $temat = htmlspecialchars(trim($_POST['temat']));
    $wiadomosc = htmlspecialchars(trim($_POST['wiadomosc']));
    $send = $_POST['send'];
}
//mail na który będa wysyłane wiadomości
$odbiorca = "wojotek@gmail.com";
//nagłówki
@$header = "Content-type: text/html; charset=utf-8\r\nFrom: $mail";

//Sprawdzam czy istnieje ciastko, jeżeli tak wyświetlam komunikat
if (isset($_COOKIE['send'])) $error = 'Odczekaj ' . ($_COOKIE['send'] - time()) . ' sekund przed wysłaniem kolejnej wiadomości';

if (@$send && !isset($_COOKIE['send'])) {
    //Sprawdzam nick
    if (empty($imie)) {
        $error = "Nie wypełniłeś pola <strong>Nick !</strong><br/>";
    } elseif (strlen($imie) > 20) {
        $error .= "Za długi nick - max. 20 znaków <br/>";
    }

    //Sprawdzam mail
    if (empty($mail)) {
        $error .= "Nie wypełniłeś pola <strong>E-mail !</strong><br/>";
    } elseif (strlen($mail) > 30) {
        $error .= "Za długi e-mail - max. 30 znaków <br/>";
    } elseif (preg_match('/^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9\-\_\.]+\@[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ0-9\-\_\.]+\.[a-z]{2,4}$/', $mail) == false) {
        $error .= "Niepoprawny adres E-mail! <br/>";
    }

    //Sprawdzam temat
    if (empty($temat)) {
        $error .= "Nie wypełniłeś pola <strong>Temat !</strong><br/>";
    } elseif (strlen($temat) > 120) {
        $error .= "Za długi temat - max. 120 znaków <br/>";
    }

    //Sprawdzam wiadomosc
    if (empty($wiadomosc)) {
        $error .= "Nie wypełniłeś pola <strong>Wiadomość !</strong><br/>";
    } elseif (strlen($wiadomosc) > 400) {
        $error .= "Za długa wiadomość - max. 400 znaków <br/>";
    }

    //Sprawdzam czy są błędy i wysyłam wiadomość
    if (empty($error)) {
        $list = "Przysłał - $imie ($mail) <br/> Treść wiadomości - $wiadomosc";

        if (mail($odbiorca, $temat, $list, $header)) {
            $error .= "Twoja wiadomość została wysłana";
            setcookie("send", time() + 60, time() + 60);
        } else {
            $error .= "Wystąpił błąd podczas wysyłania wiadomości, spróbuj później.";
        }
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="Keywords" content="wyraz1, wyraz2, wyraz3..."/>
    <meta name="description" content="Opis strony"/>

</head>
<body>
<form action="" method="post">
    <fieldset>
        <legend>Formularz kontaktowy</legend>
        <!-- Komunikat -->
        <?php echo $error; ?>
        <label for="imie">Imię/nick:</label>
        <input type="text" id="imie" name="imie"/></div>

        <label for="mail">Twój e-mail:</label>
        <input type="text" id="mail" name="mail"/>

        <label for="temat">Temat: </label>
        <input type="text" id="temat" name="temat"/>

        <label for="wiadomosc">Wiadomość:</label>
        <textarea id="wiadomosc" name="wiadomosc" cols="40" rows="10"></textarea>

        <input type="submit" value="Wyślij" id="send" name="send"/>
    </fieldset>
</form>
</body>
</html>
