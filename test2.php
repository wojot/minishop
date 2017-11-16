<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');
?>


    <div class="row">
        <div class="col-md-12">

            <div class="jumbotron">
                <h2>Witaj w panelu <?php if (isset($_COOKIE['permission']) && $_COOKIE['permission'] > 0) {
                        echo "admina";
                    } else {
                        echo "użytkownika";
                    } ?>.</h2>
                <p>
                    <?php
                    echo "Twój nick: " . $_COOKIE['nick'] . "<br>";
                    echo "Twój email: " . $_COOKIE['email']. "<br>";
                    echo "Twoje imię: " . $_COOKIE['name']. "<br>";
                    echo "Twoje nazwisko: " . $_COOKIE['surname']. "<br>";
                    echo "Twoje miejsce zamieszkania: " . $_COOKIE['city'] . " ul." . $_COOKIE['street']. "<br>";
                    if(!empty($_COOKIE['tel'])){  echo "Twój nr tel.: " . $_COOKIE['tel']. "<br>";}
                    ?>


                </p>

            </div>

        </div>
    </div>

<?php include_once('view/footer.php'); ?>