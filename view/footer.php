<?php if (isset($_COOKIE['cookies']) && $_COOKIE['cookies'] == 1) {
} else { ?>
    <div id="cookiesPolicy"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Strona korzysta z
        plików cookies w celu realizacji usług i zgodnie z
        Polityką Plików Cookies, kliknij jeżeli się godzisz: <a href="#" class="btn btn-primary" id="cookieButton">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Zgadzam się</a></div>
<?php } // TODO: cookies bar i info js wyłączony
?>

<div class="alert alert-danger text-center" role="alert" id="brakjs">W Twojej przeglądarce wyłączona jest obsługa JavaScript, niektóre funkcje moga nie działać.</div>

<script>
    $(document).ready(function () {
        $("#cookieButton").click(function () {

            Cookies.set('cookies', 1, {expires: 14});
            $('#cookiesPolicy').fadeOut();
        });
    });
</script>

<script src="C:\xampp\htdocs\php\pai_git\js\bootstrap.js"></script>
<script src="http://localhost/php/pai_git/js/bootstrap.js"></script>
<script src="http://localhost/php/pai_git/js/js.cookie.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>

</body>
</html>