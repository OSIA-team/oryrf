<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="script/login.js"></script>
<!-- Latest compiled and minified CSS -->
<div id="add-success">
  <div class="wrap-info">
    <i class="small material-icons">add_shopping_cart</i> <span>Uspěšně vloženo do košíku</span> <a href="?page=kosik">přejít do košíku</a>
  </div>
</div>

<div id="add-error">
  <div class="wrap-info">
    <i class="small material-icons">error_outline</i> <span>Při vkládání do košíku nastala chyba</span>
  </div>
</div>


<div id="error-alert">
    <div class="wrap-info">
        <i class="small material-icons" style="position: relative;top: 10px;">info</i> Nejká informae </div>
</div>

<nav class="user">
    <?php
        if (isset($userClass->id)):
            echo  "<a href=\"?page=user\" >".$userClass->email."</a>";
    ?>
            &nbsp;
    <a class="waves-effect waves-light modal-trigger" href="logout.php">Odhlásit se</a>
    <?php
        endif;
        if (!isset($userClass->id)):
    ?>
    <a class="waves-effect waves-light modal-trigger" href="#login">Přihlásit se</a> nebo <a class="waves-effect waves-light modal-trigger" href="#register">registrovat</a>
    <?php
        endif;
    ?>
</nav>

<!-- Modal Structure -->
  <div id="login" class="modal grey lighten-4">
   <div class="modal-content row">
     <img src="pict/logo_bezpozadi.png" alt="branding logo" class="brand">
     <h5>Přihlašte se</h5>
<div class="loginform-in">
<div class="err" id="add_err"></div>

 <form action="./" method="post">
 <ul>
 <li> <label for="email">Email</label>
 <input type="text" name="email" id="email"  /></li>
 <li> <label for="password">Heslo</label>
 <input type="password" name="password" id="password"  /></li>
 <li> <label></label>
 <input type="submit" id="login-btn" name="login" value="Přihlásit" class="waves-effect waves-light btn amber darken-2 " ></li>
 </ul>
</form>

</div>
   </div>
 </div>


 <!-- Modal Structure -->
   <div id="register" class="modal grey lighten-4">
    <div class="modal-content row">
      <img src="pict/logo_bezpozadi.png" alt="branding logo" class="brand">
      <h5>Registrovat se</h5>
      <div class="err" id="add_err_reg"></div>
      <form id="registerForm" action="./" method="post">
        <div class='row'>
          <div class='input-field col s12'>
            <input class='validate' type='email' name='email' id='email-reg' required/>
            <label for='email-reg'>Váš email</label>
          </div>

          <div class='input-field col s12'>
            <input class='validate' type='password' name='password' id='password-reg' required/>
            <label for='password-reg'>Vaše heslo</label>
          </div>

          <div class='input-field col s12'>
            <input class='validate' type='password' name='password2' id='password-reg2' required/>
            <label for='password-reg2'>Heslo znovu</label>
          </div>

          <h6>Kontaktní údaje</h6>
          <div class='input-field col s6'>
            <input class='validate' type='text' name='jmeno' id='jmeno' required/>
            <label for='jmeno'>Jméno</label>
          </div>
          <div class='input-field col s6'>
            <input class='validate' type='text' name='prijmeni' id='prijmeni' required/>
            <label for='prijmeni'>Příjmení</label>
          </div>
          <div class='input-field col s12'>
            <input class='validate' type='text' name='adresa' id='address' required/>
            <label for='adresa'>Adresa pro doručení</label>
          </div>
          <div class='input-field col s12'>
            <input class='validate' type='text' name='telefon' id='telefon' value="" required/>
            <label for='telefon'>Telefon</label>
          </div>
        </div>
        <input type="submit" id="register-btn" class="btn amber darken-2 center" name="register" value="Registrovat se">
      </form>
    </div>
  </div>
