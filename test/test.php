<?php
function f($x)
{
    //funkcja zawsze przyjmuje wartosci dodatnie
    //więc można pominąć wartosć bezwzględną
    return $x * $x + $x + 2;
}

function Pole($a, $b, $n)
{
    $h = ($b - $a) / $n; //wysokosć trapezów
    $S = 0.0; //zmienna będzie przechowywać sumę pól trapezów
    $podstawa_a = f($a);//, podstawa_b;

    for ($i = 1; $i <= $n; $i++) {
        $podstawa_b = f($a + $h * $i);
        $S += ($podstawa_a + $podstawa_b);
        $podstawa_a = $podstawa_b;
    }
    return $S * 0.5 * $h;
}

?>

<?php
if (isset($_POST['a'])) {
    if ($_POST['a'] > $_POST['b']) {
        echo "zly przedzial";
    } else {
        $a=$_POST['a'];
        $b=$_POST['b'];
        $n=$_POST['n'];
        echo "przedzial: ".Pole($a, $b, $n)."<br>";
        echo "A: " . $_POST['a'] . "<br>";
        echo "B: " . $_POST['b'] . "<br>";
        echo "LT: " . $_POST['n'] . "<br>";
    }
}
?>

<form action="" method="post">
    Podaj przedział:<br>
    A: <input type="text" name="a"><br>
    B: <input type="text" name="b"><br>
    Liczba trapezow: <input type="text" name="n"><br>
    <input type="submit" name="wyslij">
</form>
<p id="demo"></p>
<script>function myFunction() {
        document.getElementById("demo").innerHTML = "Hello World!";}
    window.alert(5 + 6); myFunction();</script>
