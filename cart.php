<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');
?>


<div class="row">
    <div class="col-md-12">
        <div id="emptyCart"></div>

        <?php
        if (isset($_GET['clearCart'])) {
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
            header('location:' . HTTP . "cart.php");
        }


        @$cart = explode(" ", $_COOKIE['cart']);
        // print_r($cart);


        if (isset($_COOKIE['cart'])) {
            include_once('model/db_connect.php');
            ?>


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tab">
                            <!--                            <thead>-->
                            <tr>
                                <th>ID</th>
                                <th>ID produktu i Nazwa</th>
                                <th>Opis</th>
                                <th>Kategoria</th>
                                <th>Cena</th>
                                <th>Ilość</th>
                                <th>Usuń</th>
                            </tr>
                            <!--                            </thead>-->
                            <?php
                            foreach ($cart as $k => $v) {
                                ?>

                                <tr id="row<?php echo $k + 1; ?>">


                                    <?php

                                    if ($q = $mysqli->query("SELECT products.name AS name, products.description, products.price, categories.name AS catName
FROM products, categories
WHERE category_id=categories.id_category AND id_product=" . $v)
                                    ) {
                                        $current_product = $q->fetch_assoc();
                                        echo "<td>" . $v . "</td>";
                                        echo "<td>" . $current_product['name'] . "</td>";
                                        echo "<td>" . $current_product['description'] . "</td>";
                                        echo "<td>" . $current_product['catName'] . "</td>";
                                        echo "<td>" . $current_product['price'] . "</td>";

                                    }
                                    ?>

                                    <td>
                                        <button type="button" class="btn btn-success"
                                                id="remove<?php echo $k + 1; ?>"><span
                                                class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"
                                                id="remove<?php echo $k + 1; ?>"><span
                                                class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>


                                <th colspan="3">
                                    <a href="<?php echo HTTP ?>order.php" type="button"
                                       class="btn btn-success btn-block">
                                        Kup produkty znajdujące sie w koszyku
                                    </a>
                                </th>

                                <th>Suma</th>
                                <th id="sum"><?php echo $_COOKIE['sumOfCart']; ?></th>
                                <th>zł</th>

                                <th>
                                    <a href="<?php echo HTTP ?>cart.php?clearCart=1" type="button"
                                       class="btn btn-danger">
                                                    <span
                                                        class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <?php
        } else {
            ?>
            <div class="alert alert-warning" role="alert">Brak produktów w koszyku! Dodaj cos do koszyka :)</div>
            <?php
        }


        ?>
        <!--            <a href="-->
        <?php //echo HTTP ?><!--cart.php?clearCart=1"><button type="button" class="btn btn-danger">Wyczyść wszystkie produkty z koszyka</button></a>-->

    </div>
</div>

<script>

    $(document).ready(function () { // TODO: jQuery usuwanie z koszyka

        $("tr button:even").click(function () {


            var cart = Cookies.get('cart');
            var amountOfProducts = Cookies.get('amountOfProducts');
            var cartArr = cart.split("+");

            var sum = $("#sum").text();

            var row = $(this).attr("id").substring(6);
            var currRow = parseInt(row);
            currRow = currRow + 1;
            var productID = parseInt($("table tr:nth-child(" + currRow + ") td:first").text());
            sum = parseInt(sum);
            sum = sum + (parseInt($("table tr:nth-child(" + currRow + ") td:nth-child(5)").text()));

            $("#sum").text(sum);

            cartArr[cartArr.length] = productID;
            //cartArr.splice(currRow - 2, 1);

            cart = cartArr.join("+");
            var cartLen = cart.length;

            ++amountOfProducts;

            $('#amountOfProducts').text(amountOfProducts);
            Cookies.set('cart', cart, {expires: 1});
            Cookies.set('amountOfProducts', amountOfProducts, {expires: 1});
            Cookies.set('sumOfCart', sum, {expires: 1});
            Cookies.set('controlSum', cartLen, {expires: 1});
            location.reload()


        });

        $("tr button:odd").click(function () {


            var amountOfProducts = Cookies.get('amountOfProducts');

            var sum = $("#sum").text();

            var row = $(this).attr("id").substring(6);
            var currRow = parseInt(row);
            currRow = currRow + 1;

            sum = sum - parseInt($("table tr:nth-child(" + currRow + ") td:nth-child(5)").text());

            $("#sum").text(sum);


            var cart = Cookies.get('cart');
            var cartArr = cart.split("+");
            cartArr.splice(currRow - 2, 1);
            cart = cartArr.join("+");
            var cartLen = cart.length;
            try { //TODO: try catch js
                if (--amountOfProducts <= 0) {

                    Cookies.remove('cart');
                    Cookies.remove('amountOfProducts');
                    Cookies.remove('sumOfCart');
                    Cookies.remove('lastAddedProduct');
                    Cookies.remove('controlSum');
                    Cookies.remove('lastName');
                    Cookies.remove('lastPrice');
                    $('#emptyCart').html('<div class="alert alert-warning" role="alert">Brak produktów w koszyku! Dodaj cos do koszyka :)</div>');
                    $('#tab').hide();
                    $('#cartMenu').hide();
                } else {
                    $('#amountOfProducts').text(amountOfProducts);
                    Cookies.set('cart', cart, {expires: 1});
                    Cookies.set('amountOfProducts', amountOfProducts, {expires: 1});
                    Cookies.set('sumOfCart', sum, {expires: 1});
                    Cookies.set('controlSum', cartLen, {expires: 1});

                    $("table tr:nth-child(" + currRow + ")");
                    location.reload()
                }
            } catch (err) {
               $('#emptyCart').html('<div class="alert alert-danger" role="alert">Problem z usuwaniem produktu! </div>');
               alert(err.message)
            }

//            for(var i=0; i<cartArr.length;i++){
//            alert(cartArr[i]);
//            }


        });


// ponizej stare proby:
        //$("tr:nth-child()").hide();

        //jQuery(this).find("tr").hide();
        //$("#row" + i).hide();
        //$("tr:nth-child(5)").hide();


//            $("#remove1").click(function () {
//                $("#row1").hide();
//            });

//        var i, but, prod;
//        for (i = 1; i < 10; i++) {
//            but = "#remove"+i;
//            prod = "#row"+i;
//            $(but).click(function (prod) {
//                $(prod).hide();
//                //$("#row" + i).hide();
//                //$("tr:nth-child(5)").hide();
//
//            });
//        }

    });
</script>


<?php include_once('view/footer.php'); ?>



