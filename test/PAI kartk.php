<style>
    form input {
        margin-left: 20px;
        margin-bottom: 5px;
        width: 250px;
    }

</style>
<?php
///**
// * Created by PhpStorm.
// * User: wojot
// * Date: 05.06.2016
// * Time: 15:48
// *  93052009356 11 liczb
// */
//
//
//function creditcard($cc)
//{
//    $suma = 0;
//    $luhna = false;
//    for ($i = strlen($cc) - 1; $i >= 0; $i--) {
//        $temporary = $cc[$i];
//        if ($luhna) {
//            $temporary *= 2;
//            if ($temporary > 9) {
//                $temporary -= 9;
//            }
//        }
//        $suma += $temporary;
//        $luhna = !$luhna;
//    }
//    return $suma % 10 == 0;
//}
//
//if (is_numeric($_POST['cc'])) {
//    $cc = $_POST['cc'];
//    echo "Podano nr karty, walidacja: ";
//    if (creditcard($cc)) {
//        echo "przeszla pomyslnie";
//    } else {
//        echo "przeszla niepomyslnie";
//    }
//} else {
//    echo "Nie podano numeru karty.";
//}
//
//
//echo "<br><br>";
//
//
//if (isset($_POST['pesel'])) {
//    $pesel = $_POST['pesel'];
//
//
//    if (is_numeric($pesel)) {
//        if (strlen($pesel) == 11) {
//            if ($pesel[0] > 1 && $pesel[2] == 1 || $pesel[2] == 0 && $pesel[4] == 0 || $pesel[4] == 1 || $pesel[4] == 2 || $pesel[4] == 3) {
//                echo "PESEL jest poprawny.";
//            } else {
//                echo "PESEL niepoprawny.";
//            }
//
//
//        } else
//            echo "Zla dlugosc peselu.";
//    } else {
//        echo "PESEL nie jest liczbą.";
//    }
//} else {
//    echo "Podaj PESEL.";
//}
//
//
//?>

<script>
    function creditcard(cc) {
        var suma = 0;
        var luhna = false;
        var temporary="s";
        for (var i = cc.length - 1; i >= 0; i--) {
            temporary = cc[i];
            if (luhna) {
                temporary *= 2;
                if (temporary > 9) {
                    temporary -= 9;
                }
            }
            suma += temporary;
            luhna = !luhna;
        }
        return suma % 10 == 0;
    }

function test() {


    var y = document.forms["myForm"]["cc"].value;
    if (!isNaN(y)) {
        alert("Podano nr karty, walidacja: ");
        if (creditcard(y)) {
            alert("przeszla pomyslnie");
        } else {
            alert("przeszla niepomyslnie");
        }

    } else {
        alert("numer karty nie jest numerem");
    }

}


    function validateForm() {
        var x = document.forms["myForm"]["pesel"].value;
        if (x == null || x == "") {
            alert("Pesel powinien byc wypelniony");
            return false;
        } else {
            if (!isNaN(x)) {
                if (x.length == 11) {
                    if (x[0] > 1 && x[2] == 1 || x[2] == 0 && x[4] == 0 || x[4] == 1 || x[4] == 2 || x[4] == 3) {
                        alert("PESEL jest poprawny");
                    } else {
                        alert("PESEL jest niepoprawny");
                    }


                } else {
                    alert("PESEL ma zla dlugosc");
                }

            } else {
                alert("PESEL nie jest numerem")
            }
        }

    }


</script>


<form name="myForm" action="" onsubmit="return test()" method="post">
    PESEL: &nbsp;<input type="text" name="pesel"><br>
    Nr karty: <input type="text" name="cc"><br>
    <input type="submit" value="Sprawdz numery">
</form>