<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/php/pai_git/config.php");
include_once('view/header.php');
include_once('view/menu.php');
include_once('model/error.php');
include_once('model/success.php');
?>


    <div class="row">
        <div class="col-md-12">

            <?php
            include('model/products_list.php');
            ?>

        </div>
        <?php include_once('view/footer.php'); ?>
    </div>

