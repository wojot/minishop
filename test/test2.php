<?php
$host = "localhost";
$database_user = "root"; //uzytkownik
$database_password = "";
$database_name = "test3"; // nazwa bazy danych

$polaczenie = @new mysqli($host, $database_user, $database_password,$database_name);

if($polaczenie->connect_errno)
{
    die("Polaczenie nieudane: ". $polaczenie->connect_errno);
}
if(isset($_POST['czysc'])) {
    global $polaczenie;
    $polaczenie->query("DELETE FROM macierz");

}
function zapisz($wynik){
    global $polaczenie;
    echo "asd";
    $dane = array();
    $dane['stareget'] = $_GET;
    $dane['starepost'] = $_POST;
    $dane['wynik'] = $wynik;
    $json = json_encode($dane);
    $polaczenie->query("INSERT INTO macierz(data) VALUES('$json')");

}

function wyswietl($dane){
    $xA = $dane['stareget']['xA'];
    $yA = $dane['stareget']['yA'];
    $yB = $dane['stareget']['yB'];


    ?>
    <table>
        <tr>
            <td></td>
            <td>
                <?php
                for($i = 1; $i <= $yA; $i++){
                    for($j = 1; $j <= $yB; $j++ ){
                        $index = 'b'.$i.$j;
                        if (isset($dane['starepost'][$index])) {
                            echo "<input name='$index' type=number step=any value='".$dane['starepost'][$index]."'>";
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
                for($i=1; $i <=$xA; $i++){
                    for($j=1; $j <= $yA; $j++){
                        $index = 'a'.$i.$j;
                        if(isset($dane['starepost'][$index])){
                            echo "<input name='$index' type=number value='".$dane['starepost'][$index]."'>";
                        }else{
                            echo "<input name='$index' type=number value=''>";
                        }
                    }
                    echo "<br/>";
                }
                ?>
            </td>
            <td>
                <?php
                for($i = 1; $i <= $xA; $i++){
                    for($j = 1; $j <=$yB; $j++){
                        if(isset($dane['starepost']['wyslano'])){
                            $wynikk = $dane['wynik']['w'.$i.$j];
                            echo "<input type=text value='$wynikk'>";
                        }else{
                            echo "<input type=text value=''>";
                        }
                    }

                    echo '<br/>';
                }
                ?>
            </td>
        </tr>
    </table>
    <?php
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        table tr td input {width:40px;border:1px black solid}
        body {font-family:Arial;font-size:13px;}
        select {font-size:13px;}
        input {font-size:13px;}
        table tr td input[name^=a] {background:yellow}
        table tr td input[name^=b] {background:lightgreen}
    </style>
</head>
<body>
<form method="get">
    Ustal Wielkość Macierzy A: WIERSZE
    <select name="xA">

        <?php
        for($i = 1; $i < 101; $i++ ){
            if (isset($_GET['xA']) && $_GET['xA'] == $i) {
                echo "<option selected value=$i>$i</option>";
            }else{
                echo  "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    KOLUMNY <select name="yA" onchange="document.getElementById('xB').value = this.value">
        <?php
        for($i = 1; $i < 101; $i++ ){
            if (isset($_GET['yA']) && $_GET['yA'] == $i) {
                echo "<option selected value=$i>$i</option>";
            }else{
                echo  "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    <br/>
    Ustal Wielkość Macierzy B: WIERSZE
    <select disabled id="xB">
        <?php
        for($i = 1; $i < 101; $i++ ){
            if (isset($_GET['yA']) && $_GET['yA'] == $i) {
                echo "<option selected value=$i>$i</option>";
            }else{
                echo  "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    KOLUMNY
    <select name="yB">
        <?php
        for($i = 1; $i < 101; $i++ ){
            if (isset($_GET['yB']) && $_GET['yB'] == $i) {
                echo "<option selected value=$i>$i</option>";
            }else{
                echo  "<option value=$i>$i</option>";
            }
        }
        ?>
    </select>
    <input type="submit" value="wyslij">
</form>
<?php
if(isset($_GET['xA']) && isset($_GET['yA']) && isset($_GET['yB']) ){
    $xA = $_GET['xA'];
    $yA = $_GET['yA'];
    $yB = $_GET['yB'];
    $wynik = array();
    if(isset($_POST['wyslano'])){
        for($i=1; $i<=$xA; $i++){
            for($j=1; $j<=$yB; $j++){
                $c = 0;
                for($k = 1; $k <=$yA; $k++){
                    $c += $_POST['a'.$i.$k] * $_POST['b'.$k.$j];
                }
                $wynik['w' . $i . $j] = $c;
            }
        }
        zapisz($wynik);
    }

    ?>
    Macierz: <br/><br/>
    <form method="POST">
        <input type="hidden" name="wyslano">
        <table>
            <tr>
                <td></td>
                <td>
                    <?php
                    for($i = 1; $i <= $yA; $i++){
                        for($j = 1; $j <= $yB; $j++ ){
                            $index = 'b'.$i.$j;
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
                    for($i=1; $i <=$xA; $i++){
                        for($j=1; $j <= $yA; $j++){
                            $index = 'a'.$i.$j;
                            if(isset($_POST[$index])){
                                echo "<input name='$index' type=number value='$_POST[$index]'>";
                            }else{
                                echo "<input name='$index' type=number value=''>";
                            }
                        }
                        echo "<br/>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    for($i = 1; $i <= $xA; $i++){
                        for($j = 1; $j <=$yB; $j++){
                            if(isset($_POST['wyslano'])){
                                $wynikk = $wynik['w'.$i.$j];
                                echo "<input type=text value='$wynikk'>";
                            }else{
                                echo "<input type=text value=''>";
                            }
                        }

                        echo '<br/>';
                    }
                    ?>
                </td>
            </tr>
        </table>
        <input type="submit" value="Licz">
    </form>
<?php } ?>

<br/>

Historia obliczen:
<form method=post><input type=submit value="wyczyść"><input type=hidden name=czysc></form>
<?php
$rezultat = $polaczenie->query("SELECT data FROM macierz ORDER BY id LIMIT 10");
while($wiersz = $rezultat->fetch_assoc()){
    $dane = $wiersz['data'];
    $dane = json_decode($dane, true);
    wyswietl($dane);
}
?>
<br>
</body>
</html>