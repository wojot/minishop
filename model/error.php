<?php
if (isset($_GET['error'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        switch ($_GET['error']) {

            case
            1:
                echo "Problem z połączniem z bazą!";
                break;

            case
            2:
                echo "Nie znaleziono takiego użytkownika w bazie!";
                break;
            case
            3:
                echo "Nie udalo sie wylogowac!";
                break;
            case
            4:
                echo "Nie wpisano pelnych danych!";
                break;
        }
        ?>
    </div>
    <?php

}


if (isset($_SESSION['error_add_product'])) {
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_add_product']; ?></div>
    <?php
    unset($_SESSION['error_add_product']);
} else if (isset($_SESSION['success_add_product'])) {
    ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_add_product']; ?></div>
    <?php
    unset($_SESSION['success_add_product']);
}
