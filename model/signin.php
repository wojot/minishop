<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/pai_git/config.php");
include('db_connect.php');

foreach ($_POST as $k => $v) {
    $_POST[$k] = mysqli_real_escape_string($mysqli, $v);
}


if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
    //hash('sha256', $_POST['pass']);
    //and password = md5('{$_POST['pass']}');"));
    $q = mysqli_fetch_assoc(mysqli_query($mysqli, "select count(*) cnt, id_user, nick, email, permission, name, surname, city, street, tel 
                                                    from users where email='{$_POST['mail']}' and password = md5('{$_POST['pass']}');"));


    if ($q['cnt']) {
        $id = md5(rand(-10000, 10000) . microtime()) . md5(crc32(microtime()) . $_SERVER['REMOTE_ADDR']);
        mysqli_query($mysqli, "delete from session where user_id = '$q[id_user]';");
        mysqli_query($mysqli, "insert into session (user_id, id, ip, web) values('$q[id_user]','$id','$_SERVER[REMOTE_ADDR]','$_SERVER[HTTP_USER_AGENT]')");
        if (!mysqli_errno($mysqli)) {
            setcookie("id", $id, time() + 3600, "/");
            setcookie("id_user", $q["id_user"], time() + 3600, "/");
            setcookie("nick", $q["nick"], time() + 3600, "/");
            setcookie("email", $q["email"], time() + 3600, "/");
            setcookie("permission", $q["permission"], time() + 3600, "/");
            setcookie("name", $q["name"], time() + 3600, "/");
            setcookie("surname", $q["surname"], time() + 3600, "/");
            setcookie("city", $q["city"], time() + 3600, "/");
            setcookie("street", $q["street"], time() + 3600, "/");
            setcookie("tel", $q["tel"], time() + 3600, "/");


            //nick, email, permission, name, surname, city, street, tel
//            foreach($q as $k => $v){ //za duzo niepotrzebnych ciasteczek dodawalo
//                setcookie($k, $v, time()+3600, "/");
//            }

            foreach ($_COOKIE as $k => $v) {
                $_COOKIE[$k] = mysqli_real_escape_string($mysqli, $v);
            }

            header('location:' . HTTP . 'index.php?success=1');
            exit;
            

        } else {
            header('location:' . HTTP . 'index.php?error=2');
            exit;
        }
    } else {
        header('location:' . HTTP . 'index.php?error=1');
    }
} else {
    header('location:' . HTTP . 'index.php?error=4');
}
