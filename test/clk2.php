<?php
$x1 = $_POST["x1"];
$x2 = $_POST["x2"];
$ilosc = $_POST["ilosc"];
$h = ($x2-$x1) / $ilosc;
$poda = $x1;
$podb = $x2;
$sumpods = 0;
for ($x=1;$x <= $ilosc; $x++)
{
    $sumpods = $poda + $podb;
    $podb = $poda;
    $poda = $poda + $h;
}
$sumapol = $sumpods * (0.5) * $h;
echo "Suma pol trapezow: " . $sumapol
?>