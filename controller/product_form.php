<?php
session_start();
if(isset($_COOKIE['permission'])&&$_COOKIE['permission']==1){
function createForm($p_name = '', $p_description = '', $p_price = '', $p_category = '', $p_photo = '', $error = '', $id_product = '')
{ ?>


    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if ($id_product != '') {
                echo "Edytuj rekord";
            } else {
                echo "Dodaj rekord";
            } ?></title>
        <meta charset="UTF-8"/>
        <link href="http://localhost/php/pai_git/css/bootstrap.css" rel="stylesheet">
        <link href="http://localhost/php/pai_git/css/bootstrap-theme.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
    </head>
    <body>
    <?php include_once('../view/menu.php'); ?>
    <h1><?php if ($id_product != '') {
            echo "Edytuj rekord";
        } else {
            echo "Dodaj rekord";
        } ?></h1>

    <?php if ($error != '') { ?>
        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        <?php
    } ?>

    <?php if($p_photo){?>
    <div class="row">
        <div class="col-md-6">
            <?php }?>

            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                <?php if ($id_product != '') { ?>
                    <div class="form-group">
                        <label for="id_product" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_product" value="<?php echo $id_product; ?>"/>
                            <input class="form-control" id="id_product" placeholder="<?php echo $id_product; ?>"
                                   type="text"
                                   name="id_product"
                                   value="<?php echo $id_product; ?>" disabled/>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nazwa</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="name" placeholder="Nazwa" type="text" name="name"
                               value="<?php echo $p_name; ?>"/>
                    </div>
                </div>




                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Opis</label>
                    <div class="col-sm-10">
                        <textarea rows="10" class="form-control" id="description" placeholder="Opis" name="description"><?php echo $p_description; ?></textarea>
                    </div>
                </div>

<!--                <div class="form-group">-->
<!--                    <label for="description" class="col-sm-2 control-label">Opis</label>-->
<!--                    <div class="col-sm-10">-->
<!--                        <input class="form-control" id="description" placeholder="Opis" type="text" name="description"-->
<!--                               value="--><?php //echo $p_description; ?><!--"/>-->
<!--                    </div>-->
<!--                </div>-->





                <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">Cena</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="price" placeholder="Cena" type="text" name="price"
                               value="<?php echo $p_price; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Kategoria:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category" name="category">
                            <option value="1" <?php if ($p_category == 1) echo "selected"; ?>>meskie</option>
                            <option value="2" <?php if ($p_category == 2) echo "selected"; ?>>damskie</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="photo" class="col-sm-2 control-label">Zdjęcie</label>
                    <input type="file" class="col-sm-10 control-label" name="photo" id="photo">
                    <?php if($p_photo){?>
                    <p class="help-block" style="margin-left: 115px;">Nowe zdjęcie zastapi istniejące, które wyświetla się po prawej stronie.</p>
                    <?php }?>
                    <!--            <p class="help-block">Zdjecie nie może byc większe niż 10mB.</p>-->
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <a href="../shop.php" class="btn btn-danger btn-block" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Anuluj zmiany i powróć</a>
                    </div>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-success btn-block" name="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Zatwierdź i wyślij</button>
                    </div>
                </div>


            </form>
            <?php if($p_photo){?>
        </div>
        <div class="col-md-6">

            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($p_photo) . '" width="600px"/>' ?>

        </div>


    </div>
    <?php }?>
    </body>
    </html>

<?php }

include_once('../model/records.php');

}
?>