<?php
include_once('db_connect.php');

@$nick = $_GET['nick'];
@$email = $_GET['email'];
$output = "";
if ($q = $mysqli->query("SELECT nick, email FROM users")) {
    $user = $q->fetch_all();

    if (isset($_GET['nick'])) {
        for ($i = 0; $i < count($user); $i++) {
            $user[$i][0] = strtolower($user[$i][0]);

            if ($nick == $user[$i][0]) {
                $output = "Wpisany nick zajęty!";
            } elseif (strlen($nick) < 3) {
                $output = "Nick za krótki!";
            } elseif (strlen($nick) > 50) {
                $output = "Nick za długi!";
            } else {
            }
        }
    }
    if (isset($_GET['email'])) {
        for ($i = 0; $i < count($user); $i++) {
            $user[$i][1] = strtolower($user[$i][1]);

            if ($email == $user[$i][1]) {
                $output = "Wpisany email zajęty!";
            } else {
            }
        }
    }
//        echo "<br>" . $nicks[$i][0];
//        if ($nick == $nicks[$i][0]) {
//            echo " to ten!";
//        }

    echo $output;
    mysqli_close($mysqli);
} else {
    header("location: ../index.php?error=1");
}
