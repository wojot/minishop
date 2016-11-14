<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');
?>

    <div class="row">
        <div class="col-md-12">

            <?php

            include_once('model/carousel.php');

            include('model/db_connect.php');

            if ($q = $mysqli->query("SELECT * FROM news ORDER BY id_news DESC")) {

                while ($news = $q->fetch_assoc()) {

                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo $news['post_date']; ?>
                            <h3 class="panel-title"><?php echo $news['title']; ?></h3>
                        </div>
                        <div class="panel-body"><?php echo $news['description'] . "<br>";
                            if ($news['post_date'] == "2016-07-04") { ?>


                                <a class="btn btn-primary" href="shop.php" role="button"><span
                                        class="glyphicon glyphicon-th" aria-hidden="true"></span> Zobacz nasze produkty</a>

                            <?php } ?>

                        </div>
                    </div>
                    <?php

                }


            } else {
                header('location: index.php?error=1');
            }

            $q->close();
            //include('model/products_list.php');
            ?>

        </div>
    </div>
    <script src="C:\xampp\htdocs\php\pai_git\js\bootstrap.js"></script>
    <script src="http://localhost/php/pai_git/js/bootstrap.js"></script>
<?php include_once('view/footer.php'); ?>