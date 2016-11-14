<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
header("Pragma: no-cache");

function PageName()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();


include(ROOT . 'model/logout.php');
//include ('C:/xampp/htdocs/php/pai_git/model/logout.php');

?>

<div class="container" xmlns="http://www.w3.org/1999/html">


    <nav class="navbar navbar-default">
        <div class="container">


            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--                <a class="navbar-brand" href="#"></a>-->
                <img src="<?php echo HTTP; ?>media/logo.jpg"/>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <!--<li class="active"></li>-->
                    <li class="<?php if ($current_page == 'index.php') {
                        echo 'active';
                    } ?>">
                        <a href="<?php echo HTTP; ?>index.php"><span class="glyphicon glyphicon-home"
                                                                     aria-hidden="true"></span> Home</a>
                    </li>
                    <li class="<?php if ($current_page == 'about.php') {
                        echo 'active';
                    } ?>">
                        <a href="<?php echo HTTP; ?>about.php"><span class="glyphicon glyphicon-star"
                                                                     aria-hidden="true"></span> O nas</a>
                    </li>
                    <li class="<?php if ($current_page == 'contact.php') {
                        echo 'active';
                    } ?>">
                        <a href="<?php echo HTTP; ?>contact.php"><span class="glyphicon glyphicon-envelope"
                                                                       aria-hidden="true"></span>
                            Kontakt</a></li>
                    <li class="<?php if ($current_page == 'shop.php') {
                        echo 'active';
                    } ?>">
                        <a href="<?php echo HTTP; ?>shop.php"><span class="glyphicon glyphicon-th"></span> Nasze
                            produkty</a></li>

                    <?php if (!isset($_COOKIE['id_user'])) { ?>
                        <li class="<?php if ($current_page == 'signup.php') {
                            echo 'active';
                        } ?>">
                            <a href="<?php echo HTTP; ?>signup.php"><span
                                    class="glyphicon glyphicon-user" aria-hidden="true"></span> Rejestracja</a></li>


                        <?php

                    }
                    if (isset($_COOKIE['id_user'])) {

                        ?>
                        <p class="navbar-text"><span
                                class="glyphicon glyphicon-user"
                                aria-hidden="true"></span> <?php echo "Jesteś zalogowany, Twój nick to "; ?> <a
                                href="<?php echo HTTP; ?>panel.php"><?php
                                if (strlen($_COOKIE['nick']) <= 12) {
                                    echo $_COOKIE['nick'];
                                } else {
                                    echo substr($_COOKIE['nick'], 0, 12) . "...";
                                }

                                ?></a></p>


                        <?php if (isset($_COOKIE['permission']) && $_COOKIE['permission'] == 0) {
                            if (isset($_COOKIE['cart']) && isset($_COOKIE['amountOfProducts'])) { ?>
                            <li class="<?php if ($current_page == 'cart.php') {
                                echo 'active';
                            } ?>">
                                <a href="<?php echo HTTP; ?>cart.php"><span
                                        class="glyphicon glyphicon-shopping-cart"
                                        aria-hidden="true"></span>
                                    <?php

                                    echo " Koszyk <span id='cartMenu'><span id='cart'><span id='amountOfProducts'>" . ($_COOKIE['amountOfProducts']) . " </span></span>";
                                    switch ($_COOKIE['amountOfProducts']) {
                                        case 1:
                                            echo " sztuka";
                                            break;
                                        case 2:
                                        case 3:
                                        case 4:
                                            echo " sztuki";
                                            break;
                                        default:
                                            echo " sztuk";
                                    }
                                    echo "</span>";

                                    ?></a></li><?php
                            } else {
                                ?>


                                <li class="<?php if ($current_page == 'cart.php') {
                                    echo 'active';
                                } ?>"><a href="<?php echo HTTP; ?>cart.php"><span
                                            class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Koszyk</a>
                                </li>


                                <?php
                            }

                        } elseif (isset($_COOKIE['permission']) && $_COOKIE['permission'] == 1) { ?>
                            <li class="<?php if ($current_page == 'realized_orders.php') {echo 'active';} ?>">
                                <a href="<?php echo HTTP; ?>realized_orders.php"><span
                                        class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Zamówienia</a></li>
                            <?php
                        }
                        ?>

                        <li><a href="<?php echo HTTP; ?>index.php?logout"><span class="glyphicon glyphicon-remove-sign"
                                                                                aria-hidden="true"></span> Wyloguj</a>
                        </li><?php

                    } else {

                    ?>

                </ul>
                <form action="<?php echo HTTP; ?>model/signin.php" method="post" class="navbar-form navbar-left">
                    <div class="form-group">
                        <label class="sr-only" for="mail">Nick</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Nick">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="pass">Hasło</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Hasło">
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj</button>
                </form>

                <?php
                }


                ?>


            </div><!--/.nav-collapse -->
        </div>
    </nav>