<?php
/*
 * LOGIC GOES HERE
 */

// Cookies
session_start();
if (isset($_SESSION['user'])) {
    header("location: index.php");
}


// Connection to database
$server   = "localhost";
$user     = "root";
$password = "";
$database = "Bel3s";

// Create connection
$connection = new mysqli($server, $user, $password, $database);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$connection->set_charset("utf8");

// If user want to login (form sent)
if (isset($_POST['submit'])) {

  $username = stripslashes($_POST['username']);
  $password = stripslashes($_POST['password']);
//  var_dump($password);
    $password_hash = crypt($password,'$2a$07$belesbel3ssaltsoosasd$');
//  var_dump($password_hash);
echo $password." ".$password_hash."<br>";
//  $user   = $_POST['username'];

  $query  = "SELECT password FROM admin WHERE username='{$username}'";


  if($stmt = $connection->query($query)){

    // $stmt->fetch_row();

    while($row = $stmt->fetch_row()) {
      //  echo "ok2";
      if ($row[0] == $password_hash) {

        $_SESSION["user"] = $username;
        header("location: index.php");
      }
    }

    // var_dump($stmt);


  }


}

 ?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>OptimasDB/OSIA Team software</title>

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../style/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="../../style/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../../style/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="../../style/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="../../style/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../style/css/app.css">
    <link rel="stylesheet" type="text/css" href="../../style/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../style/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../style/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="../../style/css/pages/login-register.css">
    <!-- END Page Level CSS-->

  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1"><img src="css/images/logo.png" alt="branding logo" style="max-height:80px;"></div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Přihlášení do OptimasDB</span></h6>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <form class="form-horizontal form-simple" method="POST">
                        <fieldset class="form-group position-relative has-icon-left mb-0">
                            <input type="text" class="form-control form-control-lg input-lg" name="username"  id="user-name" placeholder="Přihlašovací jméno" required>
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" name="password" id="user-password" placeholder="Heslo" required>
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                        </fieldset>
                        <!--<fieldset class="form-group row">
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                <fieldset>
                                    <input type="checkbox" id="remember-me" class="chk-remember">
                                    <label for="remember-me"> Remember Me</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                        </fieldset> -->
                        <button class="btn btn-lg btn-danger btn-block" type="submit" name="submit"><i class="icon-unlock2"></i> Přihlásit se</button>
                    </form>
                </div>
            </div>
           <div class="card-footer">
                <div class="">
                  <!--  <p class="float-sm-left text-xs-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p> -->
                    <p class="float-sm-right text-xs-center m-0">Developed by <a href="http://www.osia.cz" class="card-link">OSIA Team</a></p>
                    <p class="float-sm-left text-xs-center m-0">Tested with Chrome 59</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>

  </body>
</html>
