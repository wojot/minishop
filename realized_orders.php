<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');

include_once('model/db_connect.php');

if (isset($_COOKIE['permission']) && $_COOKIE['permission'] == 1) {

    ?>

    <div class="row">
        <div class="col-md-12">
            <?php if ($q = $mysqli->query("SELECT * FROM order_view ORDER BY id_order DESC")) {
                while ($row = $q->fetch_row()) {
                    ?>
                    <table class="table table-responsive table-bordered table-striped">
                        <tr>
                            <th>ID zamówienia</th>
                            <th>Data</th>
                            <th>ID użytkownika</th>
                            <th>Nick</th>
                            <th>Email</th>
                            <th>Imie</th>
                            <th>Nazwisko</th>
                            <th>Miasto</th>
                            <th>Ulica</th>
                            <th>Suma</th>
                        </tr>
                        <tr>

                            <?php
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
                            echo "<td>" . $row[7] . "</td>";
                            echo "<td>" . $row[8] . "</td>";
                            echo "<td>" . $row[9] . "</td>";

                            ?>

                        </tr>
                        <tr>
                            <td colspan="10">
                                <table class="table table-responsive table-bordered table-striped">
                                    <tr>
                                        <th>ID produktu</th>
                                        <th>Nazwa</th>
                                        <th>Kategoria</th>
                                        <th>Cena</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        if ($q2 = $mysqli->query("SELECT * FROM orders_products_view WHERE order_id=" . $row[0])
                                        ) {
                                            while ($row2 = $q2->fetch_row()) {

                                                echo "<tr><td>" . $row2[2] . "</td>";
                                                echo "<td><a href='http://localhost/php/pai_git/model/product.php?id=" . $row2[2] . "'>" . $row2[3] . "</a></td>";
                                                echo "<td>" . $row2[4] . "</td>";
                                                echo "<td>" . $row2[5] . "</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                    </table>
                <?php }
            }
            //        $q->close();
            //        $q2->close();
            ?>


        </div>
    </div>

    <?php
}
include_once('view/footer.php'); ?>



