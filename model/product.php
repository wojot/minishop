<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include_once('../view/header.php');
include_once('../view/menu.php');
include_once('error.php');
include_once('success.php');
?>

<div class="row">
    <div class="col-md-12">


        <?php

        include_once('db_connect.php');

        if ($q = $mysqli->query("
SELECT products.id_product, products.name, products.description, products.price, categories.name AS 'category', photos.photo
FROM products, categories, photos 
WHERE products.category_id=categories.id_category AND products.photo_id=photos.id_photo AND products.id_product=" . $_GET['id'])
        ) {
            $product = $q->fetch_object();
            echo "<table class='table table-striped' id='productTable'>";
            echo "<tr><td width='500px'><h3>ID: " . $product->id_product . " Nazwa: " . $product->name . "</h3></td><td rowspan='4'>" . '<img src="data:image/jpeg;base64,' . base64_encode($product->photo) . '" width="600px"/>' . "</td></tr>";
            echo "<tr><td>Opis: " . $product->description . "</td></tr>";
            echo "<tr><td><h3> Kategoria: " . $product->category . "</h3></td></tr>";
            echo "<tr><th><h1 id='productPrice'><span class='label label-success'>" . $product->price . " zł</span></h1></th></tr>";
            echo "</table>";
            

        }
        ?>
    </div>
</div>
<div class="form-group">
    <?php if (isset($_COOKIE['id_user']) && isset($_COOKIE['permission']) && $_COOKIE['permission'] == 0) { ?>
        <div class="col-md-6">

        <a href="<?php echo "add_to_cart.php?page=";
        if (isset($_GET['page'])) {
            echo $_GET['page'];
        } else {
            echo "1";
        }; ?>&id=<?php echo $product->id_product; ?>" class="btn btn-block btn-success" role="button"><span
                class="glyphicon glyphicon-shopping-cart"
                aria-hidden="true"></span> Dodaj</a>
        </div><?php } ?>


    <div
        class="col-md-<?php if (isset($_COOKIE['id_user']) && isset($_COOKIE['permission']) && $_COOKIE['permission'] == 0) {
            echo "6";
        } else {
            echo "12";
        } ?>">
        <a href="<?php echo "../shop.php?page=";
        if (isset($_GET['page'])) {
            echo $_GET['page'];
        } else {
            echo "1";
        }; ?>" class="btn btn-block btn-primary" role="button"><span
                class="glyphicon glyphicon-th"
                aria-hidden="true"></span> Powrót</a>
    </div>
</div>
<?php
include_once('../view/footer.php')
?>
