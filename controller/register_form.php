<?php

session_start();
?>


<div class="row">
    <div class="col-md-12">

        <?php
        if (isset($_SESSION['error'])) {
            ?>
            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>
            <?php
            unset($_SESSION['error']);
        } else if (isset($_SESSION['success'])) {
            ?>
            <div class="alert alert-success" role="alert">Rejestracja przebiegła pomyslnie!</div>
            <?php
            unset($_SESSION['success']);
        }


        ?>


        <form class="form-horizontal" action="model/registration.php" method="post">

            <div class="form-group">
                <label for="register_email" class="col-sm-2 control-label">Email*</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" id="register_email" name="register_email"
                           placeholder="Email" onkeyup="checkEmail(this.value)">
                </div>
                <div class="col-sm-3"><p class="help-block"><span id="emailInfo"
                                                                  style="color:red;font-weight: bold;"></span>
                    </p></div>
            </div>

            <div class="form-group">
                <label for="register_nick" class="col-sm-2 control-label">Nick*</label>

                <div class="col-sm-7">

                    <input type="text" class="form-control" id="register_nick" name="register_nick"
                           placeholder="Nick - od 3 do 50 znaków" onkeyup="checkLogin(this.value)">

                </div>

                <div class="col-sm-3"><p class="help-block"><span id="loginInfo"
                                                                  style="color:red;font-weight: bold;"></span>
                    </p></div>


            </div>


            <div class="form-group">
                <label for="register_name" class="col-sm-2 control-label">Imię*</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="register_name" name="register_name"
                           placeholder="Imię">
                </div>
            </div>

            <div class="form-group">
                <label for="register_surname" class="col-sm-2 control-label">Nazwisko*</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="register_surname" name="register_surname"
                           placeholder="Nazwisko">
                </div>
            </div>

            <div class="form-group">
                <label for="register_city" class="col-sm-2 control-label">Miejscowość*</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="register_city" name="register_city"
                           placeholder="Miejscowość">
                </div>
            </div>

            <div class="form-group">
                <label for="register_street" class="col-sm-2 control-label">Ulica i numer*</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="register_street" name="register_street"
                           placeholder="Ulica i numer">
                </div>
            </div>

            <div class="form-group">
                <label for="register_telephone" class="col-sm-2 control-label">Numer telefonu</label>
                <div class="col-sm-7">
                    <input type="tel" class="form-control" id="register_telephone" name="register_telephone"
                           placeholder="Numer telefonu">
                </div>
            </div>


            <div class="form-group">
                <label for="register_password" class="col-sm-2 control-label">Hasło*</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="register_password" name="register_password"
                           placeholder="Hasło powinno mieć od 4 do 50 znaków." onkeyup="checkPass(this.value)">
                </div>
                <div class="col-sm-3"><p class="help-block"><span id="passInfo"
                                                                  style="color:red;font-weight: bold;"></span>
                    </p></div>
            </div>

            <div class="form-group">
                <label for="register_password2" class="col-sm-2 control-label">Powtórz hasło*</label>
                <div class="col-sm-7">
                    <input type="password" class="form-control" id="register_password2" name="register_password2"
                           placeholder="Powtórz hasło" onkeyup="checkPassIdentity()">
                    <p class="help-block">* - pola wymagane.</p>
                </div>
                <div class="col-sm-3"><p class="help-block"><span id="passInfo2"
                                                                  style="color:red;font-weight: bold;"></span>
                    </p></div>

            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" value="submit" class="btn btn-primary btn-lg" id="registerButton">
                        Zarejestruj
                    </button>
                </div>
            </div>
        </form>


    </div>
</div>


<script>
    function checkLogin(str) { // TODO: ajax walidacja formularza rejestracji
        if (str.length == 0) {
            document.getElementById("loginInfo").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("loginInfo").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "model/loginAJAX.php?nick=" + str, true);
            xmlhttp.send();
        }
    }

    function checkEmail(str) {
        if (str.length == 0) {
            document.getElementById("emailInfo").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("emailInfo").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "model/loginAJAX.php?email=" + str, true);
            xmlhttp.send();
        }
    }


    function checkPass(str) {
        if (str.length < 4) {
            document.getElementById("passInfo").innerHTML = "Hasło za krótkie!";
        } else if (str.length > 50) {
            document.getElementById("passInfo").innerHTML = "Hasło za długie!";
        } else {
            document.getElementById("passInfo").innerHTML = "";
        }
    }

    function checkPassIdentity() {
        var pass1 = document.getElementById("register_password").value;
        var pass2 = document.getElementById("register_password2").value;
        if (pass1 != pass2) {
            document.getElementById("passInfo2").innerHTML = "Hasła nie są identyczne!";
        } else {
            document.getElementById("passInfo2").innerHTML = "";
        }

    }


</script>