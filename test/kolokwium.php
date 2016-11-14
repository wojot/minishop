<?php
/**
 * Created by PhpStorm.
 * User: wojot
 * Date: 19.06.2016
 * Time: 10:49
 */
$ax = 0;
$ay = 0;
$by = 0;

?>
<!DOCTYPE html>
<html>
<head>


</head>
<body>
<form method="get">
    Ustal wielkość macierzy A: wiersze:
    <select name="ax">

        <?php
        for ($i = 1; $i < 100; $i++) {
            if (isset($_GET['ax']) && $_GET['ax'] == $i) {
                echo "<option selected value=$i>$i</option>";
            } else {
                echo "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    x kolumny <select name="ay" onchange="document.getElementById('bx').value = this.value">
        <?php
        for ($i = 1; $i < 100; $i++) {
            if (isset($_GET['ay']) && $_GET['ay'] == $i) {
                echo "<option selected value=$i>$i</option>";
            } else {
                echo "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    <br/>
    Ustal wielkość macierzy B: wiersze:
    <select disabled id="bx">
        <?php
        for ($i = 1; $i < 100; $i++) {
            if (isset($_GET['ay']) && $_GET['ay'] == $i) {
                echo "<option selected value=$i>$i</option>";
            } else {
                echo "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    x kolumny
    <select name="by">
        <?php
        for ($i = 1; $i < 100; $i++) {
            if (isset($_GET['by']) && $_GET['by'] == $i) {
                echo "<option selected value=$i>$i</option>";
            } else {
                echo "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    <input type="submit" value="OK">
</form>
<?php
if (isset($_GET['ax']) && isset($_GET['ay']) && isset($_GET['by'])) {
    $ax = $_GET['ax'];
    $ay = $_GET['ay'];
    $by = $_GET['by'];
    $wynik = array();
    if (isset($_POST['macierz'])) {
        for ($i = 1; $i <= $ax; $i++) {
            for ($j = 1; $j <= $by; $j++) {
                $c = 0;
                for ($k = 1; $k <= $ay; $k++) {
                    $c += $_POST['a' . $i . $k] * $_POST['b' . $k . $j];
                }
                $wynik['w' . $i . $j] = $c;
            }
        }

    }
    ?>
    Wygenerowana macierz: <br/><br/>
    <form method="POST">
        <input type="hidden" name="macierz">
        <table>
            <tr>
                <td></td>
                <td>
                    <?php
                    for ($i = 1; $i <= $ay; $i++) {
                        for ($j = 1; $j <= $by; $j++) {
                            $index = 'b' . $i . $j;
                            if (isset($_POST[$index])) {
                                echo "<input name='$index' type=number step=any value='$_POST[$index]'>";
                            } else {
                                echo "<input name='$index' type=number step=any value=''>";
                            }
                        }
                        echo "<br/>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    for ($i = 1; $i <= $ax; $i++) {
                        for ($j = 1; $j <= $ay; $j++) {
                            $index = 'a' . $i . $j;
                            if (isset($_POST[$index])) {
                                echo "<input name='$index' type=number step=any value='$_POST[$index]'>";
                            } else {
                                echo "<input name='$index' type=number step=any value=''>";
                            }
                        }
                        echo "<br/>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    for ($i = 1; $i <= $ax; $i++) {
                        for ($j = 1; $j <= $by; $j++) {
                            if (isset($_POST['macierz'])) {
                                $suma = $wynik['w' . $i . $j];
                                echo "<input type=text value='$suma'>";
                            } else {
                                echo "<input type=text value=''>";
                            }
                        }
                        echo '<br/>';
                    }
                    ?>
                </td>
            </tr>
        </table>
        <br/><br/>
        <input type="submit" value="OBLICZ">
    </form>
<?php } ?>
</body>
</html>