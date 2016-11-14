<?php
if (isset($_GET['success'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        switch ($_GET['success']) {

            case
            1:
                echo "Zalogowano pomyślnie!";
                break;
            case
            2:
                echo "Usunięto wybrany produkt z bazy.";
                break;
            case
            3:
                echo "Zduplikowano wybrany produkt.";
                break;


        }
        ?>
    </div>
    <?php

}

if (isset($_GET['logout'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo "Wylogowano pomyślnie!";
        ?>
    </div>
    <?php

}