<?php
session_start();
include('db_connect.php');
include('cart_message.php');
include('error.php');


if (isset($_COOKIE['cart'])) {
    ?>

    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php
        echo "Liczba produktów w koszyku: " . $_COOKIE['amountOfProducts'] . ". Ostatnio dodany produkt to: 
        id: " . $_COOKIE['lastAddedProduct'] . ", nazwa: " . $_COOKIE['lastName'] . ", cena: " . $_COOKIE['lastPrice'] .
            "zł. Suma cen produktów z koszyka to: " . $_COOKIE['sumOfCart'] . "zł.";
        ?>
    </div>

<?php }
?>
<h1>Produkty</h1>

<?php

$records_per_page = 4;

if ($result = $mysqli->query("
SELECT products.id_product, products.name, products.description, products.price, categories.name AS 'category', photos.photo
FROM products, categories, photos 
WHERE products.category_id=categories.id_category AND products.photo_id=photos.id_photo
ORDER BY products.id_product
")
) {
    if ($result->num_rows != 0) {
        $total_records = $result->num_rows;
        $total_pages = ceil($total_records / $records_per_page);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {

            $show_page = $_GET['page'];

            if ($show_page > 0 && $show_page <= $total_pages) {
                $start = ($show_page - 1) * $records_per_page;
                $end = $start + $records_per_page;
            } else {
                $start = 0;
                $end = $records_per_page;
            }
        } else {
            $start = 0;
            $end = $records_per_page;
        }


        for ($i = $start; $i < $end; $i++) {
            if ($i == $total_records) {
                echo "</div>";
                break;
            }
            if ($i == 0) {
                echo "<div class='row'>";
            }
            if (($i % 2 == 0) && ($i > 0)) {
                echo "</div><div class='row'>";
            }

            ?>
            <div class="col-sm-6">
                <?php
                $result->data_seek($i);
                $row = $result->fetch_object();


                echo "<table class='table table-striped'>";
                // echo "<tr><td>" . $row->id_product . "</td></tr>";
                echo "<tr><th>" . $row->name . "</th>";
                echo "<th rowspan='4' >" . '<img src="data:image/jpeg;base64,' . base64_encode($row->photo) . '" width="350px"/>' . "</th></tr>";
                echo "<tr><td>" . $row->description . "</td></tr>";
                echo "<tr><td>" . $row->price . " zł</td></tr>";
                echo "<tr><td>" . $row->category . "</td></tr>";

                echo "<tr><td>" . $row->category . "</td></tr>";
                echo "<tr><td>" . $row->category . "</td></tr>";
                echo "<tr><td>" . $row->category . "</td></tr>";
                echo "</table>";
                ?>

            </div>


            <?php


        }


        echo "<table class='table table-striped'>";
        echo "<tr><th>ID</th><th>Nazwa</th><th>Opis</th><th>Cena</th><th>Kategoria</th><th>Zdjęcie</th><th> </th>";
        ?><?php
        if (isset($_COOKIE['permission']) && $_COOKIE['permission'] > 0) {
            echo "<th colspan='2'>Edycja</th>";
        } ?>
        </tr><?php


        for ($i = $start; $i < $end; $i++) {
            if ($i == $total_records) {

                break;
            }


            $result->data_seek($i);
            $row = $result->fetch_object();
            echo "<tr style='vertical-align:middle;'>";


            echo "<td>" . $row->id_product . "</td>";
            echo "<td>" . $row->name . "</td>";
            echo "<td>" . $row->description . "</td>";
            echo "<td>" . $row->price . " zł</td>";
            echo "<td>" . $row->category . "</td>";
            echo "<td>" . '<img src="data:image/jpeg;base64,' . base64_encode($row->photo) . '" width="100px"/>' . "</td>";
            //  onmouseover= "this.src='Images/sheriffcarcompare.jpg';this.width=200;" onmouseout="this.width=100;"
            if (isset($_COOKIE['permission']) && $_COOKIE['permission'] > 0) {
                echo "<td><a href='controller/product_form.php?id_product=" . $row->id_product . "'> Edytuj</a></td>";
                echo "<td><a href='model/delete.php?id_product=" . $row->id_product . "'>Usuń</a></td>";
                echo "<td><a href='model/duplicate.php?id_product=" . $row->id_product . "&page=" . $total_pages . "'>Duplikuj</a></td>";
            } elseif (isset($_COOKIE['permission']) && $_COOKIE['permission'] == 0) {
                ?>
                <td><a href="<?php echo "model/add_to_cart.php?page=";
                    if (isset($_GET['page'])) {
                        echo $_GET['page'];
                    } else {
                        echo "1";
                    }; ?>&id=<?php echo $row->id_product; ?>">Dodaj do koszyka</a></td>
                <?php
            }
            echo "</tr>";
        }
        echo "</table>";


    } else {
        echo "Brak rekordów";
    }
} else {
    echo "Błąd zapytania";
}

$mysqli->close();
?>

<!-- paginacja -->
<div class="col-md-10">
    <nav>
        <ul class="pagination">

            <?php

            for ($i = 1; $i <= $total_pages; $i++) {
                if (isset($_GET['page']) && $_GET['page'] == $i) {
                    echo "<li class='active'><a href='shop.php?page=$i'>" . $i . "</a></li>";
                } else {
                    echo " <li";
                    if (empty($_GET['page']) && $i == 1) {
                        echo " class = 'active'";
                    }


                    echo "><a href='shop.php?page=$i'>" . $i . "</a></li>";
                }
            }

            ?>
        </ul>
    </nav>
</div>

<?php if (isset($_COOKIE['permission']) && $_COOKIE['permission'] > 0) { ?>
    <div class="col-md-2">
        <a href="controller/product_form.php">Dodaj nowy produkt</a>
    </div>
<?php } ?>
</div>

