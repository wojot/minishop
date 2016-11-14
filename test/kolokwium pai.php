<form method="post">
    Ustal wielkość macierzy A: wiersze:
    <select name="ax">
        <option value="">--</option>
        <?php for ($i = 1; $i <= 100; $i++) {
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
        }
        ?>
    </select>
    x kolumny:
    <select name="ay" onchange="document.getElementById('bx').value = this.value">
        <option value="">--</option>
        <?php for ($i = 1; $i <= 100; $i++) {
            ?>
            <option id="ay" value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
        }
        ?>
    </select><br/>

<!--    --><?php //if(isset( $_GET['bx'])) echo $_GET['bx']; ?>
    Ustal wielkość macierzy B: wiersze:

    <option value="<?php if(isset($_POST['ay'])) echo $_POST['ay']; ?>" selected><?php if(isset($_POST['ay'])) echo $_POST['ay']; ?></option>
    </select>
    x kolumny:
    <select name="by">
        <option value="">--</option>
        <?php for ($i = 1; $i <= 100; $i++) {
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
        }
        ?>
    </select><br/>

    <input type="submit">

</form>


<?php
/**
 * Created by PhpStorm.
 * User: wojot
 * Date: 19.06.2016
 * Time: 10:49
 */

if (isset($_POST['ax']) && isset($_POST['ay']) && isset($_POST['by']) && isset($_POST['bx'])) {
    $ax = $_POST['ax'];
    $ay = $_POST['ay'];
    $bx = $_POST['bx'];
    $by = $_POST['by'];

    echo "<table style='border: solid 1px black;'>";
    echo "<tr>";
    for ($i = 0; $i < $ay + $by; $i++) {
        echo "<td>";
        if ($i < 0)
            echo "</td>";
    }
    echo "</tr>";

    echo "</table>";
}


?>