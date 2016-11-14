<html>
<head><title>Testowy PHP</title></head>
<body>
<form action="clk2.php" method="post">
    <input type="text" name="x1" id="x1"><br>
    <input type="text" name="x2" id="x2"><br>
    <input type="text" name="ilosc" id="ilosc"><br>
    <input type="submit" value="Licz" id="licz">
</form>
<script type="text/javascript">
    function oblicz()
    {
        var $x1 = Number(document.getElementById("x1").value);
        var $x2 = Number(document.getElementById("x2").value);
        var $ilosc = Number(document.getElementById("ilosc").value);
        var $h = ($x2-$x1) / $ilosc;
        var $poda = $x1;
        var $podb = $x2;
        var $sumpods = 0;
        for ($x=1;$x <= $ilosc; $x++)
        {
            $sumpods = $poda + $podb;
            $podb = $poda;
            $poda = $poda + $h;
        }
        var $sumapol = $sumpods * (0.5) * $h;
        document.write("Suma pol trapezow: " + $sumapol);
    }
    document.getElementById("licz").onclick = function(e){
        e.preventDefault();
        oblicz();
    };
</script>
</body>
</html>