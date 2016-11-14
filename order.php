<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');

$cart = $_COOKIE['cart'];
$id_user = $_COOKIE['id_user'];
$name = $_COOKIE['name'];
$surname = $_COOKIE['surname'];
$city = $_COOKIE['city'];
$street = $_COOKIE['street'];
$total = $_COOKIE['sumOfCart'];
$date = date("Y-m-d");
$cartArr = explode(' ', $cart);

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

?>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">Dziękujemy za zamówienie! Produkty wylistowane poniżej, zostaną
            wysłane na Państwa adres podany poda listą produktów.
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Kategoria</th>
                    <th>Cena</th>
                </tr>
                </thead>
                <tbody>

                <?php
                include_once('model/db_connect.php');

                if ($mysqli->query("INSERT INTO orders (user_id, total, order_date) VALUES('$id_user','$total','$date')")) {
                    if ($mysqli->query("SELECT LAST_INSERT_ID() INTO @order_id")) {
                        foreach ($cartArr as $product) {
                            if ($mysqli->query("INSERT INTO order_products (order_id,product_id) VALUES(@order_id,'$product')")) {

                            }

                            if ($q = $mysqli->query("SELECT * FROM products_view WHERE id_product=" . $product)) {
                                while ($row = $q->fetch_row()) {
                                    $current_product = $q->fetch_assoc();
                                    echo "<tr><td>" . $row['0'] . "</td>";
                                    echo "<td>" . $row['1'] . "</td>";
                                    echo "<td>" . $row['2'] . "</td>";
                                    echo "<td>" . $row['4'] . "</td>";
                                    echo "<td>" . $row['3'] . "</td></tr>";

                                }
                            }
                        }
                    }
                }

                $mysqli->close();
                $q->close();

                ?>
                </tbody>
                <thead>
                <tr>
                    <th colspan="3"></th>
                    <th>Suma:</th>
                    <th><?php echo $total; ?>zł</th>
                </tr>
                </thead>

            </table>
        </div>

        <div class="jumbotron">
            <h3>Adres na który dostarczymy przedmioty:</h3>
            <?php
            echo "<p>Imię i nazwisko: " . $name . " " . $surname . "<br>";
            echo "Adres: " . $city . ", ul. " . $street . "<br>";
            echo "Kwota do zapłaty: " . $total . "zł</p>" . "<br>";
            ?>

        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
    });
</script>
<?php include_once('view/footer.php'); ?>



