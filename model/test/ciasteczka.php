<!DOCTYPE html>
<html lang="pl">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
</head>
<body>
<a href="#" id="bucketCountClick">kliknij jquery</a><br>
<span id="bucketCount">0</span> produktów <br><br>
</body>
<script>

    $(document).ready(function () {

        $( "#bucketCountClick" ).on( "click", function() {
            var value = $('#bucketCount').text();
            value =  parseInt(value)+1;
            $("#bucketCount").text(value);
        });

    });
</script>
</html>